<?php

namespace App\Providers;

use App\Interfaces\RepositoryInterface;
use App\Repositories\PlayerRepository;
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
        $this->app->bind(RepositoryInterface::class, PlayerRepository::class);

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
