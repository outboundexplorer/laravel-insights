Source: https://medium.com/laravel-4/laravel-4-authentication-e8d93c9ce0e2
Location: <h>Redirecting With Input</h>

Version 1:
This is a simple Controller that validates the user input and then returns with errors.  Note that there is a small problem with this in that it if the user refreshes the page, it will ask the user to resubmit the data.  This is of course strange as the data has already been declared as invalid??!!

```php
// app/routes.php

<?php

Route::any('/', array(
    'as'    => 'user/login',
    'uses'  => 'UsersController@login'
));
```

```php
<?php

class UsersController extends BaseController {

    public function login()
    {

        $data = [];

        if ($this->isPostRequest())
        {
            $validator = $this->getLoginValidator();

            if ($validator->passes())
            {
                echo 'Validation passed!';
            }
            else
            {
                $data['error'] = "Username and/or password invalid.";
            }
        }

        return View::make('users/login', $data);
    }

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    protected function getLoginValidator()
    {
        return Validator::make(Input::all(), array(
            'username' => 'required',
            'password' => 'required'
        ));
    }
}
```

```
// app/views/users/login.blade.php

@extends("layout")

@section("content")

  {{ Form::open() }}
    @if (isset($error))
        {{ $error }} <br/>
    @endif
  {{ Form::label("username", "Username") }}
  {{ Form::text("username") }}

  {{ Form::label("password", "Password") }}
  {{ Form::password("password") }}

  {{ Form::submit("login") }}

  {{ Form::close() }}

@stop
```

____

Version 2: This version passes the data back to the view and if the user refreshes the screen, it will not require the user to resubmit the form.

```php
// app/routes.php

<?php

Route::any('/', array(
    'as'    => 'user/login',
    'uses'  => 'UsersController@login'
));
```

```php
// app/controllers/UsersController.php

<?php

class UsersController extends BaseController {

    public function login()
    {

        if ($this->isPostRequest())
        {
            $validator = $this->getLoginValidator();

            if ($validator->passes())
            {
                echo 'Validation passed!';
            }
            else
            {
                return Redirect::back() // we could also use Redirect::route('user/login')
                    ->withInput()
                    ->withErrors($validator);
            }
        }

        return View::make('users/login');
    }

    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    protected function getLoginValidator()
    {
        return Validator::make(Input::all(), array(
            'username' => 'required',
            'password' => 'required'
        ));
    }
}
```



```html
// app/views/users/login.blade.php

@extends("layout")

@section("content")

  {{ Form::open() }}

  @if($errors->has())
    @foreach($errors->all() as $error)
        {{ $error }} <br/>
    @endforeach
  @endif

  {{ Form::label("username", "Username") }}
  {{ Form::text("username") }}

  {{ Form::label("password", "Password") }}
  {{ Form::password("password") }}

  {{ Form::submit("login") }}

  {{ Form::close() }}

@stop
```