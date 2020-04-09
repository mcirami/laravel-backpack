<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree_Configuration;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Braintree_Configuration::environment(env('BRAINTREE_ENV'));
	    Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
	    Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
	    Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
	public function register()
	{
		if ($this->app->environment() == 'local') {
			$this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
		}
	}
}
