<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutText extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'text',
        'image_path',
    ];
}
