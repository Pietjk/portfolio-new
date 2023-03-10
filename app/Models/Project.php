<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'is_small' => 'boolean'
    ];

    protected $fillable = [
        'title',
        'text',
        'site',
        'github',
        'image_path',
        'is_small'
    ];
}
