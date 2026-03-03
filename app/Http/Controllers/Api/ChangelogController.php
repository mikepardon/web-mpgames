<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;

class ChangelogController extends Controller
{
    public function index(string $slug)
    {
        $game = Game::published()->where('slug', $slug)->firstOrFail();

        return $game->changelogEntries()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();
    }
}
