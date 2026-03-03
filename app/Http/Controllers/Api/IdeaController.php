<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameIdea;
use App\Models\GameIdeaComment;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function myIdeas(Request $request)
    {
        $oauthUser = $request->attributes->get('oauth_user');

        return $oauthUser->ideas()
            ->with('game:id,name,slug')
            ->withCount('comments')
            ->orderByDesc('created_at')
            ->get();
    }

    public function index(Request $request, string $slug)
    {
        $game = Game::published()->where('slug', $slug)->firstOrFail();

        $query = $game->ideas()->with('author');

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $sort = $request->get('sort', 'newest');
        if ($sort === 'most_voted') {
            $query->orderByDesc('votes_count');
        } else {
            $query->orderByDesc('created_at');
        }

        return $query->withCount('comments')->paginate(20);
    }

    public function show(string $slug, GameIdea $idea)
    {
        $idea->load(['author', 'comments.author', 'votes']);

        return $idea;
    }

    public function store(Request $request, string $slug)
    {
        $game = Game::published()->where('slug', $slug)->firstOrFail();
        $oauthUser = $request->attributes->get('oauth_user');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
        ]);

        $idea = $game->ideas()->create([
            'oauth_user_id' => $oauthUser->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        $idea->load('author');

        return response()->json($idea, 201);
    }

    public function vote(Request $request, GameIdea $idea)
    {
        $oauthUser = $request->attributes->get('oauth_user');

        $existing = $idea->votes()->where('oauth_user_id', $oauthUser->id)->first();

        if ($existing) {
            $existing->delete();
            $idea->decrement('votes_count');
            return response()->json(['voted' => false, 'votes_count' => $idea->fresh()->votes_count]);
        }

        $idea->votes()->create(['oauth_user_id' => $oauthUser->id]);
        $idea->increment('votes_count');

        return response()->json(['voted' => true, 'votes_count' => $idea->fresh()->votes_count]);
    }

    public function storeComment(Request $request, GameIdea $idea)
    {
        $oauthUser = $request->attributes->get('oauth_user');

        $validated = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $comment = $idea->comments()->create([
            'oauth_user_id' => $oauthUser->id,
            'body' => $validated['body'],
        ]);

        $comment->load('author');

        return response()->json($comment, 201);
    }

    public function destroyComment(Request $request, GameIdeaComment $comment)
    {
        $oauthUser = $request->attributes->get('oauth_user');

        if ($comment->oauth_user_id !== $oauthUser->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}
