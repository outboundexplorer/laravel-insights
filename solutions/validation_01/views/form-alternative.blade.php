<!-- app/views/form-alternative.blade.php -->
<!-- 
This alternative version to the form.bade.php file shows another way of displaying error messages. 
Make sure to change the route.php file to point to this form.
-->

@extends('layout')

@section('content')
    <div>
        {{ Form::open(array('url' => 'form/route')) }}

		<ul class = "errors">
			@foreach($errors->all() as $error)
				<li> {{ $error }} </li>
			@endforeach
        </ul>
		<div>
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username') }}

        </div>

        <div>
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email') }}
        </div>

        <div>
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
        </div>

        <div>
            {{ Form::label('password_confirmation','Password confirmation') }}
            {{ Form::password('password_confirmation') }}
		</div>
        <div>
            {{ Form::submit() }}
        </div>
    </div>
@stop