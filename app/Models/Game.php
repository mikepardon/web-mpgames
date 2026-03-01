<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'features',
        'play_url',
        'logo_url',
        'banner_url',
        'status',
        'coming_soon',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'coming_soon' => 'boolean',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}