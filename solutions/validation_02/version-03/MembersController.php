<?php
// app/controllers/MembersController.php   (version-03)

class MembersController extends BaseController {


	public function index()
	{
		//
        $members = Member::all();

        return View::make('members.index', array('members_list' => $members));
	}


	public function create()
	{
		//
        return View::make('members.create');


    }


	public function store()
	{
        if ( ! Member::dataIsValid(Input::all()))
        {
            return Redirect::back()->withInput()->withErrors(Member::$errors);
        }

        $member = new Member();
        $member->username = Input::get('username');
        $member->password = Hash::make(Input::get('password'));
        $member->save();

        return Redirect::route('members.index');

	}


	public function show($username)
	{
		//
        $member = Member::where('username','=', $username)->first();

        return View::make('members.show', array('member' => $member));

    }

}
