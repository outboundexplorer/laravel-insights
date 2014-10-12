###Schema::create()

```php
Schema::create('users', function($table)
{
	$table->increments('id');					
	$table->timestamps();						
});
```

* the increments() method is required
* the timestamps() method is recommended as this will be very useful in many situations

___

###unique()

```php
$table->string('username')->unique();
```

is the same as

```php
$table->string('username');
$table->unique('username');
```
___

###primary()

```php
$table->string('username')->primary();
```

is the same as 

```php
$table->integer('username');
$table->primary('username');
```

___

###composite *primary()**


* In the example, there is no 