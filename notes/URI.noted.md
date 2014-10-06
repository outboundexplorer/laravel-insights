###URL::to(relevant_URI)
* **URL::to(‘relevant_URI’)** will provide the full URL (but will not take the browser to that URL)

___

###passing parameters to URL::to('another_URI, array('foo','bar'), true)

```php
OUTPUT >>> https://laravel_testlab/another/route/foo/bar
```
 
* different parameters can be passed to the URI using the second parameter
* the third parameter set to **true** will force the use of **https://**

___

This will output:   (note that the third parameter will force the use of **https://**
(3)	It is also possible to use **URL::secure(‘another/route’,array(‘foo’,’bar’))** in order to use the **HTTPS** protocol.
(4)	We can use **URL::route(‘named-route’)** for when we want to access the full URL but supply a named route instead of the URI.
(5)	It is also possible to use the **URL::action(‘ControllerName@actionName’)** to return the URL that will call this controller.  In the below example **http://lavarel_testlab/the/pattern** will be returned.
**Route::get(‘the/pattern’,’ControllerName@actionName’)
Route::get(‘example’,function()
{ return URL::action(‘ControllerName@actionName’)};);**
(6)	URL::asset(‘relevant-URI) is used to return a URL that includes the full filename (note: true can be passed as a second parameter for HTTPS)
**Route::get(‘example2’,function()
{ return URL::asset(‘img/logo.png’); });**
(7)	We can also use **URL::secureAsset(‘relevant-URI’)** in order to create a URL that uses HTTPS.
(8)	We can use all of the above methods in our **blade.php** files without any problems
(9)	There are still some shortcuts that are available.  We can use the function **url(‘relevant-URI’)** in the same way the same way that we used **URL::to(‘relevant-URI’)**.    
(10)	Another shortcut is **secure_url(‘relevant-URI’)**, this can be used in the same way as **URL::secure(‘relevant-URI’)**
(11)	We can also use **route(‘named-route’)** in the same way as **URL::route(‘named-route’)**
(12)	**action(‘ControllerName@actionName’)** can be used the same way as **URL::action(‘ControllerName@actionName’)**
(13)	**asset(‘relevant-URI’)** can be used the same way as **URL::asset(‘relevant-URI’)**
(14)	**Secure_asset(‘relevant-URI’)** can be used the same way as **URL::secureAsset(‘relevant-URI’)**
