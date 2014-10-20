

###saving database query results in the cache

*laravel framework*

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

```php
// app/routes.php

Route::filter('cache.fetch','Insiite\Filters\CacheFilters@fetch');
Route::filter('cache.put','Insiite\Filters\CacheFilters@put');

Route::get('test-html-cache', function()
{
    return View::make('hello');
})->before('cache.fetch')->after('cache.put');
```

```php
// app/Insiite/Filters/CacheFilters.php

<?php namespace Insiite\Filters;

/* It is optional to include these three namespaces.
 * These should be implicitly available.  However, it is good practice
 * to explicitly include them by using Type Hinting.  If we use Type Hinting,
 * it is essential that we include the namespaces.
 */
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Both of these must be included as they are being called from within a different namespace.
use Str;
use Cache;

/* Some helper notes:
 *
 * $request->url() refers to the URL of the current request.
 *
 */
class CacheFilters {

    /**
     * Fetch data from cache stored under $key
     *
     * @param Illuminate\Routing\Route $route
     * @param Illuminate\Http\Request $request
     * @return string
     */
	public function fetch(Route $route, Request $request)
    {
        $key = $this->makeCacheKey($request->url());

        if (Cache::has($key))
        {
            return Cache::get($key);
        }
    }

     /**
     * Put data into cache stored under $key
     *
     * @param Illuminate\Routing\Route $route
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Http\Response $response
     * @return void
     */
	 public function put(Route $route, Request  $request, Response  $response)
    {
        $key = $this->makeCacheKey($request->url());

        if (! Cache::has($key))
        {
            Cache::put($key, $response->getContent(), 60);
        }
    }

     /*
     * Generate a unique key
     *
     * @param string $url
     * @return string
     */
	protected function makeCacheKey($url)
    {
        return 'route_'.Str::slug($url);
    }

}
```

```php
// testlab/composer.json

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
        }
	},
```

* As our `CacheFilters.php` file has been placed in the `Insiite\Filters` namespace, we must place the 
file within the `Insiite/Filters` folder.
* We must declare the location of the namespace within `composer.json`.
* When we point the browser to the URI `test-html-cache`, our route will first implement the 
`before()` filter which will first pass control to `CacheFilters@fetch` method. 
* The `Cachefilters@fetch` method will check to see whether there is any data stored in the cache under using
`Cache::has($key)`.  If the `$key` is not found in the cache, then the server will `return View::make('hello')`.
If the `$key` is found then the server will use the key to `return Cache::has($key)`.
* If the `$key` is not found and the route `return View::make('hello')`, then the `after()` filter is also called
and this will put the html output into the cache.

___ 