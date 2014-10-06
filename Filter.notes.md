###General notes

* We can use filters to create filtering for our routes.  We create filters in the **filters.php** file.

___

###Defining a filter

```php
**Route::filter('birthday', function()
{
    if (date('d/m') == '27/08')
    {
        return View::make('birthday');
    }
});
```

* A filter is given a name for the first parameter and a callback function for the second parameter.  

___

###'before' filter

```php
Route::get('/', array(
				'before' => 'birthday',
				function()
				{
					return View::make('hello');
    }			));
```

* We reference to filters from within the **routes.php** file

* A **before filter** will check the logic of the filter before calling the original logic of the route.  

* If an action is called in the filter, then this will be actioned upon instead of the original route logic.  

* In the **‘birthday’** example, the filter will be checked and if today is ‘27/08’ then it will return **birthday.blade.php** instead of **hello.blade.php**.

___

###'after' filter

* It is also possible to use an after filter to perform after the original route logic has been called.  The after filter cannot be used to replace the original logic, but instead can be used to perform extra logic after the original route logic (providing that the filters criteria are met)

___


###using 'before' and 'after' filters together

```php
Route::get('/', array(
    'before'    => 'birthday',
    'after'     => array('christmas',’newyear’),
    function()
    {
       return View::make('hello');
    }
));
```

* It is possible to call both 'before' and 'after' filters from the same route.

* It is also possible to include multiple filters of the same type (shown by using an array in the example)

* Multiple filters can also be set up using a pipe (**'after' => 'christmas|newyear'**)

___ 

###passing parameters from the route to the filter

```php
// app/filters.php

Route::filter('birthday', function($route, $request, $date)
{
    if (date('d/m') == $date) {
        return View::make('birthday');
   }
});
```

```php
// app/routes.php

Route::get('/', array(
    	'before'    => 'birthday:12/12',
    	function()
    	{
			return View::make('hello');
    	}
		));
```

* The code above shows how we can pass a $date from the route to our filter.

* It is possible to pass as many additional parameters as we like to the filters using `Route::filter('birthday', function($route, $request, $first, $second, $third)`

___

###Filter class

```php
//  app/filters/BirthdayFilter.php

Class BirthdayFilter (){

    public function filter($route, $request,$date)
    {
        if (date('d/m') == $date )
        {
            return View::make('birthday');
        }
    }
}
```

```php
//  app/filters.php

Route::filter(‘birthday’,’BirthdayFilter’);
```

```php
// app/routes.php

Route::get('/', array(
    	'before'    => 'birthday:12/12',
    	function()
    	{
			return View::make('hello');
    	}
		));
```

* By using a Filter class instead of a Closure we are able to write code that will be much easier for testing.

* In order for our new class to be registered with composer we must add **app/filters** to the **composer.json classmap** and then run **composer dump-autload –o**

* The **routes.php** file is unchanged
   
