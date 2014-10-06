###trying out Input::all() with GET data

```php
// app/routes.php

Route::get('request', function()
{
    $data = Input::all();
    var_dump($data);
});
```

We then provide a URL with some `GET` data as: `http://laravel_testlab/request?one=blue&two=pink&three=red`

```php
// OUTPUT >>> array(3) { ["one"]=> string(4) "blue" ["two"]=> string(4) "pink" ["three"]=> string(3) "red" } 
```

* `Input::all()` is used to return an associative array of both `$_POST` and `$_GET` data.
* In the example we have only supplied `$_GET` data

___

###trying out Input::all() with POST data

```html
// app/views/test-form.blade.php
<!doctype html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'request')) }}
        {{ Form::hidden('foo','foofoo')) }}
        {{ Form::hidden('bar','barbar')) }}
        {{ Form::submit('Submit') }}
        {{ Form::close() }}
    </body>
</html>
```

```php
// app/routes.php

Route::get('test/form', function()
{
    return View::make('test-form');
});

Route::post('request', function()
{
    $data = Input::all();
    var_dump($data);
});
```

`OUTPUT >>> array(3) { ["_token"]=> string(40) "lG4InXHkPBxX336q2lpFbwlYN1mqAwXILNGj5B7S" ["foo"]=> string(6) "foofoo" ["bar"]=> string(6) "barbar" }` 

* In the example a simple form was created that submitted two hidden fields `foo` and `bar` with values of 'foofoo' and 'barbar'.  
* The form was submitted via a POST request to the url 'request'.  
* The `Route::post('request')` received the data and dumped it to the screen.

___

###Input::get()

```php
// app/routes.php

Route::get('test', function()
{
	$data = Input::get('two');
	var_dump($data);
});
```

We then provide a URL with some `GET` data as: `http://laravel_testlab/test?one=blue&two=pink&three=red`

```php
// OUTPUT >>> string(4) "pink"  
```

* When we use the `Input::get()` method a single piece of data is returned
* If we had not inserted any `$_GET` data for 'two' then we would have received a `NULL` value


###using a default with Input:;get()

```php
// app/routes.php

Route::get('test',function()
{
    $data = Input::get('target_data','default');
    var_dump($data);
});
```

So that even if we are looking for `$_GET` data that is not present in the URL such as `http://laravel_testlab/test`

```php
// OUTPUT >>> string(7) "default"  
```

* By providing a default string, we can be sure that when something goes wrong, the value will still be a string.

___