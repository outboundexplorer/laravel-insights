(source: https://laracasts.com/lessons/laravel-and-mandrill-in-minutes)


```php
// app/config/local/mail.php
'driver' => 'mandrill',

'from' => array('address' => 'andybendyman@hotmail.com', 'name' => 'Andy Roddam'),
```

```php
composer require guzzlehttp/guzzle
```

```php
// app/config/services.php

'mandrill' => array(
	'secret' => $_ENV['MANDRILL_SECRET'],
),
```

```php
// .env.local.php

<?php

return array(
    'DB_PASSWORD' => 'secret',
    'MANDRILL_SECRET' => 'LZYCaIJM5Nc7T5Nw5Nls7Q'
	
);
```

```php
// app/bootstrap/start.php

$env = $app->detectEnvironment(function()
{
    return getenv('APP_ENV') ?: 'local';
});
```

* we basically need to check that we have environment support set up.




```php
// app/routes.php

Route::get('send-email', function()
{
    Mail::send('emails.test', [], function($message)
    {
        $message->to('andyroddam@gmail.com')->subject('Test Email');
    });
});
```

```php
// app/views/emails/test.blade.php

<h1>It works!!</h1>
```