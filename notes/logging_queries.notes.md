

composer require itsgoingd/clockwork --dev





Once Clockwork is installed, you need to register Laravel service provider, in your app/config/app.php:
```php
// app/config.app.php

'providers' => array(
    ...
    'Clockwork\Support\Laravel\ClockworkServiceProvider'
)
```

When using Laravel 5, you need to add Clockwork middleware, in your app/Providers/AppServiceProvider.php:
```php
// app/Providers/AppServiceProvider.php

protected $stack = [
    'Clockwork\Support\Laravel\ClockworkMiddleware',
    ...
]
```

___

// app/config/app.php

'aliases' => array(
    ...
    'Clockwork' => 'Clockwork\Support\Laravel\Facade',
)

___

To add your controller's runtime to timeline, add following to your base controller's constructor:

```php
// app/controllers/BaseController.php

class BaseController extends Controller {

	public function __construct()
    {
            $this->beforeFilter(function()
            {
                Event::fire('clockwork.controller.start');
            });
            
            $this->afterFilter(function()
            {
                Event::fire('clockwork.controller.end');
            });
    }

	...

}
```    



Route::get('all-users',function()
{

    Clockwork::startEvent('query', 'Simple Query');
    $users = User::all();
    foreach($users as $user)
    {
        Clockwork::info($user->email);
    }
    Clockwork::endEvent('query');

    return $users;
});



Other:

we can bascially use startEvent() and endEvent() to wrap the query that we want.  This will then basically just simply calculate the amount of time needed between the two positions in the code.

Clockwork::startEvent('query','Query 1');
$link = Link::where('url','=',Input::get('link'))
			->first();
Clockwork::endEvent('query');

