<?php
// app/controllers/MembersController.php   (version-02)

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


	/*
	 * In version-01 the rules were placed inside the MembersController. In this version they have 
     * been moved to the model.	We now need to access the Member's static method $rules in order to
     * have access to the rules.	 
	 */
	public function store()
	{
		//
        $validator = Validator::make(Input::all(),Member::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator->messages());
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
