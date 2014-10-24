###"classmap" array

```php
// composer.json

"autoload": {
		"classmap": [
			"app/commands",
			"app/controllers",
			"app/models",
			"app/database/migrations",
			"app/database/seeds",
			"app/tests/TestCase.php"
		]
	},
```

* `"classmap"` array will basically load every single class file within the directories that are listed.
* If a single class file name is given then that will also be loaded.

___



```php
// composer.json

"autoload": {
	"files": [
		"app/helpers.php"
	]
},
```

* `"files"` array is used to load non-class files.


___


```php
// composer.json

"autoload": {
	"psr-0": {
		"Insiite": "app/"
	}
},
```


___


```php
// composer.json

"autoload": {
	
	"psr-4": {
		"Insiite\\": "app/Insiite"
	}
},
```

* When we are using `psr-4`, we need to follow our namespace with two backslashes `\\`.



___

###example *composer.json* file

```php
// composer.json

"autoload": {
	"classmap": [
		"app/commands",
		"app/controllers",
		"app/models",
		"app/database/migrations",
		"app/database/seeds",
		"app/tests/TestCase.php"
	],

	"psr-4": {
		"Insiite\\": "app/Insiite"
	},

	"files": [
		"app/helpers.php"
	]
},
```
