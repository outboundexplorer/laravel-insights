(source: https://laracasts.com/lessons/environments-and-configuration)


###checking as to which environment we are operating with
(video-02:00)

```php
// app/routes.php

Route::get('environment', function()
{
    dd(App::environment());
});
```

___

###modifying the environment
(video-02:30)

$env = $app->detectEnvironment(array(

	'local' => array('homestead'),

));

* This will make the environment local when we are using Vagrant



$env = $app->detectEnvironment(array(

	'local' => array('localhost'),

));

* This will make the environment local when we are working with a server installed on localhost.  If we are working with a server installed on a VM (like we do when we use Vagrant), then this will be a production environment.


$env = $app->detectEnvironment(array(

	'local' => array('your-machine-name'),

));

* This will specify that the environment is a production environment.
* However, by changing this will only provide the correct environment from the browser, it not necessarily offer the correct environment from the command line.





___


###defining the environment in a way that will be correct for the command line and the browser

(video-04:50)

```php
// app/bootstrap/start.php

;
$env = $app->detectEnvironment(function()
{
    return getenv('ENV') ?: 'development';
});
```

* By using a closure, we are able to define the environment 
independent of where the call is made from.  
* By setting the default as development, we are able to check for whether ENV has been set and if not use the development default.
* Production server may allow for us to set this variable on the server machine.
* I feel that there is a weakness to this method could allow for a development env to be set up on the main servers? ENV must be set on the production servers as production and this will mean that there should not be a problem with this.  Note, we could set the ENV with the following code `putenv('ENV=production')`


___


###checking for specific config settings
(video-6:45)

```php
// app/routes.php

Route::get('get-mysql-settings', function()
{
    dd(Config::get('database.connections.mysql'));
});
```

```php
// app/config/local/database.php

<?php

return array(


	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'homestead',
			'username'  => 'homestead',
			'password'  => 'secret',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		)
	),

);
```

* Note that we do not to include all of the information from the production version, only the information that we wish to have different settings for.

___

###making some configurations private



$env = $app->detectEnvironment(function()
{
    return getenv('APP_ENV') ?: 'local';
});



```php
// app/config/local/database.php

'mysql' => array(
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'database'  => 'homestead',
	'username'  => 'homestead',
	'password'  => getenv('DB_PASSWORD'),
					(or $_ENV['DB_PASSWORD'])
					(or $_SERVER['DB_PASSWORD'])
	'charset'   => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => '',
)
```

```php
// .env.local.php

<?php

return array(
    'DB_PASSWORD' => 'secret'
);
```

```php
// .gitignore

/bootstrap/compiled.php
/vendor
composer.phar
composer.lock
.env.*.php
.env.php
.DS_Store
Thumbs.db
```

This method is ideal for working on local development.  For production, this could also be done using a .env.php file, but this must also be placed on the server and must also be placed in the .gitignore file.  However, generally the server should allow for certain ENV variables to be set by the administrator, these can be then set easily without needing to hard-code them into any code.



___

