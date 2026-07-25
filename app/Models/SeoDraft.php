<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoDraft extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'status',
        'source_url', 'target_keyword', 'seo_agent_run_id',
        'reviewed_by', 'reviewed_at', 'review_notes'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending_review');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
