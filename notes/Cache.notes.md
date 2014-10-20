

###saving query results in the cache

*laravel framework

```php
// laravel\framework\src\Illuminate\Database\Query\Builder.php

/**
 * Indicate that the query results should be cached.
 *
 * @param  \DateTime|int  $minutes
 * @param  string  $key
 * @return $this
 */
public function remember($minutes, $key = null)
{
	list($this->cacheMinutes, $this->cacheKey) = array($minutes, $key);

	return $this;
}
```

```php
// app/routes.php

Route::get('test-query-cache', function()
{
    return User::remember(60)->get();
});
```

* By using the `remember()` method with the model, we are able to tell the server to cache the query for 
60 minutes.
* Each time we call this same query against the model, the server will first check whether we have this
stored in the cache.  If it is stored in the cache, it will be returned from the cache instead of 
performing a query against the database.
* See the notes on 'using an event listener to display new queries against the database'.

___

###using an event listener to display new queries against the database

```php
// app/routes.php

Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});
```

* By using `Event::listen()` we are able to list any queries that are made against the database.  This is 
useful when checking that our cache queries are working correctly.

___

###saving HTML in the cache