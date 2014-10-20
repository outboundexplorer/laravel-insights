<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

    </head>
    <body>

        {{ Form::open(array('route' => 'sessions.store')) }}

            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email') }}

            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}

            {{ Form::submit('Sumbit') }}

        {{ Form::close() }}

    </body>
</html>