<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'role',
        'bio',
        'image',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
