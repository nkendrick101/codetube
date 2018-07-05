<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('layouts.partials._header-auth', function ($view) {
            if (!auth()->check())
                return;

            $view->with([
                'user' => auth()->user(),
                'channel' => auth()->user()->channel()->first()
            ]);
        });

        \Laravel\Cashier\Cashier::useCurrency('usd', '$');
        \Braintree_Configuration::environment(config('services.braintree.environment'));
        \Braintree_Configuration::merchantId(config('services.braintree.merchant_id'));
        \Braintree_Configuration::publicKey(config('services.braintree.public_key'));
        \Braintree_Configuration::privateKey(config('services.braintree.private_key'));
        \Schema::defaultStringLength(191);
    }

    public function register()
    {
        //
    }
}
