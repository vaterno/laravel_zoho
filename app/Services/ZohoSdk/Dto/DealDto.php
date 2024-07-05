<?php

namespace App\Services\ZohoSdk\Dto;

class DealDto
{
    public function __construct(
        public readonly string $dealName,
        public readonly string $stage,
        public readonly int $accountId,
    ) {
    }

    public function toArray(): array
    {
        return [
            'Deal_Name' => $this->dealName,
            'Stage' => $this->stage,
            'Account_Name' => [
                'id' => $this->accountId,
            ],
        ];
    }
}
