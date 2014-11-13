

```php
// app/routes.php
Route::model('users', 'User');

Route::resource('users', 'UsersController');
```

* `Route::model('users', 'User')` the first parameter `users` is expected to match the wildcard that is provided by the route.  If we take a look at the associated route we see that this is `GET|HEAD users/{users}`.  The second parameter is the model with which we want this wildcard to be associated.

```php
// app/controllers/UsersController.php
<?php

class UsersController extends \BaseController {



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(User $user)
	{
		//
        return $user;
	}

}
```

* Note this is probably more suitbale for building basic APIs rather than more complex applications.