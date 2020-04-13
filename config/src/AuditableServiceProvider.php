<?php

namespace Mmidu\Auditable;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class TranslatableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/auditable.php' => config_path('auditable.php'),
        ], 'auditable.config');
        
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/auditable.php', 'auditable');
    }
}
