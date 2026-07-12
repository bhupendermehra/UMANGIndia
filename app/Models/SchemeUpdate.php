<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_id', 'title', 'content',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
