<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameIdeaVote extends Model
{
    protected $fillable = [
        'game_idea_id',
        'oauth_user_id',
    ];

    public function idea()
    {
        return $this->belongsTo(GameIdea::class, 'game_idea_id');
    }

    public function user()
    {
        return $this->belongsTo(OauthUser::class, 'oauth_user_id');
    }
}
