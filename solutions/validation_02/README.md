**Sources**
* based on Laracasts series:  [Laravel 4 From Scratch](https://laracasts.com/series/laravel-from-scratch

___

**Features**


___

**Code Style**


___

**Insights**


**Version Details**

*version-01*

This code has placed the validation logic in the MembersController class

*Version 2*

The rules have been moved to the Members model.  A public static property has been set up so that we can access the property from the MembersController.
The MembersController uses Members::$rules to access the values of the static property $rules.

*Version 3*

Move all of the validation logic to the Members model.  In the Members controller, simply check that the static function `Member::dataIsValid(Input::all())` returns true before saving new Member to the database.  Also note that when returning errors, the MembersController needs to access the static property `Member::$errors` in order to be able to access the errors that were returned during validation.  In the Member model, we create a new `public static function dataIsValid($data)` in order to validate the data.  Note that it is not good practice to directly insert the `Input::all()` into the model, this should instead be passed as a parameter to the function.  We can now reference the $rules as `static::$rules` instead of `Member::$rules` as we are within the same class.  We must also create a new `public static property $errors` in order to be able to populate this with the errors that are created within the class by the `Member::dataIsValid()` function.  As this is a static property, we are then able to access this from our `MembersController`.
 
*Version 4*

In version 3, when we needed to access data from the Member model, we needed to use static methods and static properties to access this.  This will create problems for testing and so in this version, we have used dependency injection to inject the Member model into the MembersController class.  We use the MembersController constructor to inject the Member model into the class and assign this to the protected property $member.  We can then access the Member instance using $this->member.  This means that from within the MethodController class we do not need to access anything from the model.  

*Version 5*

When we validate the data at the moment, we are using the dataIsValid(Input::all()) method to validate the data and then we are acting upon the data.  In this , we could use fill() to assign the data to our object's attributes.  We could then get the object to validate its own attributes.

*Version 6*
 
As in Version 5, we were only acting upon the object, we can shorten the code even further by chaining some of the methods.