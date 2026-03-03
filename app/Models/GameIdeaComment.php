<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameIdeaComment extends Model
{
    protected $fillable = [
        'game_idea_id',
        'oauth_user_id',
        'body',
    ];

    public function idea()
    {
        return $this->belongsTo(GameIdea::class, 'game_idea_id');
    }

    public function author()
    {
        return $this->belongsTo(OauthUser::class, 'oauth_user_id');
    }
}
