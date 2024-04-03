<?php

namespace App\Providers\SocialiteProviders\Moodle;

use SocialiteProviders\Manager\SocialiteWasCalled;

class MoodleExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param  \SocialiteProviders\Manager\SocialiteWasCalled  $socialiteWasCalled
     * @return void
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('keycloak', MoodleProvider::class);
    }
}
