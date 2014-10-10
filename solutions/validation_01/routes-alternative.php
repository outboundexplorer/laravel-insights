// app/routes.php

// This alternative version demonstrates how to implement custom validation messages


Route::get('form/route', function()
{
    return View::make('form');
});


Route::post('form/route', function()
{
    // Fetch all the request data
    $data = Input::all();

    // Define the validation rules set
    $rules = array(
        'username'                  => array('required','alpha_num','min:3','max:36'),
        'email'                     => array('required','email'),
        'password'                  => array('required','min:6','max:36'),
        'password_confirmation'     => array('same:password')
    );
    // Define our custom messages.  We can include a specific field by using a period after the field name)
   $messages = array(
       'required'                   => 'This is a required field.',
       'password.min'               => 'It\'s dangerous to have such as short password.'
   );

    // Create a new validator instance (we can include our custom $messages as a third parameter)
    $validator = Validator::make($data, $rules,$messages);

    if ($validator->passes())
    {
        // validation successful >>> display a message (and store our data, etc)
        return "The data was saved successfully";
    }

    // validation has failed >>> return to form and pass the original input and the $validator object's errors
    return Redirect::to('form/route')
        ->withInput()
        ->withErrors($validator);
});
