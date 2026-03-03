<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChangelogEntry;
use App\Models\Game;
use App\Models\GameIdea;
use App\Models\Page;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'games_count' => Game::count(),
            'published_count' => Game::published()->count(),
            'pages_count' => Page::count(),
            'changelog_count' => ChangelogEntry::count(),
            'ideas_count' => GameIdea::count(),
        ]);
    }
}
