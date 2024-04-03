<?php

namespace App\Traits;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait SocialUsers
{
    public function checkUser($socialiteUser)
    {
        $user = User::where('id', $socialiteUser->id)->first();

        if ($user) {
            Auth::login($user);

            return redirect('/');
        } else {
            $group = $this->checkGroup($socialiteUser->group);

            $user = User::create([
                'id' => $socialiteUser->id,
                'first_name' => $socialiteUser->first_name,
                'second_name' => $socialiteUser->second_name,
                'last_name' => $socialiteUser->last_name,
                'group_id' => $group->id,
            ]);

            Auth::login($user);

            return redirect('/');
        }
    }

    public function userLogout($provider)
    {
        Auth::logout();

        $logoutUrl = env(strtoupper($provider) . '_LOGOUT_URI');

        return redirect($logoutUrl);
    }

    private function checkGroup($groupName)
    {
        $group = Group::where('group_name', $groupName)->first();

        if (!$group) {
            $group = Group::create([
                'group_name' => $groupName,
            ]);
        }

        return $group;
    }
}
