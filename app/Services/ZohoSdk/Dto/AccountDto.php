<?php

namespace App\Services\ZohoSdk\Dto;

class AccountDto
{
    public function __construct(
        public readonly string $accountName,
        public readonly string $phone,
        public readonly string $website,
    ) {
    }

    public function toArray(): array
    {
        return [
            'Account_Name' => $this->accountName,
            'Website' => $this->website,
            'Phone' => $this->phone,
        ];
    }
}
