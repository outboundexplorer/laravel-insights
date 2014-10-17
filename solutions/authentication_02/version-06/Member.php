<?php
/**
 * Date: 13/10/2014
 * Time: 14:51
 */


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


    /* Originally we passed the $data = Input::all() into the method in order to perform our validation
     *
     *  public function dataIsValid($data)
     *  {
     *       $validator = Validator::make($data, static::$rules);
     *       if ($validator->passes())
     *       {
     *          return true;
     *       }
     *       $this->errors = $validator->messages();
     *       return false;
     *  }
     *
     *  Now as we have used used fill(Input::all()) to populate the $this->attributes of the MembersController object,
     *  we can use the dataIsValid() method to directly validate the object rather than just a set of data.  We need
     *  to modify the function so that it does not need to be passed a data set, instead it can just directly act upon
     *  $this->attributes.
     */
    public function dataIsValid()
    {
        $validator = Validator::make($this->attributes, static::$rules);

        if ($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->messages();
        return false;
    }

}
