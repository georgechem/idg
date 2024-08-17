<?php

namespace App\Providers;

use Dotenv\Dotenv;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if (file_exists(base_path('.env.local'))) {
            $dotenv = Dotenv::createMutable(base_path(), '.env.local');
        }else{
            $dotenv = Dotenv::createMutable(base_path(), '.env');
        }
        $dotenv->load();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
