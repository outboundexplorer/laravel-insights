@extends ('layouts.main')
{{--
Access the main.blade.php template
>>> GOTO main.blade.php
--}}



@section ('content')

    @if(Auth::check())
        <p>Hello, {{ Auth::user()->username }}</p>  <!-- Auth::user() is current user instance -->
    @else
        <p>You are not signed in</p>
    @endif
    This is the new homepage.
@stop

<!-- >>> GOTO routes.php>'account/create (GET)'
