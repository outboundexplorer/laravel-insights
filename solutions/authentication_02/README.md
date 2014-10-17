


This code has placed the validation logic in the MembersController class

Version 2
The rules have been moved to the Members model.  A public static property has been set up so that we can access the property from the MembersController.
The MembersController uses Members::$rules to access the values of the static property $rules.

Version 3
Move all of the validation logic to the Members model.  In the Members controller, simply check that the static function `Member::dataIsValid(Input::all())` returns true before saing new Member to the database.  Also note that when returning errors, the MembersController needs to access the static property `Member::$errors` in order to be able to access the errors that were returned during validation.  In the Member model, we create a new `public static function dataIsValid($data)` in order to validate the data.  Note that it is not good practice to directly insert the `Input::all()` into the model, this should instead be passed as a parameter to the function.  We can now reference the $rules as `static::$rules` instead of `Member::$rules` as we are within the same class.  We must also create a new `public static property $errors` in order to be able to populate this with the errors that are created within the class by the `Member::dataIsValid()` function.  As this is a static property, we are then able to access this from our `MembersController`.
 
