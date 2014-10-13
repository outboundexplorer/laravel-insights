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

###Schema::rename()

```php
Schema::rename('orignal_name','new_name');
```

___

###using *Schema::table()* to add columns

```php
Schema::table('users', function($table)
{
	$table->string('username');
});
```

* The above will add `username` column to and existing `users` table.

___


###Schema::drop()

```php 
Schema::drop('users');
```

___

###Schema::dropIfExists()

```php
Schema::dropIfExists('users');
```

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

###composite *primary()* key

```php
$table->string('username')->unique();
$table->string('group')->unique();
$table->primary(array('username','group'));
```

* In the case of composite primary key, it is not possible to independently define each field as `primary()`.

___

###index()

```php
$table->integer('qty')->index();
```

is the same as

```php
$table->integer('qty');
$table->index('qty');
```

* If we want to apply multiple indexes, we must apply them separately.
can apply this using an array similar to the way an array is used to 
set a composite primary key in the example above.  (note that the indexes will be independent of each other).
* `unique()` and `primary()` are already indexed and do not need further indexing.
* Any fields that are the foreign key to another table should be indexed
* Any fields that used to look up (or filter) information should be set as indexes.

___

###setting up a composite *index()*

```php
$table->float('latitude');
$table->float('longitude');
$table->index(array('latitude','longitude');
```

* The above index will only benefit search capabilities on `latitude`, `latitude & longitude`.  Searches on just `longitude` will not benefit from this composite index.
* A composite index must be dropped using the same method `$table->dropIndex(array('latitude','longitude'));`

___

###nullable()

```php
$table->string('name')->nullable();
```

* If we need to disallow NULL, we can use `nullable(false)`.  This is the default.

___


###deafult()

```php
$table->string('status')->default('Guest');
```

___

###unsigned()

```php
$table->integer('value')->unsigned();
```

___

###dropColumn()

```php 
$table->dropColumn('users');
```

* If we want to remove multiple columns we can pass an array `$table->dropColumn(array('users','groups'));`


___

###renameColumn()

```php
$table->renameColumn('original_name','new_name');
```

___

###dropPrimary()

```php
$table->dropPrimary('users');
```

* To remove composite primary keys, we can use an array `$table->dropPrimary(array('users','groups'));`

___


###dropUnique()

```php
$table->dropUnique('users');
```


* To remove multiple unique indexes, we can use an array `$table->dropUnique(array('users','groups'))`

___

###dropIndex()

```php
$table->dropIndex('users');
```

Can we use an array()???