<?php

namespace App\Services\ZohoSdk;

use App\Services\ZohoSdk\Requesters\OAuthRequester;
use Illuminate\Support\Facades\Cache;

class ZohoHelper
{
    public function __construct(
        protected OAuthRequester $authRequester,
    ) {
    }

    public function getAccessToken(): string
    {
        $cacheKey = 'zoho_service_access_token';
        $accessToken = Cache::get($cacheKey);

        if (empty($accessToken)) {
            $accessTokenDto = $this->authRequester->getRefreshAccessToken();
            Cache::put($cacheKey, $accessTokenDto->accessToken, $accessTokenDto->expiresIn);

            $accessToken = $accessTokenDto->accessToken;
        }

        return $accessToken;
    }
}
