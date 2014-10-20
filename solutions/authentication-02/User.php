<?php
// app/models/User.php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';

	protected $hidden = array('password', 'remember_token');

	// Include the table columns that we allow to be MassAssignable.
    protected $fillable = array(
        'username',
        'password',
        'email'
    );

}
