###Using with PHP code


```php
{{ date(‘d/m/y’) }}
```

* We can use any PHP code within the curly braces
* We don’t need to provide a closing semi-colon

___



###Escape dangerous code

```html
<h1>{{{ ‘<script>alert(“This is an XSS attack”)</script>’ }}}</h1>
```

___

###@if.....@elseif.....@endif

```php
@if ($car == ‘red’)
   <p>The car is red!</p>
@elseif ($car == ‘blue)
   <p>The car is blue!</p>
@else
   <p>I don’t know what color the car is!!</p>
@endif
```


___


###@foreach.....@endforeach

```php
@foreach ($items as $item)
        <p>{{ $item }}
@endforeach
```

____


###@for.....@endfor

```php
@for (I = 0, $i < 999, $i++)
        <p>Even {{ $i }} red roses, aren’t enough!</p>
@endfor
```

___


###@while.....@endwhile

```php
@while (isDaytime($time))
        <p>The sun is high in the sky</p>
@endwhile
```

___


###@unless.....@endunless
```php
@unless (afterSixOclock($time))
        <p>Keep sleeping!</p>
@endunless
```


____


###@include

```html
@include(folder.file)
```

* Include one blade view inside another using **@include**.  

* This allows us to break our templates into even smaller pieces so that we can avoid repeating ourselves as much as possible.  

___


###@yield

```html
@section(‘content’)
     …. This is the content.........
@stop 
```



* **@yield(‘content’)** statement is used to place **child** content directly into the **parent** view.

___


###@section.....@show

```html
@section(‘head’)
      <link rel=”stylesheet” href=”style.css” />
@show
```           

* A default stylesheet can be provided.  

* The default stylesheet will not be used if the child has a stylesheet.


___

###@section.....@parent.....@show

```html
@extends(‘layouts.main’)
@section(‘head’)
	@parent
        <link rel=”stylesheet” href=”another.css” />
@stop
```

```html
OUTPUT>>>
        <head>
                <link rel=”stylesheet” href=”style.css” />
                <link rel=”stylesheet” href=”another.css” />
        </head>
```
	
___
	
	
	
###Comment

```html
{{-- This is a blade comment --}}
```

___
