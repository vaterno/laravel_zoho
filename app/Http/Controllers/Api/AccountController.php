<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Services\ZohoSdk\ZohoService;

class AccountController extends Controller
{
    public function index(ZohoService $zohoService)
    {
        $crmAccounts = $zohoService->getAccounts() ?: [];
        $data = array_map(function ($account) {
            return [
                'id' => $account['id'],
                'account_name' => $account['Account_Name'],
                'website' => $account['Website'],
                'phone' => $account['Phone'],
            ];
        }, $crmAccounts);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function store(
        StoreAccountRequest $storeAccountRequest,
        ZohoService $zohoService
    ) {
        $isSuccess = $zohoService->storeAccount($storeAccountRequest->getAccountDto());

        return response()->json([
            'data' => [
                'success' => $isSuccess,
            ]
        ]);
    }
}
