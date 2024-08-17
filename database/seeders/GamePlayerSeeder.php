<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Player;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GamePlayerSeeder extends Seeder
{
    private const REQUIRED_PLAYERS = 2;
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        // Retrieve all players and games
        $players = Player::all();
        $games = Game::all();

        if ($players->count() < self::REQUIRED_PLAYERS) {
            throw new \Exception('Not enough players to create matches.');
        }

        // Generate all possible unique pairs of players
        $playersPairs = $this->generateUniquePairs($players);

        $selectedGames = $games->random(GameSeeder::RECORDS);

        // Randomly shuffle the pairs to assign them to games
        $playerPairs = $playersPairs->shuffle();

        foreach ($selectedGames as $index => $game) {
            // Get a unique pair of players
            $pair = $playerPairs->shift(); // Get the next unique pair of players

            // Ensure the pair is valid
            if ($pair) {
                // Attach the pair to the game
                DB::table('game_player')->insert([
                    ['game_id' => $game->getId(), 'player_id' => $pair[0]],
                    ['game_id' => $game->getId(), 'player_id' => $pair[1]],
                ]);
            } else {
                throw new \Exception('Not enough unique player pairs to create the required number of matches.');
            }
        }
    }

    private function generateUniquePairs(Collection $players): Collection
    {
        $pairs = collect();
        $playerArray = $players->pluck('id')->toArray();

        // Generate all possible unique pairs of players
        for ($i = 0; $i < count($playerArray); $i++) {
            for ($j = $i + 1; $j < count($playerArray); $j++) {
                $pairs->push([$playerArray[$i], $playerArray[$j]]);
            }
        }

        return $pairs;
    }
}
