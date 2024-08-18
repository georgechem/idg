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

        foreach ($games as $game){
            $gamePlayers = DB::table('game_player')
                ->select('*')
                ->where('game_id', $game->getId())
                ->get();

            for($j = 0; $j < self::PLAYERS; $j++) {
                Score::factory()->forGame($game, $gamePlayers[$j])->create();
            }

        }
    }
}
