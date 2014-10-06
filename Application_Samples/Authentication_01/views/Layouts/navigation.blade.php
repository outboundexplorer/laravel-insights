<nav>
    <ul>
        <li><a href="{{ URL::route('home') }}">Home</a></li>
        @if (Auth::check())
            <li><a href="{{ URL::route('sign-out.get') }}">Sign Out</a></li>
            <li><a href="{{ URL::route('change-password.get') }}">Change Password</a></li>
        @else
            <li><a href="{{ URL::route('sign-in.get') }}">Sign In</a></li>
            <li><a href="{{ URL::route('create.get') }}">Create Account</a></li>
            <li><a href="{{ URL::route('forgot-password.get') }}">Forgot password</a></li>
        @endif
    </ul>
</nav>