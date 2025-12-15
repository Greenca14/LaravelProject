<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

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
        Paginator::defaultView('pagination::bootstrap-4');
        
        Gate::define('create-person', function ($user) {
            return $user && ($user->is_admin || $user->role === 'editor');
        });

        Gate::define('admin', function ($user) {
            return $user->is_admin;
        });

        Gate::define('view-only', function ($user) {
            return !$user->is_admin;
        });
    }
}