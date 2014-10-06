
#### Code Bright: 21 chapter series (tags: Laravel)



#4 - Basic Routing
http://daylerees.com/codebright/basic-routing 

Introduction to understanding URLs within your application and explains how **routes.php** are used to direct requests to your site.

####Insights
(1)	Routes are always declared using the Route class **Route::**

(2)	In the following snippet, the **Closure** will only be called when the URI matches **my/page** and the request is using the HTTP verb **GET**  (note: the URI **‘my/page’** and **‘/my/page’** are equivalent.) 

**Route::get(‘my/page’,function(){ return ‘Hello World’});** 




(3)	We can define as many routes as we like in the **routes.php** file

(4)	A **URI** containing only a forward slash **‘/’** will match the **URL** of the website.


(5)	A route placeholder can be used to dynamically map the requested URI allowing us to pass any $genre into the URI and be directed to the relevant $genre. For example:  

**Route::get(‘/books/{genre}’, function($genre){ return “Books in {$genre}“; });**  


(6)	It is possible to make the dynamic parameter optional by adding a question mark **?**.  The following example shows how routing activity can be controlled from a single pattern:
**Route::get(‘/books/{genre?}’, function($genre = null){ 
		if ($genre == null) return “This is the Book Index”;
		return “Books in the $genre category;
});**



#8 – Blade Templating
http://daylerees.com/codebright/blade 

Understanding and applying blade templating to your applications. 

####Insights
(1)	We can use any PHP code within the curly braces **{{ date(‘d/m/y’) }}** (note: we don’t need to provide a closing semi-colon)

(2)	Escape any dangerous code using tripe curly braces
**<h1>{{{ ‘<script>alert(“This is an XSS attack”)</script>’ }}}</h1>**

(3)	Code **@if** conditional clauses in the following way:
**@if ($something == ‘red’)
	<p>The car is red!</p>
@elseif ($something == ‘blue)
  <p>The car is blue!</p>
@else
	 <p>I don’t know what color the car is!!</p>
@endif**

(4)	Code **@foreach** statements as follows:
**@foreach ($items as $item)
	<p>{{ $item }}
@endforeach**

(5)	A **@for** conditional loop looks like follows:
**@for (I = 0, $i < 999, $i++)
	<p>Even {{ $i }} red pandas, aren’t enough!</p>
@endfor**

(6)	A **@while** conditional loop looks like follows:
**@while (isDaytime($time))
	<p>The sun is high in the sky</p>
@endwhile**

(7)	An **@unless** conditional clause is the direct opposite of the **@if** clause and can be used as follows:
**@unless (afterSixOclock($time))
	<p>Keep sleeping!</p>
@endunless**

(8)	It is possible to include one blade view into another using **@include**.  This allows us to break our templates into even smaller pieces so that we can avoid repeating ourselves as much as possible.  We call this blade helper function in the following way: **@include(folder.file)**

(9)	The **@yield(‘content’)** statement is used to place **@section(‘content’) …. This is the content.........@stop** directly into the page.

(10)	We can define default content in the parent template using **@section(‘content’)** and **@show**.  The child template (the content being inserted) can then choose to keep or override the content provided between the **@section(‘content’)** and **@show tags**. For example in the below example, the parent has the **style.css** stylesheet.  This will be used unless an alternative stylesheet is provided by the child which will then take precedence.

**@section(‘head’)
	<link rel=”stylesheet” href=”style.css” />
@show**

(11)	We use **@extends** to tell Blade which layout we will use to render our content.

(12)	When we are working with blade templates, the period character **(.)** represents a directory separator.  (note: there is no need to include the names blade.php when we are referencing the file template).  **@extends(‘layouts.main’)**

(13)	We can use the **@parent** marker to append to content in the parent template rather than replacing it in the relevant section. For Example:

**@extends(‘layouts.main’)
@section(‘head’)
	@parent
	<link rel=”stylesheet” href=”another.css” />
@stop**

What we will now see in the source code is:
**<head>
	  <link rel=”stylesheet” href=”style.css” />
	  <link rel=”stylesheet” href=”another.css” />
	</head>**

(14)	We can create comments in blade as follows **{{-- This is a blade comment --}}**
