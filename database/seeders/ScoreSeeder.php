<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Score;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder
{
    private const RECORDS = 1000;
    private const PLAYERS = 2;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $games = Game::all();

        foreach ($games as $index => $game) {
            if($index > self::RECORDS) {
                break;
            }

            for($j = 0; $j < self::PLAYERS; $j++) {
                Score::factory()->forGame($game)->create();
            }

        }


    }

    private function getGame(): Game
    {
        do{
            $game = Game::inRandomOrder()->first();
            $exists = DB::table('scores')
                ->where('game_id', $game->getId())
                ->exists();
        }while($exists);

        return $game;
    }
}
