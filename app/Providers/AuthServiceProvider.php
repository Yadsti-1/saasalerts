<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Definir Gates
        Gate::define('view-dashboard', function ($user) {
            return $user->is_active;
        });

        Gate::define('access-admin', function ($user) {
            return $user->is_active && $user->hasRole('admin');
        });

        Gate::define('edit-profile', function ($user) {
            return $user->is_active;
        });

        Gate::define('delete-profile', function ($user) {
            return $user->is_active;
        });
    }
}