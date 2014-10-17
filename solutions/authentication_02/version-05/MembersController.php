<?php

class MembersController extends BaseController {

    protected $member;

    public function __construct(Member $injected_member)
    {
         $this->member = $injected_member;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    $members = $this->member->all();

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


    /* Originally we passed Input::all() to the function dataIsValid(),we didn't directly test the object
     *
     * if ( ! $this->member->dataIsValid($input = Input::all()))
     *
     * instead we could use fill(Input::all()) method to fill the attributes of $this instance.  Now when
     * we call the dataIsValid() method this will be performed against the object rather than just some data.
     * This will lead to better programming and less errors in the future.
     */
	public function store()
	{
        $this->member->fill($input = Input::all());

        if ( ! $this->member->dataIsValid())
        {
            return Redirect::back()->withInput()->withErrors($this->member->errors);
        }

        $this->member->create($input);

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
        $member = $this->member->where('username','=', $username)->first();

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
