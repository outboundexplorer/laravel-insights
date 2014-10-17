<?php

class MembersController extends BaseController {

    // we create a new property so that we can interact with the injected model within our class
	protected $member;

    /* Note 01: we're going to use the MembersController's __construct() function to inject an instance of the
     *          Member model.
     * Note 02: as we are not in control of instantiating our controllers, it may seem that there is no way that we
     *          can pass in the Member object.
     * Note 03: Laravel will make use of 'automatic resolution' which bascially means that Laravel is going to
     *          try to automatically inject our dependencies.
     * Note 04: a slightly more advanced technique might have been to type hint an interface rather than
     *          requiring a specific implementation.
     */
    public function __construct(Member $injected_member)
    {
        // we set the injected model $injeced_member to the protected property $member.
        $this->member = $injected_member;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		/* Originally when we were accessing the Member class from the controller:
		 *
		 * $members = Member::all();
		 *
		 * We have now injected Member into this class and assigned it to $this->member. This means that everywhere
		 * we previously used Member we can now use $this->member.
		 */
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


	/* Originally when we were accessing the Member class from within the MembersController class
	 *
	 * public function store()
     * {
     *     if ( ! Member::dataIsValid(Input::all()))
     *     {
     *          return Redirect::back()->withInput()->withErrors(Member::$errors);
     *      }
	 *
	 *      $member = new Member();
     *      $member->username = Input::get('username');
     *      $member->password = Hash::make(Input::get('password'));
     *      $member->save();
	 *  ......
	 */
	public function store()
	{
        if ( ! $this->member->dataIsValid($input = Input::all()))
        {
            return Redirect::back()->withInput()->withErrors($this->member->errors);
        }

        /* we can use the create() method to add a new model to the database.  Note that we already set
         * $input = Input::all() so there is no need to repeat ourselves here.
         */
        $this->member->create($input);


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
        /* Originally when we were accessing the Member class from the controller:
         *
         * $member = Member::where('username','=', $username)->first();
         */
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
