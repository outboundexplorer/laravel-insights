<?php
// app/controllers/MembersController.php   (version-01)

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
		//
        $validator = Validator::make(Input::all(),array('username' => 'required', 'password'=>'required'));

        if ($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }

        $member = new Member();
        $member->username = Input::get('username');
        $member->password = Hash::make(Input::get('password'));
        $member->save();


        // We can redirect to a specific URI like this:
        // return Redirect::to('/members');

        // or we can redirect to our named route.
        // Note: This would not work if there was an underscore (_) in the domain name.
        return Redirect::route('members.index');

	}


	public function show($username)
	{
		//
        $member = Member::where('username','=', $username)->first();

        return View::make('members.show', array('member' => $member));

    }

}
