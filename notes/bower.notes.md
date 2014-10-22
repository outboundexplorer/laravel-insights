```php
// install bower globally

npm install -g bower
```

```php
// list available bower commands

bower
```

```php
// search for available packages

bower search jquery
```

```php
// install jquery in default location

bower install jquery
```

```php
// install jquery in default location and save dependecies to bower.json

bower install jquery -S
```

```php
// designate the download location of the jquery package by editing the bowerrc.json file

{
    "directory": "public/js/vendor/"
}
```

```php
// create a bower dependency manager file

// bower.json
{
	"name": "My Site"
}
```

```php
// install all dependencies as stated by bower.json

bower install
```