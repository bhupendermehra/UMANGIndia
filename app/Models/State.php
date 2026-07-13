<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_hi', 'slug', 'is_central',
        'description', 'short_intro', 'featured_image',
        'meta_title', 'meta_description',
    ];

    protected $casts = [
        'is_central' => 'boolean',
    ];

    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function localized($field): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'hi' && !empty($this->{$field . '_hi'})) {
            return $this->{$field . '_hi'};
        }
        return $this->{$field};
    }
}
