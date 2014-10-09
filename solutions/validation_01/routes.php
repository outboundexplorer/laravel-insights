// app/routes.php

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

    // Create a new validator instance
    $validator = Validator::make($data, $rules);

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