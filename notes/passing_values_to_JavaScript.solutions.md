
```php
// app/routes.php

Route::get('pass-to-javascript', function()
{
    $name = 'insiite';
    return View::make('hello', compact('name'));

});
```

*example 1*

```html
<!-- app/views/hello.blade.php -->

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>
	<div>
		<h1>You have arrived.</h1>
	</div>

    <script>
        var name = '{{ $name }}';
        alert(name);
    </script>
</body>
</html>
```

*example 2*

```html
<!-- app/views/hello.blade.php -->

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>
	<div>
		<h1>You have arrived.</h1>
	</div>

    <form action="">
        <input type="hidden" id="name" data-name="{{ $name }}"/>
    </form>

    <script src="http://code.jquery.com/jquery.js"></script>

    <script>
        var name = $('#name').data('name');
        alert(name);
    </script>
</body>
</html>
```

*example 3*

```php
// composer install to work with laravel 4.2

composer require laracasts/utilities:1.0.1 
```

```php 
// app/config/app.php

'providers' => array(

	... ,
	
	'Laracasts\Utilities\UtilitiesServiceProvider'

),
```

```php
// app/routes.php

Route::get('pass-to-javascript', function()
{
   JavaScript::put(array('name' => 'insiited'));
    return View::make('hello');

});
```


```php
// publish the configuration file for this service

php artisan config:publish laracasts/utilities
```

This will create the following file which we can then edit.

```php
// app/config/packages/laracasts/utilities/config.php

return [

    /*
    |--------------------------------------------------------------------------
    | View to Bind JavaScript Vars To
    |--------------------------------------------------------------------------
    |
    | Set this value to the name of the view (or partial) that
    | you want to prepend the JavaScript variables to.
    |
    */
    'bind_js_vars_to_this_view' => 'layouts/partials/footer',

    /*
    |--------------------------------------------------------------------------
    | JavaScript Namespace
    |--------------------------------------------------------------------------
    |
    | By default, we'll add variables to the global window object.
    | It's recommended that you change this to some namespace - anything.
    | That way, from your JS, you may do something like `Laracasts.myVar`.
    |
    */
    'js_namespace' => 'insiite.vars'

];
```

```html
<!-- app/views/hello.blade.php -->

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>
	<div>
		<h1>You have arrived.</h1>
	</div>
	
	</div>

    @include('layouts.partials.footer')
	
	</body>
</html>
```

```html
// app/views/layouts/partials/footer.blade.php

Hello this is the footer.

<script>
    alert(name);
</script>
```

___