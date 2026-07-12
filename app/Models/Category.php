<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_hi', 'slug', 'description', 'description_hi',
        'icon', 'sort_order', 'meta_title', 'meta_description',
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
