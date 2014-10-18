<?php
// app/models/Member.php   (version-02)


class Member extends Eloquent  {

    public $table = 'members';

    protected $fillable = array(
        'username',
        'password'
    );

    /*
	 * In this version the rules have been defined in the model.
	 */
	public static $rules = array(
        'username' => 'required',
        'password' => 'required'
    );

}
