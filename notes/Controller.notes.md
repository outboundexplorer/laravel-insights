###simple Controller routing

```php
// app/routes.php

Route::get('home','UsersController@showHome');
```

```php
// app/controllers/UsersController.php

class UsersController extends BaseController {

	public function showHome()
	{
		return View::make('home');
	}
}
```

* Link a controller's method to a route by using the **ControllerName@desiredMethod** string in the **$callback** parameter of the **Route::get()** method.

___

###passing dynamic URL parameters to the controller

*example*

```php
// app/routes.php

Route::get('groups/{name}', 'GroupsController@show');
```

```php
// app/controllers/GroupsController.php

class GroupsController extends \BaseController {

	public function show($id)
	{
		//
        $group = Group::where('name','=',$id)->first();

        return View::make('groups.show', array('group' => $group));

    }
}
```

```html
@extends('layouts.master')
@section('content')
    <h1>  Hello, {{ $group->name }} </h1>
@stop
```

* When we have dynamic placeholders within our URI, Laravel will automatically pass these as the arguments to the function that is called by the route.
* In the above example the `{name}` is passed into to show() method.

___