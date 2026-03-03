<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChangelogEntry;
use App\Models\Game;
use Illuminate\Http\Request;

class ChangelogController extends Controller
{
    public function index(Game $game)
    {
        return $game->changelogEntries()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();
    }

    public function store(Request $request, Game $game)
    {
        $validated = $request->validate([
            'version' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'published_at' => 'required|date',
            'category' => 'required|in:feature,bug_fix,improvement,balance',
        ]);

        $entry = $game->changelogEntries()->create($validated);

        return response()->json($entry, 201);
    }

    public function show(Game $game, ChangelogEntry $changelog)
    {
        return $changelog;
    }

    public function update(Request $request, Game $game, ChangelogEntry $changelog)
    {
        $validated = $request->validate([
            'version' => 'sometimes|required|string|max:50',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'published_at' => 'sometimes|required|date',
            'category' => 'sometimes|required|in:feature,bug_fix,improvement,balance',
        ]);

        $changelog->update($validated);

        return $changelog;
    }

    public function destroy(Game $game, ChangelogEntry $changelog)
    {
        $changelog->delete();

        return response()->json(['message' => 'Changelog entry deleted']);
    }
}
