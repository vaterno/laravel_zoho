<?php

namespace App\Services\ZohoSdk\Requesters;

use App\Services\ZohoSdk\Dto\DealDto;

class DealRequester extends AbstractRequester
{
    public function getAll(): ?array
    {
        $url = $this->zohoApiUrl . '/crm/v2/Deals';

        $response = $this->http->get($url);
        $result = $response->json();

        if ($response->status() !== 200) {
            throw new \Exception($result['message']);
        }

        return $result['data'] ?? null;
    }

    public function create(DealDto $dealDto): bool
    {
        $url = $this->zohoApiUrl . '/crm/v2/Deals';

        $response = $this->http->post($url, [
            'data' => [$dealDto->toArray()],
        ]);
        $result = $response->json();

        if ($response->status() !== 200 && !empty($result['message'])) {
            throw new \Exception($result['message']);
        }

        if (
            !empty($result['data']['0']['code']) &&
            $result['data']['0']['code'] !== 'SUCCESS'
        ) {
            throw new \Exception($result['data']['0']['message']);
        }

        return true;
    }
}
