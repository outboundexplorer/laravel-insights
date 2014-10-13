###migrate:make  (--create)

```php
php artisan migrate:make create_users_table --create=users
```

This will create the following boilerplate:

```php
<?php
// app/database/migrations/create_users_table.php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}
```

___

###migrate:make  (--table)

```php
php artisan migrate:make add_username_to_users --table=users
```

```php
<?php
// app/database/migrations/add_username_to_users.php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameToUsers extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			//
		});
	}

	public function down()
	{
		Schema::table('users10', function(Blueprint $table)
		{
			//
		});
	}
}
```

___

###migrate

```php 
php artisan migrate
```

* Run all pending migrations.

___

###migrate:refresh

```php 
php artisan migrate:refresh
```

* Revert all migrations and then run them once more.


___

###migrate:rollback

```php 
php artisan migrate:rollback
```

* Rollback the last migration or set of migrations.

___

###migrate:reset

```php
php artisan migrate:reset
```

* Rollback all migrations.

___

###migrate   (--database=mysql)

```php 
php artisan migrate --database=mysql
```

* Migrations will be performed on the connection that we aliased as mysql within the configuration file.

___

###migrate  (--pretend)

```php
php artisan migrate --pretend
```

* Display the SQL query without implementing to the database









