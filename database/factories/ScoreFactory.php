<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'game_id' => 1,
            'player_id' => 1,
            'score' => $this->faker->numberBetween(0, 1000),
        ];
    }

    public function forGame(Game $game): ScoreFactory
    {
        do{
            $player = Player::inRandomOrder()->first();

            $exists = DB::table('scores')
                ->where('game_id', $game->getId())
                ->where('player_id', $player->getId())
                ->exists();

        } while($exists);

        return $this->state([
            'game_id' => $game->getId(),
            'player_id' => $player->getId(),
            'score' => $this->faker->randomFloat(1, 0, 1000),
        ]);
    }
}
