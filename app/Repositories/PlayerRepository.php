<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\DB;

class PlayerRepository implements RepositoryInterface
{
    public function getTopPlayers(int $havingAtLeastGames = 10, int $top = 10): array
    {
        $query = "
    WITH PlayerStats AS (
        SELECT
        p.id AS player_id,
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
    ),
    HighestScoreDetails AS (
        SELECT
        s.player_id,
        s.game_id,
        s.score AS highest_score,
        gp1.player_id AS opponent_id,
        o.first_name AS opponent_first_name,
        o.last_name AS opponent_last_name,
        o.nickname AS opponent_nickname,
        o.email AS opponent_email,
        o.phone AS opponent_phone,
        g.ended_at AS game_date,
        ROW_NUMBER() OVER (PARTITION BY s.player_id ORDER BY s.score DESC) AS row_num
    FROM
        scores s
    JOIN
        game_player gp1 ON s.game_id = gp1.game_id AND s.player_id <> gp1.player_id
    JOIN
        players o ON gp1.player_id = o.id
    JOIN
        games g ON s.game_id = g.id
    WHERE
        s.score = (
            SELECT MAX(score)
            FROM scores
            WHERE game_id = s.game_id AND player_id = s.player_id
        )
    )
    SELECT
    ps.player_id,
    ps.first_name,
    ps.last_name,
    ps.nickname,
    ps.email,
    ps.phone,
    ps.games_played,
    ps.average_score,
    ps.highest_score,
    ps.lowest_score,
    ps.wins,
    ps.losses,
    hs.opponent_id,
    hs.opponent_first_name,
    hs.opponent_last_name,
    hs.opponent_nickname,
    hs.opponent_email,
    hs.opponent_phone,
    hs.game_date
FROM
    PlayerStats ps
LEFT JOIN
    HighestScoreDetails hs ON ps.player_id = hs.player_id AND hs.row_num = 1
ORDER BY
    ps.average_score DESC
LIMIT :limit;
";

        return DB::select($query, [
            'minGamesPlayed' => $havingAtLeastGames,
            'limit' => $top
        ]);
    }
}
