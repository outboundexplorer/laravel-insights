###General notes


* We can define as many routes as we like in the **routes.php** file

* A **URI** containing only a forward slash **‘/’** will match the **URL** of the website.

___

###Basic routing

```php
Route::get(‘my/page’,function()
{ 
	return ‘Hello World’
});
```

* **Closure** will only be called when the URI matches **my/page** and the request is made by the HTTP verb **GET**

* The **Closure** in the above code is placed in the **Route::get()** method's second parameter.  This is a **$callback** variable.  It is also possible to use the **$callback** to reference controllers. (see Controller.notes.md)    


* URI **‘my/page’** and URI **‘/my/page’** are equivalent

___




###Dynamic placeholder

```php
Route::get(‘/books/{genre}’, function($genre)
{ 
	return “Books in {$genre}“; 
}); 
```

**Insights**

1)We are now able to pass any **$genre** into the URI and will be directed to the relevant $genre

___

###Dynamic placeholder as an option?

```php
Route::get(‘/books/{genre?}’, function($genre = null)
{ 
		if ($genre == null) 
		{
			return “This is the Book Index”;
		}
		return “Books in the $genre category;
});
```

**Insights**

1) We can make the dynamic parameter optional by adding a question mark **?**.  

____

###named routing

```php
// app/routes.php

Route::get('/the/uri/route/to/faqs/has/become/really/long', array(
			'as' => 'faqs',
			'uses' => 'PagesController@showFAQs'
			)
);
```

```php
// app/controllers/PagesController

class PagesController extends BaseController {

	public function showFAQs ()
	{
		return View::make('faqs');
	}
}
```

```html
// app/views/faqs.blade.php
@extends('layout')

@section('content')
	<p> The full URL of the FAQs page is {{ route('faqs') }} </p>
    <p> Which is much better than {{ URL::to('/the/uri/route/to/faqs/has/become/really/long') }}</p>
	<p> and is really difficult to remember!!</p>
@stop
```

```html
// app/views/layout.blade.php
<!doctype html>
	<head>
	</head>
	<body>
		@yield('content')
	</body>
</html>
```

* Using named routes using an Alias allows us to keep things simple when we need to reference the route.
* We can use the `uses` parameter to route directly to a specific action of the controller.

___

###Redirect::route('faqs')

```php
return Redirect::route('faqs');
```

* redirect to the named route 'faqs'

___

###secure routes

```php
// app/routes.php

Route::get('secret/content', array(
			'https',
			function ()
			{
				return 'This is accessed with https!';
			})
);

###attaching conditionals to a route

```php
// app/routes.php

Route::get('user/{username}', function($username)
{
    return "Welcome {$username} ";
})->where('username','[A-Za-z]+');
```

* The route will only match on the condition that 'username' is lowercase or uppercase letter and with at least one letter.

___

###attaching multiple conditionals to a route

```php
// app/routes.php

Route::get('user/{username}/{group}', function($username,$group)
{
    return "Welcome {$username} to {$group} group";
})	->where('username','[A-Za-z]+')
	->where('group','[A-Za-z]+');
```

* The route will only match on the condition that the 'username' and the 'group' are lowercase/uppercase and with at least one letter.

---
