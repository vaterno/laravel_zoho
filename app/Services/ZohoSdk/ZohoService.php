<?php

namespace App\Services\ZohoSdk;

use App\Services\ZohoSdk\Dto\AccountDto;
use App\Services\ZohoSdk\Dto\DealDto;
use App\Services\ZohoSdk\Requesters\AccountRequester;
use App\Services\ZohoSdk\Requesters\DealRequester;

class ZohoService
{
    public function __construct(
        protected AccountRequester $accountRequester,
        protected DealRequester $dealRequester
    ) {
    }

    public function getAccounts(): ?array
    {
        return $this->accountRequester->getAll();
    }

    public function storeAccount(AccountDto $accountDto): bool
    {
        return $this->accountRequester->create($accountDto);
    }

    public function getDeals(): ?array
    {
        return $this->dealRequester->getAll();
    }

    public function storeDeal(DealDto $dealDto): bool
    {
        return $this->dealRequester->create($dealDto);
    }
}
