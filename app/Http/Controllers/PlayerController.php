<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(): JsonResponse
    {

        $user = User::with('player')->get();


        $player = new Player();
        $player->setFirstName('FirstName');
        $player->setLastName('LastName');
        $player->setEmail('email@email.com');
        $player->setPhone('0123456789');
        $player->setNickname('Nickname');
        $player->setJoinAt(new Carbon());
        $player->user()->associate($user);

        //$player->save();
        return new JsonResponse([$user]);
    }
}
