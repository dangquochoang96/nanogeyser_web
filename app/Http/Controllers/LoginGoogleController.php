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

class LoginGoogleController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
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
            'email'         => $user->email ? $user->email : $user->id.'@google.com',
            'provider'      => 'google',
            'provider_id'   => $user->id
        ]);
    }
}
