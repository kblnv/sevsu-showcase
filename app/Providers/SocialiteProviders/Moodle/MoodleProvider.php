<?php

namespace App\Providers\SocialiteProviders\Moodle;

use GuzzleHttp\RequestOptions;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class MoodleProvider extends AbstractProvider
{
    const IDENTIFIER = 'MOODLE';

    /**
     * {@inheritdoc}
     */
    protected $scopes = ['openid'];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://auth.sevsu.ru/realms/portal/protocol/openid-connect/auth', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://auth.sevsu.ru/realms/portal/protocol/openid-connect/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $userUrl = 'https://auth.sevsu.ru/realms/portal/protocol/openid-connect/userinfo';

        $response = $this->getHttpClient()->get($userUrl, [
            RequestOptions::HEADERS => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        dd($user);
        return (new User)->setRaw($user)->map([
            'id'       => $user['id'],
            'name'     => $user['name'],
            'email'    => $user['email'],
        ]);
    }
}
