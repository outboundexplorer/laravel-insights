
###passing data to Blade using with()

*laravel framework*

```php
// laravel/framework/src/Illuminate/View/View.php

/**
 * Add a piece of data to the view.
 *
 * @param  string|array  $key
 * @param  mixed   $value
 * @return $this
 */
public function with($key, $value = null)
{
	if (is_array($key))
	{
		$this->data = array_merge($this->data, $key);
	}
	else
	{
		$this->data[$key] = $value;
	}

	return $this;
} 
```

*example*

```php
// app/routes.php

Route::get('list-groups', function()
{
    $groups = Group::all();

    return View::make('groups.index')->with('group_list',$groups);
});
```

```html
<!-- app/views/groups/index.blade.php -->

<!doctype html>
<html>
    <head>
        <meta charset="utf-8"
    </head>

    <body>
        <h1>All Groups: </h1>
        <pre>
        {{ dd($group_list) }}
        </pre>
    </body>
</html>
```

* When we use `with()` we define a `$key` for the first parameter.  The `$key` will allow us to access the data from the Blade view. The second parameter is used to provide the `value` that will be accessed when we use the `$key` in the Blade view.  
* We can access the `$key` from the blade view simply by using the `$key`.  (Note: In the blade.php view we must include the `$` sign.
* The `with()` method basically sets the data property of the View instance to `data['group_list'] = Group::all()` and then returns the instance.

___

###dynamically passing data to Blade using *withWildCard()*

*laravel framework*

```php
// laravel/framework/src/Illuminate/View/View.php

/**
 * Dynamically bind parameters to the view.
 *
 * @param  string  $method
 * @param  array   $parameters
 * @return \Illuminate\View\View
 *
 * @throws \BadMethodCallException
 */
public function __call($method, $parameters)
{
	if (starts_with($method, 'with'))
	{
		return $this->with(snake_case(substr($method, 4)), $parameters[0]);
	}

	throw new \BadMethodCallException("Method [$method] does not exist on view.");
}
```

*example*

```php
// app/routes.php

Route::get('list-groups', function()
{
    $groups = Group::all();

    return View::make('groups.index')->withGroupList($groups);
});
```

```html
<!-- app/views/groups/index.blade.php -->

<!doctype html>
<html>
    <head>
        <meta charset="utf-8"
    </head>

    <body>
        <h1>All Groups: </h1>
        <pre>
        {{ dd($group_list) }}
        </pre>
    </body>
</html>
```

* In the example we have used the method `withGroupList()` which is a method which does not exist.  
* As the `View` class has a magic `__call()` method, it will pass the non-existent method into this



___
Route::get('allgroups3', function()
{
    $groups = Group::all();

    return View::make('groups.index', ['groups' => $groups]);
});
