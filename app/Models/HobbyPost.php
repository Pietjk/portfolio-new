<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HobbyPost extends Model
{
    /** @use HasFactory<\Database\Factories\HobbyPostFactory> */
    use HasFactory;

    protected $fillable = [
        'hobby_id',
        'name',
        'description',
        'image_path',
        'link',
    ];

    public function hobby(): BelongsTo
    {
        return $this->belongsTo(Hobby::class);
    }
}
