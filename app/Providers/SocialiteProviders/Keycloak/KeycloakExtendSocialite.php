<?php

namespace App\Providers\SocialiteProviders\Keycloak;

use SocialiteProviders\Manager\SocialiteWasCalled;

class KeycloakExtendSocialite
{
    /**
     * Register the provider.
     *
     * @return void
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('keycloak', KeycloakProvider::class);
    }
}
