<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Page;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'games_count' => Game::count(),
            'published_count' => Game::published()->count(),
            'pages_count' => Page::count(),
        ]);
    }
}
