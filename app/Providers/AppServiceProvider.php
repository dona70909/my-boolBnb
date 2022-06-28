<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Braintree\Configuration::environment(env('BRAINTREE_ENV'));
        \Braintree\Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        \Braintree\Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        \Braintree\Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway([
                'environment' => env('BRAINTREE_ENV'),
                'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY')
            ]);
        });
    }
}

