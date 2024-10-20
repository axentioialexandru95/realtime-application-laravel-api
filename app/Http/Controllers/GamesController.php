<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\JsonResponse;

class GamesController extends Controller
{
    //
    public function index(): JsonResponse
    {
        return response()->json(Game::withCount('users as player_count')->get());
    }

    public function join(Game $game): JsonResponse
    {
        if ($game->users()->count() >= $game->max_players) {
            return response()->json(['message' => 'Game is full'], 400);
        }

        $game->users()->syncWithoutDetaching(auth()->user());

        return response()->json($game);
    }

    public function leave(Game $game): JsonResponse
    {
        $game->users()->detach(auth()->user());

        return response()->json($game);
    }
}
