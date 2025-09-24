<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Member extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'position',
        'profile_image_path',
        'is_active',
        'joined_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'joined_at' => 'date',
    ];

    protected function joinedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? \Carbon\Carbon::parse($value) : null,
        );
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
