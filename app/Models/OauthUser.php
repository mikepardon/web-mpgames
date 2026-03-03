<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthUser extends Model
{
    protected $fillable = [
        'oauth_id',
        'username',
        'email',
        'avatar_url',
    ];

    public function ideas()
    {
        return $this->hasMany(GameIdea::class);
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
