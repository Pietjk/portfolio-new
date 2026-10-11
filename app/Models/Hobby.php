<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hobby extends Model
{
    /** @use HasFactory<\Database\Factories\HobbyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'image_path',
        'link',
    ];

    public function hobbyPosts(): HasMany
    {
        return $this->hasMany(HobbyPost::class);
    }
}
