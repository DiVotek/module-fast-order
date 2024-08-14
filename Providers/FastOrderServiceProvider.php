<?php

namespace Modules\FastOrder\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class FastOrderServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'FastOrder';

    public function boot(): void
    {
        $this->mergeConfigFrom(
            module_path('FastOrder', 'config/settings.php'),
            'settings'
        );
        $this->loadMigrations();
    }

    public function register(): void
    {
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Migrations'));
    }
}
