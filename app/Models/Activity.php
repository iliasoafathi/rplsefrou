<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'image_path',
        'starts_at',
        'ends_at',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where(function ($q) {
            $q->where('starts_at', '>=', now()->startOfDay())
              ->orWhere(function ($q2) {
                  $q2->whereNotNull('ends_at')
                     ->where('ends_at', '>=', now());
              });
        });
    }
}
