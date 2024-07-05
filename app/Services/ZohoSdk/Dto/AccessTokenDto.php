<?php

namespace App\Services\ZohoSdk\Dto;

class AccessTokenDto
{
    public function __construct(
        public readonly string $accessToken,
        public readonly string $scope,
        public readonly string $apiDomain,
        public readonly string $tokenType,
        public readonly int $expiresIn,
        public readonly string $expireDate,
    ) {
    }
}
