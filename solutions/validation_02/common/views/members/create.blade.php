@extends('layouts.master')

@section('content')

    <h1>Create new user</h1>

    {{ Form::open(array('route' => 'members.store')) }}
        <div>
            {{ Form::label('username', 'Username') }}
            {{ Form::text('username') }}
            {{ $errors->first('username', '<span class=error>:message</span>') }}
        </div>

        <div>
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
            {{ $errors->first('password', '<span class=error>:message</span>') }}
        </div>

        <div>
            {{ Form::submit('Submit')   }}
        </div>

    {{ Form::close() }}


@stop