<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Scheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'title_hi', 'slug', 'category_id', 'state_id',
        'short_description', 'short_description_hi', 'content', 'content_hi',
        'eligibility', 'eligibility_hi', 'benefits', 'benefits_hi',
        'application_process', 'application_process_hi', 'required_documents', 'required_documents_hi',
        'official_website', 'application_deadline', 'status',
        'is_featured', 'views', 'meta_title', 'meta_title_hi',
        'meta_description', 'meta_description_hi', 'meta_keywords', 'published_at',
    ];

    protected $casts = [
        'application_deadline' => 'date',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (Scheme $scheme) {
            if (empty($scheme->slug)) {
                $scheme->slug = Str::slug($scheme->title);
            }
            if (is_null($scheme->published_at)) {
                $scheme->published_at = now();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function updates()
    {
        return $this->hasMany(SchemeUpdate::class)->latest();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatestPublished($query)
    {
        return $query->latest('published_at');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function localized($field): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'hi' && !empty($this->{$field . '_hi'})) {
            return $this->{$field . '_hi'};
        }
        return $this->{$field};
    }

    public function getMetaTitle(): string
    {
        $title = $this->localized('title') ?? $this->title;
        return ($this->meta_title ?: $title . ' - UmangIndia');
    }

    public function getMetaDescription(): string
    {
        $desc = $this->localized('short_description') ?? $this->short_description;
        return $this->meta_description ?: Str::limit(strip_tags($desc), 160);
    }
}
