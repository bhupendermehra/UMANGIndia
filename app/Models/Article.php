<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'title_hi', 'slug', 'content', 'content_hi', 
        'excerpt', 'excerpt_hi', 'source_url', 'status', 
        'is_featured', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean'
    ];

    // Scope for published articles
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Route binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}