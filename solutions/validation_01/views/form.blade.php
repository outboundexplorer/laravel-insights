<!-- app/views/form.blade.php -->

@extends('layout')

@section('content')
    <div>
        {{ Form::open(array('url' => 'form/route')) }}

        <div>
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username') }}

            <!-- check to see whether any errors have been received -->
            @if($errors->has('username'))
                <!-- with errors >>> retrieve the first record of data -->
                {{ $errors->first('username') }}
            @endif
        </div>

        <div>
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email') }}
            @if($errors->has('email'))
                {{ $errors->first('email') }}
            @endif
        </div>

        <div>
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
            @if($errors->has('password'))
                {{ $errors->first('password') }}
            @endif

        </div>

        <div>
            {{ Form::label('password_confirmation','Password confirmation') }}
            {{ Form::password('password_confirmation') }}
            @if($errors->has('password_confirmation'))
                {{ $errors->first('password_confirmation') }}
            @endif</div>
        <div>
            {{ Form::submit() }}
        </div>
    </div>
@stop