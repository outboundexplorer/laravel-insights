<?php

class MembersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $members = Member::all();

        return View::make('members.index', array('members_list' => $members));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return View::make('members.create');


    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
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


        // We can redirect to a specific URI like this:
        // return Redirect::to('/members');

        // or we can redirect to our named route.
        // Note: This would not work if there was an underscore (_) in the domain name.
        return Redirect::route('members.index');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($username)
	{
		//
        $member = Member::where('username','=', $username)->first();

        return View::make('members.show', array('member' => $member));

    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
