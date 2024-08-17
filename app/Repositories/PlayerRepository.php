<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\DB;

class PlayerRepository implements RepositoryInterface
{
    public function getTopPlayers(int $havingAtLeastGames = 10, int $top = 10): array
    {

        $query =  "
    SELECT
        p.id,
        p.first_name,
        p.last_name,
        p.nickname,
        p.email,
        p.phone,
        COUNT(DISTINCT s.game_id) AS games_played,
        AVG(s.score) AS average_score,
        MAX(s.score) AS highest_score,
        MIN(s.score) AS lowest_score,
        SUM(CASE WHEN s.score > o.score THEN 1 ELSE 0 END) AS wins,
        SUM(CASE WHEN s.score < o.score THEN 1 ELSE 0 END) AS losses
    FROM
        players p
    JOIN
        scores s ON p.id = s.player_id
    JOIN
        scores o ON s.game_id = o.game_id AND s.player_id <> o.player_id
    GROUP BY
        p.id, p.first_name, p.last_name, p.nickname, p.email, p.phone
    HAVING
        COUNT(DISTINCT s.game_id) >= :minGamesPlayed
    ORDER BY
        average_score DESC
    LIMIT :limit
";
        return DB::select($query, [
            'minGamesPlayed' => $havingAtLeastGames,
            'limit' => $top
        ]);
    }
}
