<?php

namespace App\Http\Controllers;

use App\Traits\SocialUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    use SocialUsers;

    public function redirectToProvider(Request $request, $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        $user = Socialite::driver($provider)->user();

        return $this->checkUser($user);
    }

    public function logout()
    {
        return $this->userLogout();
    }
}
