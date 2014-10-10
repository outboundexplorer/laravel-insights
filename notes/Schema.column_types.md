###Column Types

```php
$table->increments('id');					// int(10) unsigned 	PRIMARY KEY		auto_increment

											// Note: Do not change the id field
```

```php
$table->bigIncrements('id');				// bigint(20) unsigned	PRIMARY KEY		auto_increment

											// Note: Do not change the id field
```

```php
$table->string('name');						// varchar(255) 
$table->string('name',60);					// varchar(60)
```

```php
$table->string('body');						// text
``` 

```php
$table->integer('qty');						// int(11) signed  

											// Note: signed int (-2,147,483,648 to 2,147,483,647)
											//		 unsigned int (0 to 4,294,967,295)
```

```php
$table->bigInteger('qty');					// bigint(20)

											// Note: signed bigint (+/- 9,223,372,036,854,775,808 (or 807))
											//		 unsigned int (0 to 18,446,744,073,709,551,615)
```


