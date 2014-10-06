<!DOCTYPE html>
    <html>
        <head>

        </head>

        <body>
            <!-- Check for and display any global messages in the Session variables -->
            @if(Session::has('global'))
               <p>{{ Session::get('global') }}</p>
            @endif

            <!-- include the navigation template >>> GOTO navigation.blade.php -->
            @include('layouts.navigation')

            @yield('content')
        </body>

    </html>