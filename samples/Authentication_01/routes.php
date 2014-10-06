<?php
// app/routes.php


Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home'
    )
);


/*
 * Authenticated group
 * note: All routes in this group must first be passed via the 'auth' filter before carrying out the logic
 *       provided by each individual route
 * note: We need to apply CSRF filter to POST inputs from USER to be sure that this has been submitted by the user
 *        and is not from elsewhere.
 */
Route::group(array('before' => 'auth'), function(){

        /*
         * CSRF protection group
         */
        Route::group(array('before' => 'csrf'), function()
        {

            Route::post('/account/change-password',array(
                'as' => 'change-password.post',
                'uses' => 'AccountController@postChangePassword'
            ));
        });


        Route::get('/account/change-password',array(
            'as' => 'change-password.get',
            'uses' => 'AccountController@getChangePassword'
        ));


        Route::get('/account/sign-out', array(
            'as' => 'sign-out.get',
            'uses' => 'AccountController@getSignOut'
        ));


        Route::get('/user/{username}', array(
            'as' => 'user-profile.get',
            'uses' => 'ProfileController@user'

        ));

    }
);



/*
 * Unauthenticated group
 * note: These are routes that are accessible to guests
 * note: CSRF filters are applied to all POST requests
 */
Route::group(array('before' => 'guest'), function()
{

    /*
     * CSRF protection group
     */
    Route::group(array('before' => 'csrf'),function ()
    {

        Route::post('/account/create', array(
            'as' => 'create.post',
            'uses' => 'AccountController@postCreate'
        ));


        Route::post('/account/sign-in', array(
            'as' => 'sign-in.post',
            'uses' => 'AccountController@postSignIn'
        ));


        Route::post('/account/forgot-password', array(
            'as' => 'forgot-password.post',
            'uses' => 'AccountController@postForgotPassword'
        ));
    });


    Route::get('/account/sign-in', array(
        'as' => 'sign-in.get',
        'uses' => 'AccountController@getSignIn'
    ));


    Route::get('/account/forgot-password', array(
        'as' => 'forgot-password.get',
        'uses' => 'AccountController@getForgotPassword'
    ));


    Route::get('/account/recover/{code}', array(
        'as' => 'recover.get',
        'uses' => 'AccountController@getRecover'
    ));


    Route::get('/account/create', array(
        'as' => 'create.get',
        'uses' => 'AccountController@getCreate'
    ));


    // This pattern corresponds to link sent to user in email
    Route::get('/account/activate/{code}', array(
        'as' => 'activate.get',
        'uses' => 'AccountController@getActivate'
    ));
});
