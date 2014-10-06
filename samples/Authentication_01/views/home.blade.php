@extends ('layouts.main')

@section ('content')

    @if(Auth::check())
        <p>Hello, {{ Auth::user()->username }}</p>  <!-- Auth::user() is current user -->
    @else
        <p>You are not signed in</p>
    @endif
    This is the new homepage.
@stop

