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
$table->integer('qty',1,1);					// int(10) auto_increment   unsigned
$table->integer('qty',0,1);					// int(10) unsigned
  

											// Note: signed int (-2,147,483,648 to 2,147,483,647)
											//		 unsigned int (0 to 4,294,967,295)
```

```php
$table->bigInteger('qty');					// bigint(20)

											// Note: signed bigint (+/- 9,223,372,036,854,775,808/7)
											//		 unsigned int (0 to 18,446,744,073,709,551,615)
```

```php
$table->mediumInteger('qty');				// mediumint(9)

											// Note: signed int (-8,388,608 to -8,388,607)
											//		 unsigned int (0 to 16,777,215)
```

```php
$table->smallInteger('qty');				// smallint(6)

											// Note: signed int (-32,768 to -32,767)
											//		 unsigned int (0 to 65,535)
```

```php
$table->tinyInteger('qty');					// tinyint(1)

											// Note: signed int (-128 to 127)
											//		 unsigned int (0 to 255)
```

```php
$table->float('number');					// float(8,2) 
$table->float('number',10,4);				// float(10,4)
```

```php
$table->decimal('number');					// decimal(8,2) 
$table->decimal('number',10,4);				// decimal(10,4)
```

```php
$table->boolean('name');					// tinyint(1)

											// Note: 1 or 0 (true/false)
```

```php
$allow = array('Admin','Member','Guest');
$table->enum('status',$allow);				// enum('Admin','Member','Guest')   notNULL
```

```php
$table->date('join_date');						// date
```

```php
$table->dateTime('join_date');					// datetime
```

```php
$table->time('post_time');						// time			
```

```php
$table->timestamp('join_date');					// timestamp
```

```php
$table->binary('image');						// blob
```

```php
$table->timestamps();							// timestamp  

												// Note: creates two fields 'created_at' and 'updated_at'
```

```php
$table->softDeletes();							// timestamp  NULLable

												// Note: creates the field 'deleted_at'
```

											