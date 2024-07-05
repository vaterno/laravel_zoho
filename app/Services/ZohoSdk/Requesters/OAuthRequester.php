<?php

namespace App\Services\ZohoSdk\Requesters;

use Illuminate\Support\Facades\Http;
use App\Services\ZohoSdk\Dto\AccessTokenDto;

class OAuthRequester
{
    public function __construct(
        protected string $clientId,
        protected string $clientSecret,
        protected string $refreshToken,
        protected string $zohoApiUrl
    )
    {
    }

    public function getRefreshAccessToken(): AccessTokenDto
    {
        $data = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $this->refreshToken,
            'grant_type' => 'refresh_token',
        ];

        $url = $this->zohoApiUrl . '/oauth/v2/token?' . http_build_query($data);
        $result = Http::post($url)->json();

        return (new AccessTokenDto(
            $result['access_token'],
            $result['scope'],
            $result['api_domain'],
            $result['token_type'],
            $result['expires_in'],
            date("Y-m-d H:i:s", strtotime('+' . $result['expires_in'] . ' sec'))
        ));
    }
}
