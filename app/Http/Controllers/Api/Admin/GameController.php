<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return Game::ordered()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:games',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'nullable|array',
            'play_url' => 'required|url',
            'logo_url' => 'nullable|string',
            'banner_url' => 'nullable|string',
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'string',
            'reviews' => 'nullable|array',
            'status' => 'in:draft,published',
            'sort_order' => 'integer',
        ]);

        $game = Game::create($validated);

        return response()->json($game, 201);
    }

    public function show(Game $game)
    {
        return $game;
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:games,slug,' . $game->id,
            'short_description' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'features' => 'nullable|array',
            'play_url' => 'sometimes|required|url',
            'logo_url' => 'nullable|string',
            'banner_url' => 'nullable|string',
            'screenshots' => 'nullable|array',
            'screenshots.*' => 'string',
            'reviews' => 'nullable|array',
            'status' => 'in:draft,published',
            'sort_order' => 'integer',
        ]);

        $game->update($validated);

        return $game;
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return response()->json(['message' => 'Game deleted']);
    }
}
