<!-- app/views/form-alternative_02.blade.php -->

<!-- 
This alternative version to the form.bade.php file shows another way of displaying error messages. 
Make sure to change the route.php file to point to this form.  This version will display all
messages similar to form-alternative_01.blade.php will instead will display the messages next
to the relevant input box.
-->

@extends('layout')

@section('content')
    <div>
        {{ Form::open(array('url' => 'form/route')) }}


		<div>
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username') }}
            <ul class = "errors">
            	@foreach($errors->get('username') as $error)
            		<li> {{ $error }} </li>
            	@endforeach
            </ul>
        </div>

        <div>
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email') }}
            <ul class = "errors">
                @foreach($errors->get('email') as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>

        <div>
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
             <ul class = "errors">
                @foreach($errors->get('password') as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>

        <div>
            {{ Form::label('password_confirmation','Password confirmation') }}
            {{ Form::password('password_confirmation') }}
            <ul class = "errors">
                @foreach($errors->get('password_confirmation') as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
		</div>
        <div>
            {{ Form::submit() }}
        </div>
    </div>
@stop