<?php

namespace App\Providers;

use App\Models\Payments;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('verify-payment', function (User $user, Payments $payments) {
            return $user->id == $payments->user_id;
        });
    }
}
