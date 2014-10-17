<?php
/**
 * Date: 13/10/2014
 * Time: 14:51
 */


class Member extends Eloquent {

    public $table = 'members';

    protected $fillable = array(
        'username',
        'password'
    );

}
