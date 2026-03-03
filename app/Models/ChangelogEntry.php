<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangelogEntry extends Model
{
    protected $fillable = [
        'game_id',
        'version',
        'title',
        'description',
        'published_at',
        'category',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
        ];
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
