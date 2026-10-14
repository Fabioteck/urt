<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaticPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'image',
        'meta_data',
    ];

    protected $casts = [
        'meta_data' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }
}
