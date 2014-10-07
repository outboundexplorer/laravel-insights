@extends('layouts.main')

@section('content')

    {{ Form::open(array('route' => 'create.post')) }} <!-- This could also be 'url' => 'account/create' -->

        <div>
           {{ Form::text('email',null,array('placeholder' => 'Email', 'value' => Input::old('email') )) }}
           @if($errors->has('email'))
                {{ $errors->first('email') }}
           @endif

        </div>

        <div>
            {{ Form::text('username',null,array('placeholder' => 'Username', 'value' => Input::old('username') )) }}
              @if($errors->has('username'))
                 {{ $errors->first('username') }}
              @endif
        </div>

        <div>
            {{ Form::password('password',array('placeholder' => 'Password')) }}
            @if($errors->has('password'))
                {{ $errors->first('password') }}
            @endif
        </div>

        <div>
            {{ Form::password('password_confirmation',array('placeholder' => 'Password again')) }}
            @if($errors->has('password_confirmation'))
                {{ $errors->first('password_confirmation') }}
            @endif
        </div>

        <div>
            {{ Form::submit('Login') }}
        </div>
    <!--
    note: no need to add a token as this has already been automatically created by the Form
    note: the token helps to prevent CSRF
    -->
    {{ Form::close() }}
@stop
