@extends('layouts.main')

     @section('content')
         {{ Form::open(array('route'=>'sign-in.post')) }}
         <div>
             {{ Form::text('email',null, array('placeholder' => 'Email', 'value' => Input::old('email') )) }}
             @if($errors->has('email'))
                 {{ $errors->first('email') }}
             @endif
         </div>

         <div>
             {{ Form::password('password',array('placeholder' => 'Password')) }}
             @if($errors->has('password'))
                 {{ $errors->first('password') }}
             @endif
         </div>

         <div>
             {{ Form::checkbox('remember') }}
             {{ 'Remember Me' }}
         </div>

         {{ Form::submit('Sign In') }}
         {{ Form::close() }}
     @stop
