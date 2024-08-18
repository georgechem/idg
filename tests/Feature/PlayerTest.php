<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PlayerTest extends TestCase
{

    /**
     * @covers \App\Repositories\PlayerRepository::getTopPlayers
     */
    public function testTopPlayers(): void
    {
        $players = Player::all();
        $data = [];

        foreach($players as $player){

            $gameIds = DB::table('game_player')
                ->where('player_id', $player->getId())
                ->distinct()
                ->pluck('game_id');

            $sum = 0;

            foreach ($gameIds as $gameId) {
                $score = DB::table('scores')
                    ->where('game_id', $gameId)
                    ->where('player_id', $player->getId())
                    ->get();

                $sum += $score[0]->score;
                $data['scores'][$player->getId()][] = $score[0]->score;
            }

            $data['avg'][$player->getId()] = $sum / $gameIds->count();
        }

        arsort($data['avg']);

        $scores = [];
        foreach ($data['avg'] as $playerId => $avg) {
            $scores[$playerId] = $data['scores'][$playerId];
        }

        $data['avg'] = array_slice($data['avg'], 0, 10);
        $scores = array_slice($scores, 0, 10);
        $response = $this->get('/players');

        foreach (json_decode($response->getContent()) as $index => $playerResponse){
            $this->assertEquals(number_format($data['avg'][$index], 4), $playerResponse->average_score);
            $this->assertEquals(max($scores[$index]), $playerResponse->highest_score);
            $this->assertEquals(min($scores[$index]), $playerResponse->lowest_score);
        }
    }
}
