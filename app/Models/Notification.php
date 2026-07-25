<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    protected $fillable = [
        'title', 'message', 'type', 'is_active', 
        'requires_acknowledge', 'starts_at', 'ends_at', 
        'priority', 'link', 'link_text'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'requires_acknowledge' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'priority' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            });
    }

    public function scopeRequiresAcknowledge($query)
    {
        return $query->where('requires_acknowledge', true);
    }

    public static function getCurrent(): ?self
    {
        return static::active()
            ->latest('priority')
            ->first();
    }
}