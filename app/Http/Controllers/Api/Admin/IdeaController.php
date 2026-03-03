<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameIdea;
use App\Models\GameIdeaComment;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index(Game $game)
    {
        return $game->ideas()
            ->with('author')
            ->withCount('comments')
            ->orderByDesc('created_at')
            ->get();
    }

    public function updateStatus(Request $request, GameIdea $idea)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,rejected,in_progress,in_beta_testing,live',
        ]);

        $idea->update($validated);

        return $idea;
    }

    public function destroy(GameIdea $idea)
    {
        $idea->delete();

        return response()->json(['message' => 'Idea deleted']);
    }

    public function destroyComment(GameIdeaComment $comment)
    {
        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}
