<?php
// app/controllers/SessionsController.php

class SessionsController extends BaseController {

    public function create()
    {
        if (Auth::check())
        {
            return Redirect::to('/admin');
        }
        return View::make('sessions.create');
    }

    public function store()
    {
        /*
         * There are several ways that we can verify that the user is authenticated
         *
         * if (Auth::attempt(array(
         *      'email'     => Input::get('email'),
         *      'username'  => Input::get('username')
         * )
         *
         * or we could use
         *
         * if (Auth::attempt(Input::all())
         *
         */

        if (Auth::attempt(Input::only('email','password')))
        {
            return "Welcome ". Auth::user()->username;
        }

        return Redirect::back()->withInput();

    }

    public function destroy()
    {
        Auth::logout();

        return Redirect::route('sessions.create');
    }

}