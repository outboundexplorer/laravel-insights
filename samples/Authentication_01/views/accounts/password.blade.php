@extends('layouts.main')

@section('content')
    {{ Form::open(array('route' => 'change-password.post')) }}

    <div>
        {{ Form::password('old_password', array('placeholder' => 'Old Password')) }}
        @if($errors->has('old_password'))
            {{ $errors->first('old_password') }}
        @endif
        </div>

    <div>
        {{ Form::password('new_password', array('placeholder' => 'New Password')) }}
        @if($errors->has('new_password'))
            {{ $errors->first('new_password') }}
        @endif

    </div>

    <div>
        {{ Form::password('password_confirmation', array('placeholder' => 'Confirm New Password')) }}
        @if($errors->has('password_confirmation'))
            {{ $errors->first('password_confirmation') }}
        @endif

    </div>


    {{ Form::submit('Change Password') }}
    {{ Form::close() }}

@stop
