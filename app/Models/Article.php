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
        'is_featured', 'published_at',
        'meta_title', 'meta_description', 'focus_keyword',
        'featured_image', 'view_count'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'view_count' => 'integer',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function incrementViews(): void
    {
        $this->increment('view_count');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
