<?php
// app/models/Member.php   (version-04)


class Member extends Eloquent  {

    public $table = 'members';

    protected $fillable = array(
        'username',
        'password'
    );

    public static $rules = array(
        'username' => 'required',
        'password' => 'required'
    );

    public $errors;

    public function dataIsValid($data)
    {
        $validator = Validator::make($data, static::$rules);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->messages();
        return false;
    }

}
