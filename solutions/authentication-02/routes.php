<?php
/*
 * Route::get('/', function()
    {
        User::create(array(
        'username' => 'AndrewRoddam',
        'email'    => 'andyroddam@gmail.com',
        'password' => Hash::make('1234')
       ));
    });
    return 'Done';
 *
 *
 */

    /*
     * Alternatively we could have used:
     *
     * $user = new User;
     * $user->username = 'AndrewRoddam';
     * $user->email = 'andyroddam@gmail.com';
     * $user->password = Hash::make('1234');
     * $user->save();
     */

Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions','SessionsController');

// We include a before('auth') filter as we do not want users to be able to directly access the admin page by
// simply typing the URL into the browser.
Route::get('admin',function()
{
    return 'Admin Page';
})->before('auth');

Route::resource('members','MembersController');


