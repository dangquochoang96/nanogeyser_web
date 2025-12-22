<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoginFacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);
        return redirect(url('/'));
    }

    public function findOrCreateUser($user)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'username'      => $user->name,
            'email'         => $user->email ? $user->email : $user->id.'@facebook.com',
            'provider'      => 'facebook',
            'provider_id'   => $user->id
        ]);
    }
}
