###trying out *Input::all()* with GET data

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

###trying out *Input::all()* with POST data

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

```php
// OUTPUT >>> array(3) { ["_token"]=> string(40) "lG4InXHkPBxX336q2lpFbwlYN1mqAwXILNGj5B7S" ["foo"]=> string(6) "foofoo" ["bar"]=> string(6) "barbar" }
```

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

___

###using a default with *Input::get()*

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

###Input::has()

```php
// app/routes.php

Route::get('test',function()
{
    if (Input::has('one'))
    {
        return "URL has 'one'!";
    }
    return "URL does not have 'one'!";
});
```

If we pass the following `$_GET` data to the URL: `http://laravel_testlab/test?one=two`

```php
// OUTPUT >>> URL has 'one'! 
```

and if we pass the following `$_GET` data to the URL: `http://laravel_testlab/test?two=one`

```php
// OUTPUT >>> URL does not have 'one'! 
```

* Use `Input::has()` to check whether a certain variable is present.
* `Input::has()` returns a boolean value.



___

###Input::only()

```php
// app/routes.php

Route::get('test',function()
{
    $result = Input::only(array('one','two'));
    var_dump($result);
});
```

When we enter the URL `http://laravel_testlab/test?one=apple&two=banana&three=orange`

```php
// OUTPUT >>> array(2) { ["one"]=> string(5) "apple" ["two"]=> string(6) "banana" }
```

* We have now received a subset of the request data.
* The array() is optional, we could have just used `Input::only('one','two')`

___

###Input::except()

```php
// app/routes.php

Route::get('test6',function()
{
    $result = Input::except(array('one','two'));
    var_dump($result);
});
```

When we enter the URL `http://laravel_testlab/test?one=apple&two=banana&three=orange`

```php
// OUTPUT >>> array(1) { ["three"]=> string(6) "orange" }
```

* We have now received a subset if the request data.
* The array() is optional, we could have just used `Input::except('one','two')`

___


###using *Input::flash()* to keep input data for another request cycle

```php
// app/routes.php

Route::get('test',function()
{
    Input::flash();
    return Redirect::to('new/request');
});

Route::get('/new/request', function()
{
    var_dump(Input::old());
});
```

When we enter the URL `http://laravel_testlab/test?one=apple&two=orange`

```php
// OUTPUT >>> array(2) { ["one"]=> string(5) "apple" ["two"]=> string(6) "orange" }
```

* Generally after a redirect the request data from the original URL is lost.
* When we use the `Input::flash()` method, we tell the browser that we want to hold onto the data for another request cycle. (note: we must implement `Input::flash()` before the redirect takes place)
* After the redirect, the request data from the previous cycle is now accessed via `Input::old()` 

___

###*Input::flashOnly()* & *Input::flashExcept*

```php
Input::flashOnly(array('one', 'two'));
Input::flashOnly('one','two');

Input::flashExcept(array('three'));
Input::flashExcept('three');
```

* These methods operate in exactly the same way as the `Input::flash()` method, but instead of flashing all of the request data to the following request cycle only a subset of the request data is sent.
* `Input::flashOnly()` will only send the request data that is specified. 
* `Input::flashExcept()` will send all the request data except the request data that is specified. 

___

###accessing certain elements of *Input::old()*

```php
Input::old(array('one','two'));
Input::old('one','two');
```

* We can use `Input::old()` in either of the above ways to access only a subset of the request data from the previous cycle.

___ 

###withInput()

```php
// app/routes.php

Route::get('test',function()
{
    return Redirect::to('new/request')->withInput();
});
```

is exactly the same as

```php
Route::get('test',function()
{
    Input::flash();
    return Redirect::to('new/request');
});
```

* `withInput()` is the same as `withInput(Input::all()`
* In order to only flash a subset of the request data we can now use `withInput(Input::only())` or `withInput(Input::except())`

___

###working with uploaded files and *getFileName()*

```html
<-- views/new-test-form.blade.php -->

<!doctype html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'handle-form','files' => 'true')) }}
        {{ Form::file('my_file') }}
        {{ Form::submit() }}
        {{ Form::close() }}
    </body>
</html>
```

```php
// app/routes.php

Route::get('/test', function()
{
    return View::make('new-test-form');
});

Route::post('handle-form', function()
{
    return Input::file('my_file')->getFilename();
});
```

```php
// OUTPUT >>> php86E2.tmp
```

* A `GET` request with the URI `/test` will take us to the `new-test-form.blade.php` form.
* We include `'files' => 'true'` in the `Form::open()` parameters as when working with files we need the HTML form attribute `'enctype' => 'multipart/form-data'`. 
* Once we submit a file, a `POST` request is sent to the `handle-form` URI.
* `Input::file('my_file') represents 'my_file' as an object
* The upload currently resides in a temporary location which only exists as long as the current request.
* `getFileName()` allows us to access the temporary fileName property of the 'my_file' object.

___

###working with uploaded files and *getClientOriginalName()*

```html
<-- views/new-test-form.blade.php -->

<!doctype html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'handle-form','files' => 'true')) }}
        {{ Form::file('my_file') }}
        {{ Form::submit() }}
        {{ Form::close() }}
    </body>
</html>
```

```php
// app/routes.php

Route::get('/test', function()
{
    return View::make('new-test-form');
});

Route::post('handle-form', function()
{
    return Input::file('my_file')->getClientOriginalName();
});
```

```php
// OUTPUT >>> my_image.jpg
```

* `getClientOriginalName()` allows us to access the original fileName property of the 'my_file' object.

___


###working with uploaded files and *getClientSize()*

```html
<-- views/new-test-form.blade.php -->

<!doctype html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'handle-form','files' => 'true')) }}
        {{ Form::file('my_file') }}
        {{ Form::submit() }}
        {{ Form::close() }}
    </body>
</html>
```

```php
// app/routes.php

Route::get('/test', function()
{
    return View::make('new-test-form');
});

Route::post('handle-form', function()
{
    return Input::file('my_file')->getClientSize();
});
```

```php
// OUTPUT >>> 3530004
```

* `getClientSize()` allows us to access the file size property of the 'my_file' object.
* File size is in bytes.

___


###working with uploaded files *getMimeType()*

```html
<-- views/new-test-form.blade.php -->

<!doctype html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'handle-form','files' => 'true')) }}
        {{ Form::file('my_file') }}
        {{ Form::submit() }}
        {{ Form::close() }}
    </body>
</html>
```

```php
// app/routes.php

Route::get('/test', function()
{
    return View::make('new-test-form');
});

Route::post('handle-form', function()
{
    return Input::file('my_file')->getMimeType();
});
```

```php
// OUTPUT >>> image/jpeg
```

* `getMimeType()` allows us to access the mime type property of the 'my_file' object.


___


###working with uploaded files and *guessExtension()*

```html
<-- views/new-test-form.blade.php -->

<!doctype html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'handle-form','files' => 'true')) }}
        {{ Form::file('my_file') }}
        {{ Form::submit() }}
        {{ Form::close() }}
    </body>
</html>
```

```php
// app/routes.php

Route::get('/test', function()
{
    return View::make('new-test-form');
});

Route::post('handle-form', function()
{
    return Input::file('my_file')->guessExtension();
});
```

```php
// OUTPUT >>> jpeg
```

* `guessExtension()` allows us to access the mime type property of the 'my_file' object.


___


###working with uploaded files and *getRealPath()*

```html
<-- views/new-test-form.blade.php -->

<!doctype html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'handle-form','files' => 'true')) }}
        {{ Form::file('my_file') }}
        {{ Form::submit() }}
        {{ Form::close() }}
    </body>
</html>
```

```php
// app/routes.php

Route::get('/test', function()
{
    return View::make('new-test-form');
});

Route::post('handle-form', function()
{
    return Input::file('my_file')->getRealPath();
});
```

```php
// OUTPUT >>> C:\Windows\Temp\phpA7FA.tmp
```

* `getRealPath()` allows us to get the current location of the uploaded file.
* Once we know where the temporary file is located we can use copy() or rename() to save the file to another more permanant location.

___

###moving an uploaded file with *move()*


```html
<-- views/new-test-form.blade.php -->

<!doctype html>
    <head>
    </head>
    <body>
        {{ Form::open(array('url' => 'handle-form','files' => 'true')) }}
        {{ Form::file('my_file') }}
        {{ Form::submit() }}
        {{ Form::close() }}
    </body>
</html>
```

```php
// app/routes.php

Route::get('/test', function()
{
    return View::make('new-test-form');
});

Route::post('handle-form', function()
{
	$name = Input::file('my_file')->getClientOriginalName();
	Input::file('my_file')->move('storage/directory', $name);
	return 'File was successfully moved!';
});
```

```php
// OUTPUT >>> File was successfully moved!'
```

* When using `move()` to move an uploaded file, we select a destination as the first parameter (note: `storage/directory` will create a new directory within the `public` directory.  If we try to use `/storage/directory`, we are now trying to access a folder outside the web root and correct write permissions are needed.)
* By using `getClientOriginalName()` and first assigning this to the variable `$name` we are able to use this as an optional second parameter for providing the file with a filename (otherwise the tempororary filename will be used)

Alternatively we could have just placed the chained method that access the `my_file` object directly into the `move()` method.

```php
// app/routes.php

Route::post('handle-form', function()
{
	Input::file('my_file')->move('storage/directory', Input::file('my_file')->getClientOriginalName();
	return 'File was successfully moved!';
});
```
___

###create and retrieving a cookie with *Cookie::make()*

```php
// app/routes.php

Route::get('cookietest', function()
{
    $cookie = Cookie::make('color','pink', 60);
    return Response::make('Cookie Set')->withCookie($cookie);
});

Route::get('/settings', function()
{
    $cookie = Cookie::get('color');
    var_dump($cookie);
});
```

* We create a cookie using the `Cookie::make($name, $value)` method.  If we do not specify a third parameter, the cookie will expire at the end of the user's session.
* Use `$cookie = Cookie::make($name, $value, 60);` to create a cookie that will expire in 60 minutes.
* The `$cookie` is only created once we attach it to the returned response from the **Closure**.  
* In the example, we use `Response::make('Cookie Set')` to return a simple string to the screen.
* We can method chain `withCookie($cookie)` to the response in order to create the cookie.

If we direct the browser to `http://laravel_testlab/cookietest` we will see the following output:

```php
// OUTPUT >>> Cookie Set
```

If we now go to `http://laravel_testlab/settings` we will see the following output:

```php
// OUTPUT >>> string(4) "pink" 
```

* We can use the `Cookie::get('cookie_name')` method to access the properties of the cookie.

___

###setting a default value using *Cookie::get('cookie_name','default_value')*

```php
// app/routes.php

Route::get('test', function()
{
    $cookie = Cookie::make('color','pink', 60);
    return Response::make('Cookie Set')->withCookie($cookie);
});

Route::get('/settings', function()
{
    $cookie = Cookie::get('size','large');
    var_dump($cookie);
});
```

If we now direct the browser to `http://laravel_testlab/settings` we will see the following output to the screen:

```php
// OUTPUT >>> string(5) "large"
```

___

###

```php
// app/routes.php

Route::get('test', function()
{
    $cookie = Cookie::make('color','pink', 60);
    return Response::make('Cookie Set')->withCookie($cookie);
});

Route::get('settings', function()
{
    if (Cookie::has('color'))
    {
        return var_dump(Cookie::get('color'));
    }
    return 'The cookie you needed is not there!';
});
```

When we direct the browser to `http://laravel_testlab/settings` we will see the following output to the screen:

```php
// OUTPUT >>> string(4) "pink"
```

* The `Cookie::has('cookie_name)` method has checked to see whether the relevant cookie is within the response and returns a boolean value.

___

###Cookie::forever()

```php
Cookie::forever('cookie_name')
```

* The above will create a cookie that will never expire.

```php
Cookie::forever('cookie_name','default_value')
```

* We can also set a default value

___

###Cookie::forget()

```php
Cookie::forget('cookie_name')
```

* We can force a cookie to expire using the `Cookie::forget()` method.

___

