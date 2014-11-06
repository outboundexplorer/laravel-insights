
```php
Event::listen('illuminate.query', function($sql)
{
    var_dump($sql);
});
```

* Paste this into the `routes.php` file and everytime an sql query is made to the database, this will dump the query to the screen