<?php

namespace App\Providers;

use App\Models\Payments;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {

        // unguard model
        Model::unguard();

        // debugbar
        Debugbar::disable();

        // define gate for verify payment
        Gate::define('verify-payment', function (User $user, Payments $payments) {
            return $user->id == $payments->user_id;
        });

    }
}
