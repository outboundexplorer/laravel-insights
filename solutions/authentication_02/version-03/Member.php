<?php
// app/models/Member.php   (version-03)


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

    public static $errors;

    /*
     * Note 01: it is not good practice to directly reference data from within our function, it is better that
     *          this data is passed to the function.
     * Note 02: We do not need to reference as Member::$static as we are within the class that is referencing
     *          this.
		public function isValid()
		{
			$validator = Validator::make(Input::all(),static::$rules);
			....
			....other logic
		}
     */
    public static function dataIsValid($data)
    {
        $validator = Validator::make($data, static::$rules);

        if ($validator->passes())
        {
            return true;
        }

        static::$errors = $validator->messages();
        return false;
    }

}
