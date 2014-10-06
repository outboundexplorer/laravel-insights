###URL::to(relevant_URI)
* **URL::to(‘relevant/URI’)** will provide the full URL (but will not take the browser to that URL)


```php
OUTPUT >>> https://laravel_testlab/relevant/URI/route/foo/bar
```

___

###passing parameters to URL::to('another/URI, array('foo','bar'), true)

```php
OUTPUT >>> https://laravel_testlab/another/URI/foo/bar
```
 
* different parameters can be passed to the URI using the second parameter
* the third parameter set to **true** will force the use of **https://**

___

###URL::secure('another/URI',array('foo','bar'))


```php
OUTPUT >>> https://laravel_testlab/another/URI/foo/bar
```

___

###URL::route('named.route')

```php
// app/routes.php

Route::get('relevant/URI', array(
        'as' => 'named.route',
        function()
        {
            return 'hello';
        })
);

Route::get('example',function(){
    return URL::route('named.route');
});
```

```php
OUTPUT >>> http://laravel_testlab/relevant/URI
```

* We are still able to access the full URL using a named route, but we only need to supply the alias of the route.

___

###URL::action('ControllerName@actionName')

```php
// app/routes.php

Route::get(‘the/pattern’,’ControllerName@actionName’)

Route::get(‘example’,function()
{ 
	return URL::action(‘ControllerName@actionName’);
});
```

```php
// OUTPUT >>> http://laravel_testlab/the/pattern
```

* URL::action('ControllerName@actionName') will return the URL that is required to call this controller method.
* In the example, when the browser matches the URI pattern **'example'** it will return
`// OUTPUT >>> http://laravel_testlab/the/pattern` 

___

###URL::asset('relevant/file.ext')

```php
Route::get(‘logo/image’,function()
{ 
	return URL::asset(‘img/logo.png’); 
});
```

```php
// OUTPUT >>> http://laravel_testlab/img/logo.png
```

* `URL::asset(‘relevant/URI')` is used to return a URL that includes the full filename 
* **true** can be passed as a second parameter for **https** (`URL::asset('relevant/file.ext')`)

___

###URL::secureAsset('relevant/file.ext')

* We can also use `URL::secureAsset(‘relevant/file.ext’)` in order to create a URL that uses https.

###shortcuts

* `url(‘relevant/URI’)` can be used in the same way the same way that we use `URL::to(‘relevant/URI’)`.
* `secure_url(‘relevant/URI’)` can be used in the same way as `URL::secure(‘relevant/URI’)`
* `route(‘named.route’)` can be used in the same way as `URL::route(‘named.route’)`
* `action(‘ControllerName@actionName’)` can be used the same way as `URL::action(‘ControllerName@actionName’)`
* `asset(‘relevant/URI’)` can be used the same way as `URL::asset(‘relevant/URI’)`
* `Secure_asset(‘relevant/URI’)` can be used the same way as `URL::secureAsset(‘relevant/URI’)`
