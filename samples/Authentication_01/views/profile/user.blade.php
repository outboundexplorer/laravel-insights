@extends('layouts.main')

@section('content')

    <p>Username: {{{ $user->username}}}</p>
    <p>Email: {{{$user->email}}}</p>

@stop

