<?php

class AccountController extends BaseController {


    public function getCreate()
    {
        return View::make('accounts.create');
    }



    public function getSignIn()
    {
        return View::make('accounts.signin');
    }



    public function getSignOut()
    {
        Auth::logout();
        return Redirect::route('home');
    }



    public function getChangePassword()
    {
        return View::make('accounts.password');
    }



    public function postChangePassword()
    {
        $validator = Validator::make(Input::all(),array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|same:new_password'
        ));

        if ($validator->fails())
        {
            // <<< fails >>> // return with errors
            return Redirect::route('change-password.get')
                ->withErrors($validator);
        }
        else
        {
            // <<< passes >>> // change password
            $user = Member::find(Auth::user()->id);
            $old_password = Input::get('old_password');
            $new_password = Input::get('new_password');

            if(Hash::check($old_password,$user->getAuthPassword()))
            {
                // <<< user input password and stored password match >>>
                // set the user password to the hash of the $new_password
                $user->password = Hash::make($new_password);

                if($user->save())
                {
                    return Redirect::route('home')
                        ->with('global','Your password has been changed!');
                }

            }
            else
            {
                // <<< passwords don't match >>>
                return Redirect::route('change-password.get')
                    ->with('global','Your old password is incorrect');
            }
        }

        // <<< fallback (something went wrong)>>>
        return Redirect::route('change-password.get')
            ->with('global','Your password could not be changed');
    }



    public function postSignIn()
    {

        // Carry out validation by passing the input and validation criteria into the Validator::make() method
        $validator = Validator::make(Input::all(), array(
            'email' => 'required',
            'password' => 'required',
        ));

        if ($validator->fails())
        {
            // <<< validation fails >>> // redirect to signin page
            return Redirect::route('sign-in.get')
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            // <<< validation passes >>> // attempt signin
            $remember = (Input::has('remember'))? true : false;
            $auth = Auth::attempt(array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'active' => 1
            ),$remember);

            if($auth)
            {
                // <<< $auth passes >>>
                // redirect to intended page as it may have been that we tried to hit a page, but the auth filter
                // sent us to the sign in page as we were not signed in.  In which case, Redirect::indended('/') will
                // allow us to access the page that we were originally heading for.
                return Redirect::intended('/');
            }
            else
            {
                // <<< $auth fails >>>
                return Redirect::route('sign-in.get')
                    ->with('global', 'Signin details incorrect, or account not activated!')
                    ->withInput();

            }
        }

        // <<< fallback >>>
        return Redirect::route('sign-in.get')
            ->with('global', 'There was a problem signing you in.');

    }



    public function postCreate()
    {
        // Define a $validator to validate the POST data
        $validator = Validator::make(Input::all(), array(
            'email' => 'required|max:50|email|unique:users',
            'username' => 'required|max:20|min:3|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ));

        if($validator->fails())
        {
            // <<< validation fails >>>  // redirect to the original create.get route and passing the errors
            // so that they can be displayed also passing back the user input so that this can also be displayed
            return Redirect::route('create.get')
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            // <<< validation success >>>  // store the user input data into variables
            $email = Input::get('email');
            $username = Input::get('username');
            $password = Input::get('password');

            // create an activation code
            $code = str_random(60);

            // create a new user in the database
            // note: a new instance of Member is created and assigned to the $user object.
            // note: there is no need to use save()
            $user = Member::create(array(
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($password),
                'password_temp' => '', // This is required unless the database column is nullable
                'code' => $code,
                'active' => 0
            ));

            if($user)
            {
                /*
                 * <<< user successfully added to the database >>>
                 *
                 * note: The first argument passed to the send() method is the name of the view that should be
                 *       used as the email body.
                 * note: The second argument is the data to be passed to the view (often an associative array).
                 * note: The third argument is a Closure allowing you to specify various options on the email
                 *        message.
                 * note: In the link that is sent to the user, the $code is passed to the browser as part of the
                 *        'activate.get' route
                 */
                Mail::send('accounts.activate', array(
                    'link' => URL::route('activate.get',$code),
                    'username' => $username
                    ),
                    function($message) use ($user)
                    {
                        // note: because we are inside a closure, we are unable to directly access $email in the
                        // same way we have done above. Instead use 'use ($user)' to gain access to this object.
                        $message->to($user->email, $user->username)->subject('Activate your account');
                    });

                // return with global message
                return Redirect::route('home')
                    ->with('global','Your account has been created!! We have sent you an activation email!');
            }
        }
    }



    // The $code is passed as a dynamic variable into this function as it was indicated to be a variable placeholder
    // in the route by using curly braces (account/activate/{code}
    public function getActivate($code)
    {
        // We set the $user object equal to the instance of User (from the database) where the code is the same and
        // where the account is not active
        $user = User::where('code', '=', $code)->where('active','=',0);

        if($user->count())
        {
            // <<< A record from the database was returned >>>
            // the $user object is set to the first record returned from the database (same as LIMIT 1)
            $user = $user->first();

            // Update profile to active state
            $user->active = 1;
            $user->code = '';

            if ($user->save())
            {
                // <<< $user successfully saved to the database >>>
                return Redirect::route('home')
                    ->with('global', 'Activated! You can now sign in!');
            }
        }

        // <<< user was not found in the database.  Something has gone wrong >>>!
        return Redirect::route('home')
            ->with('global','We could not activate your account. Try again later');
    }



    public function getForgotPassword()
    {
        return View::make('accounts.forgot-password');
    }



    public function postForgotPassword()
    {
        $validator = Validator::make(Input::all(),array(
            'email' => 'required|email'
        ));

        if ($validator->fails())
        {
            // <<< email not valid >>> // return with error message
            Redirect::route('forgot-password.get')
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            // <<< email valid >>> // check that email exists in database
            $user = Member::where('email', '=', Input::get('email'));

            if ($user->count())
            {
                // <<< user found >>> // access the user
                $user = $user->first();

                // Generate a new code and password
                $code                   = str_random(60);
                $password               = str_random(10);

                $user->code             = $code;
                $user->password_temp    = Hash::make($password);  // Must Hash as storing to the database

                if($user->save());

                    // <<< User has successfully had password_temp and code saved to the database >>>
                    Mail::send('emails.auth.recover',array(
                        'link' => URL::route('recover.get', $code),
                        'username' => $user->username,
                        'password' => $password
                    ), function($message) use ($user)
                    {
                        $message->to($user->email, $user->username)->subject('Your new password');
                    });

                    return Redirect::route('home')
                        ->with('global', 'We have sent you a new password by email');
            }
        }

        // <<< something has gone wrong >>>
        return Redirect::route('forgot-password.get')
            ->with('global','Could not request new password');
    }



    public function getRecover($code)
    {
        $user = Member::where('code','=', $code)
            ->where('password_temp','!=','');  // we cannot allow the user password to be set to blank in any case

        // check that the user exists based on the above conditions
        if ($user->count())
        {
            // <<< user record match >>>
            $user = $user->first(); // set the $user object to the first object returned

            $user->password         = $user->password_temp; // set the password to the new temporary password
            $user->password_temp    = ''; // reset the temporary password
            $user->code             = ''; // reset the code

            if ($user->save()) // save data to database and check for success
            {
                // return success message and
                return Redirect::route('home')
                    ->with('global', 'Your account has been recovered and you can log in with your new password');
            }
        }

        // <<< something went wrong >>> // fallback
        return Redirect::route('home')
            ->with('global','Could not recover your account');
    }
}
 