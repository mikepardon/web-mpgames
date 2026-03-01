<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        return Game::published()->ordered()->get();
    }

    public function show(string $slug)
    {
        $game = Game::published()->where('slug', $slug)->firstOrFail();
        return $game;
    }
}
