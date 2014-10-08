###opening forms

```php
// app/routes.php

Route::get('form',function()
{
	return View::make('form');
});
```

The above route will pass us to our form.blade.php file.

```html
<!-- app/views/form.blade.php -->

<form action="{{ url('relevant/route') }} method="POST" >
</form>
```

which is the same as

```html
<!-- app/views/form.blade.php -->

{{ Form::open(array('url' => 'relevant/route') }}
{{ Form::close() }}
```




* When using `Form::open()` and `Form::close()` the method is set to `POST` as default
* Using `Form::open()` and `Form::close()` will automatically have a `_token` added as a hidden input into the Page Source.


```html
<!-- Page Source when using Form::open() & Form::close() -->

<form method="POST" action="http://laravel_testlab/relevant/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="AVmEdtqpm17kCxWighHOa1993moVaX5Gott8hZrP">
</form>
```

___

### overriding default parameters in *Form::open()*

```html
<!-- views/form.blade.php -->

{{ Form::open(array(
    'url' => 'relevant/route',
    'method' => 'GET',
    'accept-charset' => 'UTF-16'
    ))
}}
{{ Form::close() }}
```

```html
<!-- Page Source -->

<form method="GET" action="http://laravel_testlab/relevant/route" accept-charset="UTF-16">
</form>
```

* When using GET, there is no _token input tag.

___

### setting *'method' => 'DELETE'* in *Form::open()*


```html
<!-- views/form.blade.php -->

{{ Form::open(array(
    'url' => 'relevant/route',
    'method' => 'DELETE'
    ))
}}
{{ Form::close() }}
```

```html
<!-- Page Source -->

<form method="POST" action="http://laravel_testlab/relevant/route" accept-charset="UTF-8">
	<input name="_method" type="hidden" value="DELETE">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
</form>
```

* In HTML4 there are only the HTTP verbs 'POST' and 'GET', so therefore in order to maintain compatibility between HTML4 and HTML5, Laravel has created a hidden input called "_method" which can allow our code to take the appropriate action.

___


