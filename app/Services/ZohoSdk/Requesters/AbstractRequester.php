<?php

namespace App\Services\ZohoSdk\Requesters;

use Illuminate\Support\Facades\Http;

abstract class AbstractRequester
{
    protected $http;

    public function __construct(
        protected string $accessToken,
        protected string $zohoApiUrl
    ) {
        $this->http = Http::withHeaders(['Authorization' => 'Zoho-oauthtoken ' . $accessToken]);
    }
}
