###using *Request::is($path)* to indicate navigation status

*example 1*

```php
// app/routes.php

Route::get('index', function()
{
    return View::make('pages.home');
});

Route::get('about', function()
{
    return View::make('pages.about');
});

Route::get('contact', function()
{
    return View::make('pages.contact');
});
```

```html
// app/views/layouts.main.blade.php

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/css/main.css">

    </head>
    <body>
        @include('layouts.partials.nav')

        <div class="container wrap">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
```

```html
// public/css/main.css

.active a {
    font-weight:bold;
    color:green;
}
```

```html
// app/views/layouts/partials/nav.blade.php

<nav class="nav wrap">
    <ul class="right">
        <li class="{{ Request::is('index') ? 'active' : '' }}"><a href="index">Home</a></li>
        <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="about">About</a></li>
        <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="contact">Contact</a></li>
    </ul>
</nav>
```

```html
// app/views/about.blade.php

@extends('layouts.main')
@section('content')
    <h1>This is the about page</h1>
@stop
```

*example 2*
 
```php
// app/helpers.php

function set_active($path, $active = 'active')
{
    return Request::is($path) ? $active : '';
}
```

```php
// app/composer.json

	"autoload": {
		"classmap": [
			"app/commands",
			"app/controllers",
			"app/models",
			"app/database/migrations",
			"app/database/seeds",
			"app/tests/TestCase.php"
		],
        "psr-0": {
            "Insiite": "app/"
        },

        "files": [
            "app/helpers.php"
        ]
	},
```

```html
// app/views/layouts/partials/nav.blade.php

<nav class="nav wrap">
    <ul class="right">
        <li class="{{ set_active('index') }}"><a href="index">Home</a></li>
        <li class="{{ set_active('about') }}"><a href="about">About</a></li>
        <li class="{{ set_active('contact') }}"><a href="contact">Contact</a></li>
    </ul>
</nav>
```

* We can use the `Request::is($path) method to identify whether the `$path` matches the current URI.
* If `$path` matches the current URI, then we can set the `<li class="active">` which will allow us to 
use CSS to style the active navigation.
* In example 1, we have hardcoded this logic directly into the `nav.blade.php` file.
* In example 2, we have extracted this logic out to a helper file.  In order for the helper file to be accessed, 
we must insert this into the `composer.json` file.
* In both these examples the links are hard-coded into the `nav.blade.php` file.  If these links were returned from 
the database as an array, we could loop through the array and simplify this code even further.

___