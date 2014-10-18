<?php
// app/models/Member.php   (version-01)


class Member extends Eloquent {

    public $table = 'members';

    protected $fillable = array(
        'username',
        'password'
    );

}
