<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMonitor extends Model
{
    protected $table = 'seo_monitor';

    protected $fillable = [
        'page_url', 'check_type', 'status', 'issue_detail', 'suggested_fix', 'checked_at'
    ];

    protected $casts = [
        'checked_at' => 'date',
    ];

    public function scopeFailed($query)
    {
        return $query->where('status', 'fail');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('check_type', $type);
    }
}
