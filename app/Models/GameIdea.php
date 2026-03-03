<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameIdea extends Model
{
    protected $fillable = [
        'game_id',
        'oauth_user_id',
        'title',
        'description',
        'status',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function author()
    {
        return $this->belongsTo(OauthUser::class, 'oauth_user_id');
    }

    public function votes()
    {
        return $this->hasMany(GameIdeaVote::class);
    }

    public function comments()
    {
        return $this->hasMany(GameIdeaComment::class);
    }
}
