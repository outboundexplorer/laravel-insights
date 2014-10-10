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

###defining a named route in *Form::open()*

```php
// app/routes.php

Route::get('new/form/test', function()
    {
        return View::make('myform');
    }
);

Route::post('new/form/test', array(
    'as' => 'my_named_route',
    'uses' => 'FormController@save'
));
```

```html
<!-- views/myform.blade.php -->

{{ Form::open(array('route' => 'my_named_route')) }}
{{ Form::close() }}
```

```html
<!-- Page Source of myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/new/test" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
</form>
```

* By using `'route' => 'my_named_route'` from the Page Source we can see that the form action is still the URL identified in `routes.php` by the URI `'new/form/test'`.

___
### defining an action in *Form::open()*

```php
// app/routes.php

Route::get('/my/new/test', function()
    {
        return View::make('myform');
    }
);


Route::post('/my/new/test', array(
    'as' => 'my_named_route',
    'uses' => 'FormController@action'
));
```

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('action' => 'my_named_route')) }}
{{ Form::close() }}
```

```html
<!-- Page Source of myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/new/test" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
</form>
```

* From the Page Source we can see that the form action is still the URL identified in `routes.php` by the URI `'new/form/test'`.

___

###Form::label()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('action' => 'FormController@action')) }}
    {{ Form::label('username', 'Username') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/new/test" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="username">Username</label>
</form> 
```

* A label has now been created that will be used to match an `<input>` tag called `"username"`
* Note that without the relevant `<input>` tag, nothing will be output to the screen.

___

###Form::text()

```php
// app/routes.php

Route::get('/my/form/route', function()
{
    return View::make('myform');
});

Route::post('/my/form/route',...));
```

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username') }}
{{ Form::close() }}
```


```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="username">Username</label>
    <input name="username" type="text" id="username">
</form>
```

######adding an optional second parameter to add a default value for the input.

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username','default value') }}
{{ Form::close() }}
```


```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="username">Username</label>
    <input name="username" type="text" value="default value" id="username">
</form>
```

######adding further attributes with an array() as an optional third parameter

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username','default value', array('class' => 'input-field')) }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="username">Username</label>
	<input class="input-field" name="username" type="text" value="default value" id="username">
</form>
```

* If we need to add additional attributes to the third parameter array(), but do not need a default value for the `value` attribute, we can set it to null 

```html
Form::text('username',null,array('class' => 'form-field'))
```

___

###Form::textarea()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{ Form::label('username', 'Comments') }}
    {{ Form::textarea('comments',null,array('placeholder' => 'Please enter your comments here','class' => 'form-field')) }}
{{ Form::close() }}
```

```html
<!-- Page Source myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="comments">Comments</label>
    <textarea placeholder="Please enter your comments here" class="form-field" name="comments" cols="50" rows="10" id="comments"></textarea>
</form>
```

* If a value is entered as the second parameter, this will override any attributes placed in the final parameter array().  (i.e. it is pointless to have a `'value'` or `'placeholder'` attribute if the second parameter is not `null`.
* Laravel has automatically added default parameters  `cols="50"` and `rows="10"` (we can override these by adding `'key' => 'value'` pairs to the third parameter array().

___

###Form::password()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{ Form::label('password','Password') }}
    {{ Form::password('password') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="password">Password</label>
    <input name="password" type="password" value="" id="password">
</form>
```

* Additional parameters can be added using an array().  (Note that in this case the final array() is immediately after the first parameter.)

___

###Form::checkbox()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{ Form::label('checkbox','Remember Me') }}
    {{ Form::checkbox('checkbox', 'yes', true) }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="checkbox">Remember Me</label>
    <input checked="checked" name="checkbox" type="checkbox" value="yes" id="checkbox">
</form>
```

* The second parameter is used to define the value when the box is checked and is an optional attribute. (The default value for a checked box is `'1'`
* The third parameter is also an optional attribute and can be used to determine whether the checkbox is initially checked (`true`) or unchecked (`false`). (If this parameter is not included, the checkbox is unchecked as default).
* If further attributes are required, these can be set using an array() for the 4th parameter.

____


###Form::radio()

```html
<!-- app/views/myform.blade.php -->
{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::label('nation','Nationality') }}
    {{  Form::radio('nation','british', true) }} British
    {{  Form::radio('nation','american') }} American
    {{  Form::radio('nation','australian') }} Australian
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="nation">Nationality</label>
    <input checked="checked" name="nation" type="radio" value="british" id="nation"> British
    <input name="nation" type="radio" value="american" id="nation"> American
    <input name="nation" type="radio" value="australian" id="nation"> Australian
</form>
```

* All radio buttons have the same name attribute for the first parameter.
* The second parameter is the value that is given to each radio button should it be checked.
* We can include an optional third parameter to check a radio box as default. (only one radio box can be checked at any one time)

____

###Form::select()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::label('language','Language') }}
    {{  Form::select('language' ,array(
            'english' => 'English',
            'spanish' => 'Spanish',
            'chinese' => 'Chinese'
            ), 'chinese') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="language">Nationality</label>
    <select id="language" name="language">
		<option value="english">English</option>
		<option value="spanish">Spanish</option>
		<option value="chinese" selected="selected">Chinese</option>
	</select>
</form>
```

* `'name' => 'value'` pairs are placed into an array for the second parameter to represent the different options.
* We can include an optional third parameter to select an option as default. (only one select option can be chosen at one time).
* It is possible to add additional attributes with a fourth argument.

____

###Form::select() organized by category

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::label('food','Favourite food') }}
    {{  Form::select('food' ,array(
            'Asian' => array(
                'chinese' => 'Chinese',
                'japanese' => 'Japanese',
                'korean' => 'Korean'
            ),
             'European' => array(
                'french' => 'French',
                'spanish'=> 'Spanish'
                )
        ))  }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="food">Favourite food</label>
    <select id="food" name="food">
		<optgroup label="Asian">
			<option value="chinese">Chinese</option>
			<option value="japanese">Japanese</option>
			<option value="korean">Korean</option>
		</optgroup>
		<optgroup label="European">
			<option value="french">French</option>
			<option value="spanish">Spanish</option>
		</optgroup>
	</select>
</form>
```

* When creating an `<optgroup>` a name is not given in the array, instead we only supply the value.

___

###Form::email()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::label('email','Email') }}
    {{  Form::email('email') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="email">Email</label>
    <input name="email" type="email" id="email">
</form>
```

* It is possible to pass an optional default value `Form::email('email','andyroddam@gmail.com')`
* We can also pass an array() of attributes into the third parameter.

___

###Form::file()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array(
        'url' => 'my/form/route',
        'files' => true
      ))
}}
    {{  Form::label('profile_image','Profile image') }}
    {{  Form::file('profile_image') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8" enctype="multipart/form-data">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <label for="profile_image">Profile image</label>
    <input name="profile_image" type="file" id="profile_image">
</form>
```

* When working with files the `'files'` parameter must be set `Form::open(array('url' => 'my/form/route', 'files' => true))`

___

###Form::hidden()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::hidden('hidden_name','hidden_value') }}
{{ Form::close() }}


```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <input name="hidden_name" type="hidden" value="hidden_value">
</form>
```

___

###Form::submit()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::submit('Submit') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <input type="submit" value="Submit">
</form>
```

___

###Form::button()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::button('Join Us!') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <button type="button">Join Us!</button>
</form>
```

___

###Form::image()

```html
<!-- app/views/myform.blade.php -->
{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::image('storage/images/myImage.jpg', 'my_button') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <input src="http://laravel_testlab/storage/images/myImage.jpg" name="my_button" type="image">
</form>
```



* If we do not provide a complete URL, then the application's URL will be used.
* We can use the optional second parameter to name the input field.
* We can include additional parameters as an array() in the optional third parameter.  

___ 

###Form::reset()

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::reset('Refresh data') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="TdR23PJdUMlcz5QABbtA9IIdOKtUojuk1razGdlb">
    <input type="reset" value="Refresh data">
</form>
```

___

###Form::macro()

```php
// app/start/global.php

Form::macro('my_macro', function()
{
    return '<input type="input_type" value="default_value">';
});
```

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::my_macro() }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="lFZAk2EfMrPvLBArOfsps0lgyFR9KFx4PfeDM5Zp">
    <input type="input_type" value="default_value">
</form>
```

* The custom `Form::macro()` is defined in the global namespace which is included by being placed in the `global.php` file.
* The first parameter is the name given to the custom macro.
* The second parameter is a Closure which defines the contents of the macro.
* We are able to access the macro in our blade file the same way that we access the other Form methods.
* Note that as this has now been placed in the global namespace, this is not really following with OOP design principles.  An alternative might be to create a new class and extend the FormBuilder class.  We can then create a new public function with the name of our macro.  We will also then be able to call on this as a Form facade method.

___

###creating a Form::macro() with parameters

```php
// app/start/global.php

Form::macro('my_macro', function($name, $type, $value, $count = 10)
{
    $build = array();
    $start = 1;

    For($i = 1; $i<$count; $i++ )
    {
        $build[] = sprintf('<input name="%s" type="%s" value="%s" index="%s">', $name, $type, $value, $start);
        $start += 1;
    }

    return implode("<br/>", $build);
});
```

```html
<!-- app/views/myform.blade.php -->

{{ Form::open(array('url' => 'my/form/route')) }}
    {{  Form::my_macro('my_name','text', 'my_value') }}
{{ Form::close() }}
```

```html
<!-- Page Source for myform.blade.php -->

<form method="POST" action="http://laravel_testlab/my/form/route" accept-charset="UTF-8">
	<input name="_token" type="hidden" value="lFZAk2EfMrPvLBArOfsps0lgyFR9KFx4PfeDM5Zp">
    <input name="my_name" type="text" value="my_value" index="1"><br/>
	<input name="my_name" type="text" value="my_value" index="2"><br/>
	<input name="my_name" type="text" value="my_value" index="3"><br/>
	<input name="my_name" type="text" value="my_value" index="4"><br/>
	<input name="my_name" type="text" value="my_value" index="5"><br/>
	<input name="my_name" type="text" value="my_value" index="6"><br/>
	<input name="my_name" type="text" value="my_value" index="7"><br/>
	<input name="my_name" type="text" value="my_value" index="8"><br/>
	<input name="my_name" type="text" value="my_value" index="9">
</form>
```

* We have now created a new `Form::macro()` that can take 4 arguments (the 4th argument is optional as we have provided a default).
* All required arguments must be provided when we call the macro in myform.blade.php `Form::my_macro('my_name','text','my_value')`.
* Note that we require the macro to output a string (any arrays must be converted into a string).

___