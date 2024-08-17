<?php

namespace App\Http\Controllers;

use App\Repositories\PlayerRepository;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    public function index(PlayerRepository $playerRepository): JsonResponse
    {
        $topPlayers = $playerRepository->getTopPlayers();

        return response()->json($topPlayers);
    }
}
