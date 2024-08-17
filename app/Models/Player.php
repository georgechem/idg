<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'nickname', 'email', 'phone', 'join_at', 'user_id'
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getFirstName(): string
    {
        return $this->attributes['first_name'];
    }

    public function setFirstName(string $firstName): void
    {
        $this->attributes['first_name'] = $firstName;
    }

    public function setJoinAt(\DateTimeInterface $joinAt): void
    {
        $this->attributes['join_at'] = $joinAt;
    }

    public function getJoinAt(): \DateTimeInterface
    {
        return $this->attributes['join_at'];
    }

    public function getLastName(): string
    {
        return $this->attributes['last_name'];
    }

    public function setLastName(string $lastName): void
    {
        $this->attributes['last_name'] = $lastName;
    }

    public function getNickname(): string
    {
        return $this->attributes['nickname'];
    }

    public function setNickname(string $nickname): void
    {
        $this->attributes['nickname'] = $nickname;
    }

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function getPhone(): string
    {
        return $this->attributes['phone'];
    }

    public function setPhone(string $phone): void
    {
        $this->attributes['phone'] = $phone;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function games(): BelongsToMany
    {

        return $this->belongsToMany(Game::class, 'game_player', 'player_id', 'game_id');
    }


}
