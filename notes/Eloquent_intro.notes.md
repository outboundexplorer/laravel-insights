###create a new Eloquent model

*example*

```php
// app/models/Group.php

class Group extends Eloquent
{

}
```

* This model is created to access the `groups` table in the database.
* Note that the model is singular and that the table is plural. 

___

###saving data to the database using *save()*

*example*

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



###saving data to the database using *create()*

*laravel framework*

```php
// laravel/framework/src/Illuminate/Database/Eloquent/Model.php

/**
 * Save a new model and return the instance.
 *
 * @param  array  $attributes
 * @return static
 */
public static function create(array $attributes)
{
	$model = new static($attributes);

	$model->save();

	return $model;
}
```

*example*

```php
// app/routes.php

Route::get('save', function()
{
	Group::create(array(
		'name' 			=> 'new group',
		'description' 	=> 'this is the newest description'
		));
});
```


```php
// app/models/Group.php

class Group extends Eloquent {
	
	protected $fillable = array(
		'name',
		'description'
		);
}
```

* When we use `create()` we do not need to use save().
* We must add a `protected $fillable` property to the Group model in order to avoid a `MassAssignmentException`.  In the `$fillable` array, we include all attributes that we allow to be mass-assignable.
* We can use `protected $guarded` property if we only want to list those attributes which are not mass-assignable.


___

###disable automatic timestamp updates

*example*

```php
// app/models/Group.php

class Group extends Eloquent {

	public $timestamps = false;
}
```

___

###defining your own table names
*example*

```php
// app/models/Group.php

class Group extends Eloquent {

	public $table = 'my_groups_table';
}
`

* If models have been placed in a different namespace, we need to use the `$table` attribute to provide table names.

___

###find()
*example*


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
/**
 * Get all of the items in the collection.
 *
 * @return array
 */
```

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
/**
 * Get the first item from the collection.
 *
 * @param  \Closure   $callback
 * @param  mixed      $default
 * @return mixed|null
 */
```

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


###last()

```php
// app/routes.php

Route::get('data', function()
{
	return Group::last();
});
```

* This will return a `JSON` array of the data in the last row of the database.
* If we `var_dump(Group::last());` we see that a complete instance of the Group Model class has been dumped.
___

###shift()

```php
// app/routes.php

Route::get('shift', function()
{
    $collection = Group::all();
    var_dump(count($collection));
    var_dump($collection->shift());
    var_dump(count($collection));
});
```

* This is similar to the `first()` method, but it will also remove the first instance from the *Collections* array().

___

###pop()

```php
// app/routes.php

Route::get('pop', function()
{
    $collection = Group::all();
    var_dump(count($collection));
    var_dump($collection->shift());
    var_dump(count($collection));
});
```

* This is similar to the `last()` method, but it will also remove the last instance from the *Collections* array().

___

###each()
```php
/**
 * Execute a callback over each item.
 *
 * @param  \Closure  $callback
 * @return $this
 */
```

*example*

```php
// app/routes.php

Route::get('each', function()
{
    $collection = Group::all();
    $collection->each(function($group)
    {
        var_dump($group->name);
    });
});
```

Which is the same as 

```php 
// app/routes.php

Route::get('each', function()
{
	$collection = Group::all();
	foreach ($collection as $instance)
	{
		var_dump($instance->name);
	}
});
```

* We are able to use `foreach` as the `$collection` object is an array() of instances.

___

###map()  
```php
/** Collection::map()
 *
 * Run a map over each of the items.
 *
 * @param  \Closure  $callback
 * @return static
 */
```

*example*

```php
// app/routes.php

Route::get('map', function()
{
    $collection = Groupie::all();
    $new = $collection->map(function($instance)
    {
        return 'Group name: '.$instance->name;
    });

    var_dump($new);
});
```

```php
// OUTPUT >>>
object(Illuminate\Database\Eloquent\Collection)#326 (1) { 
	["items":protected]=> array(6) { 
		[0]=> string(14) "Group name: 11" 
		[1]=> string(14) "Group name: 22" 
		[2]=> string(19) "Group name: Friends" 
		[3]=> string(20) "Group name: friends2" 
		[4]=> string(19) "Group name: Laravel" 
		[5]=> string(24) "Group name: My Big group" 
		} 
}
```

* We assign the value of the `Collection::map()` method to a new variable.
* The collection is then iterated in a similar way as the `Collection::each()` method, but instead we return each value that we require to be present in the new collection.

___


###sort()

*source*

```php
// laravel\framework\src\Illuminate\Support\Collection.php 

/** 
 * Sort through each item with a callback.
 *
 * @param  \Closure  $callback
 * @return $this
 */
public function sort(Closure $callback)
{
	uasort($this->items, $callback);

	return $this;
}
```
*example*
```php
// app/routes.php 

Route::get('sort', function()
{
    $collection = Group::all();

    $collection->sort(function($a,$b)
    {
        $a = $a->name;
        $b = $b->name;
        if ($a === $b)
        {
            return 0;
        }
        return ($a > $b) ? 1: -1;
    });

    $collection->each(function($instance)
    {
        var_dump($instance->name);
    });
});
```

* We can use the `sort()` method to sort the collection.
* The closure is passed to the `uasort()` PHP method which uses integer values to compare two values.
* The `sort()` method is destructive as it alters the original collection.

___

###reverse()
*source*

```php
// laravel/framework/src/Illuminate/Support/Collection.php

/**
 * Reverse items order.
 *
 * @return static
 */
public function reverse()
{
	return new static(array_reverse($this->items));
}
```

*example*

```php
// app/routes.php 

Route::get('reverse', function()
{
    $collection = Group::all();

    $collection->each(function($instance)
    {
        var_dump($instance->name);
    });

    $reverse = $collection->reverse();

    $reverse->each(function($instance)
    {
        var_dump($instance->name);
    });
});
```

___

###merge()
*source*

```php
// laravel/framework/src/Illuminate/Support/Collection.php

/**
 * Merge the collection with the given items.
 *
 * @param  \Illuminate\Support\Collection|\Illuminate\Support\Contracts\ArrayableInterface|array  $items
 * @return static
 */
public function merge($items)
{
	return new static(array_merge($this->items, $this->getArrayableItems($items)));
}
```

*example*

```php
// app/routes.php

Route::get('merge', function()
{
    $a = Group::where('name','LIKE','%laravel%')
        ->get();
    $b = Group::where('description','LIKE','%laravel%')
        ->get();

    $result = $a->merge($b);

    $result->each(function($instance)
    {
        echo $instance->name.'<br/>';
    });
});
```

* We have created a new set of group names combining the two result sets `$a` and `$b`

___

###slice()

```php
// laravel/framework/src/Illuminate/Support/Collection.php

/**
 * Slice the underlying collection array.
 *
 * @param  int   $offset
 * @param  int   $length
 * @param  bool  $preserveKeys
 * @return static
 */
public function slice($offset, $length = null, $preserveKeys = false)
{
	return new static(array_slice($this->items, $offset, $length, $preserveKeys));
}
```

*example 1*

```php
// app/routes.php

Route::get('slice',function()
{
    $collection = Group::all();
    $result = $collection->slice(2,4);
    $result->each(function($instance)
    {
        echo $instance->name.'<br/>';
    });
});
```

* We create a new collection $result using the `slice()` method.
* The first parameter is the position that the new set will start.  In the example we are starting at the third position of the original collection array.
* The second parameter is the length of the collection.

*example 2 (using a negative offset)*

```php
// app/routes.php

Route::get('slice',function()
{
    $collection = Group::all();
    $result = $collection->slice(-2,4);
    $result->each(function($instance)
    {
        echo $instance->name.'<br/>';
    });
});
```

* When we use a negative value for the offset the slice will start at the position of two from the end of the collection.

___

###isEmpty()

```php
// laravel/framework/src/Illuminate/Support/Collection.php

/**
 * Determine if the collection is empty or not.
 *
 * @return bool
 */
public function isEmpty()
{
	return empty($this->items);
}
```

*example*

```php
// app/routes.php

Route::get('isempty', function() {

    // This query will return items
    $a = Groupie::all();

    // This query will not return items
    $b = Groupie::where('name', '=', 'ZF2')
        ->get();

    var_dump($a->isEmpty());
    var_dump($b->isEmpty());
});
```

```php
// OUTPUT >>>		
					bool(false) 
					bool(true)
```

___

###toArray()

```php
// laravel/framework/src/Illuminate/Support/Collection.php

/**
 * Get the collection of items as a plain array.
 *
 * @return array
 */
public function toArray()
{
	return array_map(function($value)
	{
		return $value instanceof ArrayableInterface ? $value->toArray() : $value;

	}, $this->items);
}
```

*example*

```php
// app/routes.php

Route::get('toarray',function()
{
    $collection = Group::all();
    var_dump($collection->toArray());
});
```

* This will return a multi-dimensional array that represents the model instances from the collection and the data stored within each model instance.

___

###toJson()

```php
// laravel/framework/src/Illuminate/Support/Collection.php

/**
 * Get the collection of items as JSON.
 *
 * @param  int  $options
 * @return string
 */
public function toJson($options = 0)
{
	return json_encode($this->toArray(), $options);
}
```

*example*

```php
// app/routes.php

Route::get('json', function()
{
    $collection = Group::all();
    var_dump($collection->toJson());
});
```

* The `toJson()` method can be used to transform the collection into a JSON string which represents the collection's contents. 

___

###count()

```php
// laravel/framework/src/Illuminate/Support/Collection.php

/**
 * Count the number of items in the collection.
 *
 * @return int
 */
public function count()
{
	return count($this->items);
}
```

*example*

```php
// app/routes.php

Route::get('count',function()
{
    $collection = Group::all();
    var_dump($collection->count());
});
```

* We can use the `count()` method to count the number of model instances.


____



###update()
```php
/** Model::update()
 * 
 * Update the model in the database.
 *
 * @param  array  $attributes
 * @return bool|int
 */
```

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
```

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
```

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



###whereNotNull()

```php
// app/routes.php

Route::get('wherenotnull', function()
{
	return Group::whereNotNull('column_name')
		->get();
});
```

* If we do not have any `NULL` values in our database, this will return all database records.
* We can also use the `orWhereNotNull()` method to provide alternative constraints.

___

###orderBy()

```php
// app/routes.php

Route::get('order', function()
{
    return Groupie::where('id','>','2')
        ->orderBy('id')
        ->get();
});
```

* The first parameter of `orderBy('column_name')` is the name of the column that we wish to order by.
* The default order is ascending. 
* Use `orderBy('id','desc')` if we want descending order.

___

###take()

```php
// app/routes.php

Route::get('take', function()
{
    return Group::take(3)
        ->orderBy('id')
        ->get();
});
```

* The parameter passed to the `take()` method is the number of result rows that we wish to limit the query to.

___

###ship()

```php
// app/routes.php

Route::get('skip', function()
{
    return Groupie::take(3)
        ->skip(1)
        ->orderBy('id')
        ->get();
});
```

* The `skip()` method takes a single parameter to provide an offset.
* In the example the first row will be discarded from the result set.

___

###magic *where()* queries

```php
// app/routes.php

Route::get('magic',function()
{
   return Groupie::whereName('friends')
        ->get();
});
```

* `whereName('friends')` is the equivalent to `where('name','=','friends')`
* The `name` column becomes `whereName()`.
* For snake_cased columns `group_name` becomes `whereGroupName()`

___

###using *scope methods()* to simplify common queries


```php
// app/models/Group.php

class Group extends Eloquent {

    public $table = 'groups';

    public $item = '%laravel%';

    public function scopeFindLaravel($query)
    {
        return $query->where('description','LIKE', $this->item);
    }
} 
```

```php
// app/routes.php

Route::get('laravel-search',function()
{
    return Group::findLaravel()->get();
});
```

* We can define a `scopeMethod($query)` within our model. 
* For queries that we intend to perform very often, we are able to add a method to our model class.

___




Route::get('/all-users', function()
{
    $users = User::all()->toArray();
    var_dump ($users);
});

OUTPUT>>> This returns an multidimensional array.

___

Route::get('/all-users2', function()
{
    $users = User::all();
    var_dump($users);
});

OUTPUT>>> This returns a collection object with a single 'items' property.  The 'items' property is an array of all the model objects.



____


Route::get('/array-access', function()
{
    $users = User::all();
    var_dump($users[0]);
});

OUTPUT>>> this will return an object from the `items` property array at position [0]

This is using the ArrayAccess interface which is basically allowing us to directly access the `items` property array of objects as though the collection was the `items` array itself.

___



Route::get('/countable', function()
{
    $users = User::all();
    return count($users);
});

This is using the Countable interface which is basically allowing us to count the number of objects in the `items` property array.  SO basically it is treating the `items` property array as though it is the object itself.

___

Jsonable Interface

Route::get('/JsonableInterface', function()
{
    $users = User::all()->toJson();
    return $users;
});

This will return a Json array 

___

###accessing a single object from the collection array of objects

Route::get('/first-user', function()
{
    $users = User::all();
    var_dump($users->first());
    return $users->first();
});

This will place all instances of user into the `items` property array of the $users collection object.  Eloquent will then allow us to access the `items` property by directly calling methods on the $users object.  This example will return the first $user as an object.

(more: accessing an instance of the model and then casting it to an array)
___

###accessing an instance of the model and then casting it to an array

```php
Route::get('/first-user-toArray', function()
{
    $users = User::all();
    var_dump($users->first()->toArray());
});
```
This will return the first user as an array.

(extend: accessing a single object from the collection array of objects) 

___

###converting a standard array into a Collection object

Route::get('/convert-array-to-collection', function()
{
    $friends = array(
        0 => array(
            'name' => 'Andy'
        ),
        1 => array(
            'name' => 'Peter'
        ),
        2 => array(
            'name' => 'Paul'
        )
    );

    $friends = new Illuminate\Support\Collection($friends);

    return $friends->first();
});


(source: https://laracasts.com/lessons/arrays-on-steroids video-08:20)

By creating a $friends object which is an instance of the COllection class, we are able to access the Collection class in some useful ways.

(extend: accessing a single object from the collection array of objects)

___

###using Collection class to splice a standard array


Route::get('/convert-array-to-collection-and-splice', function()
{
    $friends = array(
        0 => array(
            'name' => 'Andy'
        ),
        1 => array(
            'name' => 'Peter'
        ),
        2 => array(
            'name' => 'Paul'
        )
    );

    $friends = new Illuminate\Support\Collection($friends);
    $newFriends = $friends->splice(1,1);
    return array($friends,$newFriends);
});

* The `splice()` method in the example will remove the `object 1` from the $friends collection object and will be inserted into a new $newFriends collection object.


(extend: converting a standard array into a Collection object)

(source: https://laracasts.com/lessons/arrays-on-steroids video-09:40)

___


