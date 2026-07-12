<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Share extends Model
{
    protected $fillable = ['shareable_type', 'shareable_id', 'platform', 'ip_address', 'user_agent'];

    public function shareable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeForPlatform($query, string $platform)
    {
        return $query->where('platform', $platform);
    }
}