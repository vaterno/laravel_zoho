<?php

namespace App\Providers;

use App\Services\ZohoSdk\Requesters\DealRequester;
use App\Services\ZohoSdk\ZohoHelper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use App\Services\ZohoSdk\Requesters\OAuthRequester;
use App\Services\ZohoSdk\Requesters\AccountRequester;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OAuthRequester::class, function () {
            return new OAuthRequester(
                config('zoho.client_id'),
                config('zoho.client_secret'),
                config('zoho.refresh_token'),
                config('zoho.accounts_api_url')
            );
        });

        $this->app->bind(AccountRequester::class, function (Application $app) {
            $zohoHelper = $app->make(ZohoHelper::class);

            return (new AccountRequester(
                $zohoHelper->getAccessToken(),
                config('zoho.api_url')
            ));
        });

        $this->app->bind(DealRequester::class, function (Application $app) {
            $zohoHelper = $app->make(ZohoHelper::class);

            return (new DealRequester(
                $zohoHelper->getAccessToken(),
                config('zoho.api_url')
            ));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
