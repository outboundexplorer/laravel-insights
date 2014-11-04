

```php
// app/routes.php

Route::get('/course-home', function()
{
    return View::make('home');
});

Route::get('/lessons/{slug}', function()
{
    $lesson = 'Amazing Lesson';
    return View::make('lesson', compact('lesson'));
});
```


* We can use the second parameter of the make() function to pass arguments.
* The second parameter must be an array.  We can use the compact() function
to create an array with the argument as the key. 
`compact('lesson') = array('lesson' => 'Amazing Lesson')`


___

```php
// app/views/layout.blade.php

<!doctype html>
<html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="@yield('meta_description','This is the default description')">
         <title>Project</title>
     </head>
     <body>
           @yield('content')
     </body>
 </html>
```
 
 
 

```php
// app/views/home.blade.php

@extends('layout')

@section('content')

    <h1>Home page</h1>

@stop
```


```php
// app/views/lesson.blade.php

@extends('layout')

@section('meta_description',strip_tags($lesson))

@section('content')
    <h1>{{ $lesson }}</h1>
@stop
```

