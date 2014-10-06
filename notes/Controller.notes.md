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
