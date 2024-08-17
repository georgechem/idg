<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public const RECORDS = 1000;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Game::factory(self::RECORDS)->create();
    }
}
