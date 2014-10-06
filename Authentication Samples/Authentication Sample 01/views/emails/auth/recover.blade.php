{{--
NOTE 0: The $username, $password and $link are from the 'username', 'password' and 'link' keys which have been
        passed to this file from the array() in the Mail::Send() method.
--}}

<p>Hello {{ $username }}</p>

<p>It looks like you have created a new password.</p>

<p>You need to use the following link to activate the new password</p>

<p>Your new password is: {{ $password }}</p>

<br/><br/>
{{ $link }}



