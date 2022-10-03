<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-MasterData', function($user){
            return $user->role == "Administrator";
        });

        Gate::define('manage-transaksi', function($user){
            return $user->role == "Operator";
        });

        Gate::define('manage-booking', function($user){
            return $user->role == "Client";
        });
    }
}
