<?php
/**
 * Date: 26/09/2014
 * Time: 14:35
 */

class ProfileController extends BaseController {

    public function user($username)
    {

        $user = User::where('username','=',$username);

        if($user->count())
        {
            $user = $user->first();
            return View::make('profile.user')
                ->with('user',$user);

        }

        return App::abort(404);
    }
}
 