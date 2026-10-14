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
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }
}
