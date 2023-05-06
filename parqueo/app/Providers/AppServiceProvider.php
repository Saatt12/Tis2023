<?php

namespace App\Providers;

use App\View\Components\Modals\GenericModal;
use App\View\Components\Modals\ListPayment;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('list-payment', ListPayment::class);
        Blade::component('generic-modal', GenericModal::class);
    }
}
