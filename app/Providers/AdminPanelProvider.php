<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminPanelProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Intentionally left blank. Filament panel guard is configured
        // in `App\Providers\Filament\AdminPanelProvider` via ->authGuard('admin').
    }
}
