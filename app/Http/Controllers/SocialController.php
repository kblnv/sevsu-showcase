<?php

namespace App\Http\Controllers;

use App\Traits\SocialUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialController extends Controller
{
    use SocialUsers;

    public function redirectToProvider(Request $request, $provider)
    {
        $this->generateRandomArray();

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (InvalidStateException $e) {
            return redirect('/');
        }

        return $this->checkUser($user);
    }

    public function logout(Request $request, $provider)
    {
        return $this->userLogout($provider);
    }

    private function generateRandomArray()
    {
        $randomArray = array_map(function () {
            return rand(1, 100);
        }, array_fill(0, 10, null));
        session(['randomArray' => $randomArray]);
    }
}
