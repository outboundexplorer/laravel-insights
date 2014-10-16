
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

###passing data to Blade using dynamic methods *withDynamicMethod()*

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
* As the `View` class has a magic `__call()` method, it will pass the non-existent method into this magic method.
* The magic method will strip the with from the original method and place this as the first parameter in a normal `with()` method.
* The parameter from the original method becomes the second parameter in this new `with()` method.
* `withGroupList($groups)` becomes `with('groups_list',$groups)`.

___

###dynamically passing data to Blade using *make($view, $data)*

*laravel framework*

```php
// laravel/framework/src/Illuminate/View/Factory.php

/**
 * Get the evaluated view contents for the given view.
 *
 * @param  string  $view
 * @param  array   $data
 * @param  array   $mergeData
 * @return \Illuminate\View\View
 */
public function make($view, $data = array(), $mergeData = array())
{
	if (isset($this->aliases[$view])) $view = $this->aliases[$view];

	$path = $this->finder->find($view);

	$data = array_merge($mergeData, $this->parseData($data));

	$this->callCreator($view = new View($this, $this->getEngineFromPath($path), $view, $path, $data));

	return $view;
}
```

*example*

```
Route::get('list_groups', function()
{
    $groups = Group::all();

    return View::make('groups.index', array('group_list' => $groups));
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

* When we pass an array of data in the form of '$key => $value' pairs.  Laravel will look for the '$key' in the Blade view and will populate the view with the relevant '$value'.

___


###creating links in the blade view with model data

```php
// app/routes.php

Route::get('list-groups', function()
{
    $groups = Group::all();

    return View::make('groups.index', array('group_list' => $groups));
});
```

```html
<!-- app/views/groups/index.php -->

<!doctype html>
<html>
    <head>
        <meta charset="utf-8"
    </head>

    <body>
        <h1>All Groups: </h1>
        @foreach ($group_list as $group)
            <li> {{ HTML::link('/groups/'.$group->name, $group->name) }}</li>
            @endforeach
    </body>
</html>
```

* The `$key` in the data array must match the `data[$key]` that is accessed from within the blade view.

___

###using a dynamic URI to access the model data and pass to the blade view

```php
// app/routes.php

Route::get('groups/{name}', function($name)
{
    $group = Group::where('name','=',$name)->first();
    return View::make('groups.show', array('group' => $group));
});
```

```html
<!-- app/views/groups/show.php -->

<!doctype html>
<html>
    <head>
        <meta charset="utf-8"
    </head>
    <body>
        <h1>  Hello, {{ $group->name }} </h1>
    </body>
</html>
```

* We are able to access `$group` as `group` was declared in the View::make() method.
* We can access `$group->name` as $group is an object.

___

 