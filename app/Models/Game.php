<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public const TYPE = 'SCRABBLE';

    protected $fillable = ['ended_at'];

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
}
