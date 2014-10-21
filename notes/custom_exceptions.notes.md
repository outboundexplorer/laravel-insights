
```php
// app/routes.php
Route::get('user', function()
{
   return 'All Users';
});

Route::get('user/{id}', function($id)
{
    try
    {
        $user = User::findOrThrowException($id);
    }
    catch(ModelNotFoundException $e)
    {
        return Redirect::to('user');
    }

    return $user;
});
```

```php
// app/models/User.php

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'users';

    public static function findOrThrowException($id)
    {
        $user = static::find($id);

        if (! is_null($user))
        {
            return $user;
        }

        throw new ModelNotFoundException('Model does not exist');
    }
}
```

```php
// app/exceptions/ModelNotFoundException.php

class ModelNotFoundException extends Exception {

}
```

```php
// app/start/global.php

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
    app_path().'/exceptions'

));
```

* By using `try` and `catch` this will prevent the code from stopping when an exception occurs.
* We are able to define what action should be taken when an exception is caught.
* We define a new `class ModelNotFoundException` which extends `Exception` class.
* As we have now placed `ModelNotFoundException` within its own namespace, we cannot use PSR-0 autoloading, 
we must therefore place a reference to this in the `global.php` file.
* `route.php` will pass the `$id` to the `User::findOrThrowException` method which will either return the `$user`
or will return a new exception.

___