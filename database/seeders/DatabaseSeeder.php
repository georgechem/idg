<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');

        $this->call(class: UserSeeder::class);
        $this->call(class: PlayerSeeder::class);
        $this->call(class: GameSeeder::class);
        $this->call(class: GamePlayerSeeder::class);
    }
}
