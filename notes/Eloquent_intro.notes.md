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

	