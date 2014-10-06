@extends('...layouts.main')

@section('content')

    {{ Form::open(array('route' => 'forgot-password.post', 'value' => Input::old('email') )) }}

    <div>
        @if($errors->has('email'))
            {{ $errors->first('email')  }}
        @endif
        {{ Form::email('email',null, array('placeholder' => 'Email')) }}

    </div>

    <div>
        {{ Form::submit('Request Password') }}
    </div>

    {{ Form::close() }}

@stop