<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Services\SmsService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SmsService::class, function ($app) {
            return new SmsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {

        Validator::extend('amount_enough', function ($attribute, $value, $parameters, $validator) {
            // Retrieve totalAmount from parameters
            $totalAmount = $parameters[0];

            // Check if amount_paid is less than totalAmount
            return $value >= $totalAmount;
        });

        Validator::replacer('amount_enough', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':total_amount', $parameters[0], $message);
        });


    }
}
