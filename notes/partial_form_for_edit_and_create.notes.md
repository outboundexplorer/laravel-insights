
###using the same form template for both creating and editing models

```php
// app/routes.php

Route::resource('users','UsersController');
```

```php
// app/controllers/UsersController.php

class UsersController extends \BaseController {

public function create()
{
	return View::make('users.create');
}

public function edit($id)
{
	$user = User::find($id);
	return View::make('users.edit')->withUser($user);
}
```

```html
// app/views/layouts/main.blade.php

<!doctype html>
<html>
     <head>
         <meta charset="utf-8">
         <link rel="stylesheet" href="/css/main.css">
     </head>
     <body>
        @yield('content')
     </body>
 </html>
```

```html
// app/views/layouts/partials/form.blade.php

<div>
	{{ Form::label('username','Username') }}
	{{ Form::text('username') }}
</div>

<div>
	{{ Form::label('password','Password') }}
	{{ Form::password('password') }}
</div>

<div>
	{{ Form::submit(isset($buttonText) ? $buttonText : 'Create User') }}
</div>
```

```html
// app/views/users/create.blade.php

@extends('layouts.main')

@section('content')
    <h1>Create new user</h1>

    {{ Form::open(array('route' => 'users.store')) }}
        @include('layouts.partials.form')
    {{ Form::close() }}
@stop
```

```html
// app/views/users/edit.blade.php

@extends('layouts.main')

@section('content')
    <h1>Edit user</h1>

    {{ Form::model($user,array('method' => 'PATCH', 'route' => array('users.update', $user->id))) }}
        @include('layouts.partials.form', array('buttonText' => 'Update User'))
    {{ Form::close() }}
@stop
```

* We can extract parts of our form to a partial view by using `@include`.
* It is recommended to not include `Form::open()` and `Form::close()` within the partial view so that
we can maintain greater flexibility of where the form is sent.
* We can share variables between a view and the partial view that it includes by passing an array of variables
as the second parameter `@include('layouts.partials.form, array('buttonText' => 'Update User))`.  (Note: this 
is accessed using `$buttonText` in the partial view.

___  