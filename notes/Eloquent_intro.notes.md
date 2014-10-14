###create a new Eloquent model

```php
// app/models/Group.php

class Group extends Eloquent
{

}
```

* This model is created to access the `groups` table in the database.
* Note that the model is singular and that the table is plural. 
___

###saving data to the database

```php
// app/routes.php

Route::get('save', function()
{
	$group = new Group;
	$group->name = 'Laravel Friends';
	$group->description = 'A place where like-minded programmers can come together';
	$group->save();
	
	$group->name = 'Laravel Websites';
	$groups->desciption = 'All the cool websites';
	$group->save();
});
```

* `save()` is used to save the data to the database.
* In the example, we have only created one new instance of the Group class.  Therefore only `'Laravel Websites'` will be saved as the `group->name`. 

___

###disable automatic timestamp updates

```php
// app/models/Group.php

class Group extends Eloquent {

	public $timestamps = false;
}
```

___

###defining your own table names

```php
// app/models/Group.php

class Group extends Eloquent {

	public $table = 'my_groups_table';
}
`

* If models have been placed in a different namespace, we need to use the `$table` attribute to provide table names.

___

###find()

```php
// app/routes.php

Route::get('find', function()
{
    $group = Group::find(1);
    return $group->name;
});
```

* We retrieve an instance of Group where the database row has an `id` of `1`.  As we are working with a specific instance we do not need to create a new instance.

___

###delete()

```php
// app/routes.php

Route::get('delete', function()
{
    $group = Group::find(1);
    $group->delete();
});
```

* Once we have retrieved a specific instance using `find()` we can use the `delete()` method to remove the row represented by our model from the database.

___

###destroy()

```php
// app/routes.php

Route::get('destroy', function()
{
    Group::destroy(1);
});
```

* We can directly access an instance and delete it using the `destroy()` method.
* It is also possible to directly access multiple instances and delete them using either `Group::destroy(1,2,3);` or 'Group::destroy(array(1,2,3))`.

___

	
###return the model instance as a JSON string

```php
// app/routes.php

Route::get('model', function()
{
    return Group::find(1);
});
```

* The model instance where the `id` is equal to 1 has been returned and has used the `__toString()` magic method to represent its values as a `JSON` string. 
* If we `var_dump(Group::find(1));` we see that a complete instance of the Group Model class has been dumped.
___

###using all() to return a *Collection* of model instances

```php
// app/routes.php

Route::get('model', function()
{
	return Group::all();
});
```

* This will return a `JSON` array of all the data in the database
* If we `var_dump(Group::all());` we see that an instance of the Eloquent\Collection class has been returned which contains all the individual Group model instances.

___

###using find(array()) to return a *Collection* of model instances

```php
// app/routes.php

Route::get('find-model', function()
{
    return Group::find(array(1,2,3));
});
```

* This will return a `JSON` array of the data in the database that matches the `id` of `1,2,3`.
* If we `var_dump(Group::find(array(1,2,3)));` we see that an instance of the Eloquent\Collection class has been returned which contains the individual group instances where `id` is equal to `1,2,3`.

___

###first()

```php
// app/routes.php

Route::get('data', function()
{
	return Group::first();
});
```

* This will return a `JSON` array of the data in the first row of the database.
* If we `var_dump(Group::first());` we see that a complete instance of the Group Model class has been dumped.
___

###update()

```php
// app/routes.php

Route::get('update-model', function()
{
    Group::where('id','=','3')
        ->update(array(
            'name' => 'new name',
            'description' => 'new description'
        ));
    return Group::find(3);
});
```

* We can use the `update()` method to directly update an instance with new values as required.
* A constraint must be used with the `update()` method.  In the example we are using the `where()` constraint.

___

###delete()

```php
// app/routes.php

Route::get('delete-model', function()
{
    Group::where('id','=','3')
        ->delete();
    return Group::all();
});
```

* We can use the `delete()` method to directly delete an instance.
* A constraint must be used with the `delete()` method.  In the example we are using the `where()` constraint.

___

###using delete() to remove multiple rows of data from the database


```php
// app/routes.php

Route::get('delete-model', function()
{
    $targets = array(
        '6',
        '7');
    foreach ($targets as $target)
    {
        Group::where('id','=', $target)
            ->delete();
    }
    return Group::all();
});
```

___

###delete all database rows using *truncate()*

```php
// app/routes.php

Route::get('delete-all', function()
{
    Groupie::truncate();
    return Groupie::all();
});
```

* `truncate()` deletes all rows in the model's database

___

###get()

```php
// app/routes.php

Route::get('selected', function()
{
    return Group::where('name','=','Friends')
        ->get();
});
```

* We use `get()` to retrieve a specific *Collection* of model instances.
* In the above example, there is no difference between `'Friends'` and `'friends'`.

___

###requiring specific columns with *get()*

```php
// app/routes.php

Route::get('selected', function()
{
    return Group::where('name','=','friends')
        ->get(array('name','description'));
});
```

* We can pass an array of column names as a parameter for the `get()` method and this will allow us to return result instances that only contain those columns.

___

###pluck()

```php
// app/routes.php

Route::get('single-column', function()
{
    return Group::pluck('name');
});
```

* `pluck()` takes one column name as its single parameter.  Only the first value will be returned.

___

###lists()

```php
// app/routes.php

Route::get('column', function()
{
    return Group::lists('name');
});
```

* We can use `lists()` to return an array of values for the specified column. 
* `lists()` takes one column name as its single parameter.

___

###toSql()

```php
// app/routes.php

Route::get('selected', function()
{
    return Group::where('name','=','Friends')
        ->toSql();
});
```

```php
// OUTPUT >>> select * from 'groups' where 'name' = ?
```

* We can use the `toSql()` method anywhere we would normally use a fetch method.  
* In the above example we are using the `toSql()` method instead of the `get()` method.
* `?` is a placeholder for actual values (this is because Laravel uses prepared statements).

___

###*where()* and common comparison operators

```php
// app/routes.php

Route::get('selected', function()
{
    return Group::where('name','=','Friends')
        ->get();
});
```

```php
where('column_name','comparison_operator','value')
```

* `=`,`<`,`>`,`>=`,`<=`  are some common comparison operators that can be used

___

###*where()* and the *LIKE* SQL operator
// app/routes.php

Route::get('search', function()
{
    return Group::where('description','LIKE','%Laravel%')
        ->get(array('description'));
});
```

* `%` wildcard lets us tell the query that we don't require any match before or after the string that we have provided.
* We can also use the `_` wildcard to indicate that we don't require a match for this single character.

__ 

###using multiple *where()* constraints

```php
// app/routes.php

Route::get('search', function()
{
    return Group::where('name','LIKE','fri__ds')
        ->where('id','>=','4')
        ->toSql();
});
```

```php
// OUTPUT >>> select * from `groups` where `name` LIKE ? and `id` >= ?
```

* Both constraints must match for a row to exist within the result set.
* We can use as many `where()` constraints as we need

___

###using a placeholder with the *where()* constraint

```php
// app/routes.php

Route::get('search', function()
{
    $query = 'laravel';

    $query = '%'.$query.'%';
    return Group::where('description','LIKE',$query)
        ->get(array('name','description'));
});
```

___

###orWhere()

```php
// app/routes.php

Route::get('selected', function()
{
    return Groupie::where('name','=','Friends')
        ->orWhere('id','>','5')
        ->toSql();
});
```

```php
// OUTPUT >>> select * from `groups` where `name` = ? or `id` > ?
```

* We can use as many `where()` or `orWhere()` constraints as we need.

___

###whereRaw()

```php
// app/routes.php

Route::get('selected', function()
{
	return Group::whereRaw('name = ? AND id > ?', array('Laravel','3'))
						->get();
});
```

* The `whereRaw()` method is very useful in situations where we require complex SQL queries.
* We are able to chain as many `whereRaw()` methods as we need.
* `orWhereRaw()` method allows us to provide alternative constraints.

___

###whereBetween()

```php
// app/routes.php

Route::get('between', function()
{
    return Group::whereBetween('id', array('1','3'))
        ->get();
});

* First parameter is the column name
* Second parameter is array of the two values, starting value and limit.
* We can also use the `orWhereBetween()` constraint to provide alternative constraints.
* We can use as many `whereBetween()` or `orWhereBetween()` constraints as required.
___

###whereNested()

```php
// app/routes.php

Route::get('nested', function()
{
    return Group::whereNested(function($query)
    {
        $query->where('id','=','1');
        $query->orWhere('id','>','5');
    })
    ->get();
});

* `whereNested()` is a clean way of applying multiple where constraints to a query.
* We are able to apply as many `where()` or `orWhere()` constraints within the `Closure`.
* We can also build up a series of `orWhereNested()` in the same way.

___

###whereIn()

```php
// app/routes.php

Route::get('wherein', function()
{
    $values = array('friends','laravel');
    return Group::whereIn('name', $values)
        ->toSql();
});
```

* The `whereIn()` constraint is very useful when we know we are looking for a specific set of values.
* We can also use the `orWhereIn()` method.
___

###whereNotIn()

```php
// app/routes.php

Route::get('wherenotin', function()
{
    $values = array('friends','laravel');
    return Groupie::whereNotIn('name', $values)
        ->get();
});
```


* The `whereNotIn()` constraint is very useful when we know we don't want to include a specific set of values.
* We can also use the `orWhereNotIn()` method.
___

###whereNull()

```php
// app/routes.php

Route::get('wherenull', function()
{
	return Group::whereNull('column_name')
		->get();
});
```

* We can also use the `orWhereNull()` method to provide alternative constraints.

___








