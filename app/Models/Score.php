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

    public $timestamps = false;

    public function setScore(float  $score): void
    {
        $this->attributes['score'] = $score;
    }

    public function getScore(): float
    {
        return $this->attributes['score'];
    }

    public function getPlayer(): HasOne
    {
        return $this->hasOne(Player::class);
    }
}
