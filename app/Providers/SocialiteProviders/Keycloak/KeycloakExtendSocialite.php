<?php

namespace App\Providers\SocialiteProviders\Keycloak;

use SocialiteProviders\Manager\SocialiteWasCalled;

class KeycloakExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param  \SocialiteProviders\Manager\SocialiteWasCalled  $socialiteWasCalled
     * @return void
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('keycloak', KeycloakProvider::class);
    }
}
