###Column Types

```php
$table->increments('id');					// id  int(10) unsigned 	PRIMARY KEY		auto_increment

											// Note: Do not change the id field
```

```php
$table->bigIncrements('id');				// id	bigint(20) unsigned	PRIMARY KEY		auto_increment

											// Note: Do not change the id field
```

```php
$table->string('name');						// name varchar(255) 
$table->string('name',60);					// name varchar(60)
```