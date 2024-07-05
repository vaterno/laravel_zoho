<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDealRequest;
use App\Services\ZohoSdk\ZohoService;
use App\Services\ZohoSdk\Enum\DealStage;

class DealController extends Controller
{
    public function index(ZohoService $zohoService)
    {
        $crmDeals = $zohoService->getDeals() ?: [];
        $data = array_map(function ($deal) {
            return [
                'id' => $deal['id'],
                'name' => $deal['Deal_Name'],
                'stage' => $deal['Stage'],
                'account_name' => $deal['Account_Name'],
            ];
        }, $crmDeals);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getStages()
    {
        return response()->json([
            'data' => DealStage::toArray(),
        ]);
    }

    public function store(StoreDealRequest $storeDealRequest, ZohoService $zohoService)
    {
        $isSuccess = $zohoService->storeDeal($storeDealRequest->getDealDto());

        return response()->json([
            'data' => [
                'success' => $isSuccess,
            ]
        ]);
    }
}
