<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    use HasFactory;

    public const TYPE = 'SCRABBLE';

    protected $fillable = ['ended_at'];

    protected $hidden = ['pivot'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setEndedAt(\DateTimeInterface $dateTime):void
    {
        $this->attributes['ended_at'] = $dateTime;
    }

    public function getEndedAt():\DateTimeInterface
    {
        return $this->attributes['ended_at'];
    }

    public function getStartedAt():?\DateTimeInterface
    {
        return $this->attributes['started_at'];
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'game_player', 'game_id', 'player_id');
    }

    public function score(): HasOne
    {
        return $this->hasOne(Score::class);
    }
}
