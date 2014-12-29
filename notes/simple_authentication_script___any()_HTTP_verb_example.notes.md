
<?php

Route::any('/', array(
    'as'    => 'user.login',
    'uses'  => 'UsersController@login'
));

Route::any("/profile", [
    "as"   => "user.profile",
    "uses" => "UsersController@profile"
]);




<?php

class UsersController extends BaseController {

    public function login()
    {

        if ($this->isPostRequest())
        {
            $validator = $this->getLoginValidator();

            if ($validator->passes())
            {
                $user_status = $this->getUserStatus();

                if (Auth::attempt($user_status))
                {
                    return Redirect::route('user.profile');
                }

                return Redirect::back()
                    ->withErrors(array(
                        'password' => 'Not authorized'
                        ));
            }

            return Redirect::back()
                    ->withInput()
                    ->withErrors($validator);

        }

        return View::make('users.login');
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

    protected function getUserStatus()
    {
        return array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
    }

    public function profile()
    {
        return View::make("users.profile");
    }
}



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




@extends("layout")
@section("content")
  <h2>Hello {{ Auth::user()->username }}</h2>
  <p>Welcome to your sparse profile page.</p>
@stop