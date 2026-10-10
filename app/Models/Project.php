<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'is_small' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'slug',
        'text',
        'site',
        'github',
        'image_path',
        'is_small',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->withTimestamps();
    }

    public function projectDetails(): HasMany
    {
        return $this->hasMany(ProjectDetail::class);
    }
}
