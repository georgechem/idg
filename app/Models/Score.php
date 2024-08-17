<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
    ];

    protected $hidden = ['game_id', 'player_id'];

    public $timestamps = false;

    public function setScore(int  $score): void
    {
        $this->attributes['score'] = $score;
    }

    public function getScore(): int
    {
        return $this->attributes['score'];
    }

    public function getPlayer(): HasOne
    {
        return $this->hasOne(Player::class);
    }
}
