<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
    ];

    public function albums(): HasMany
    {
        return $this->hasMany(GalleryAlbum::class, 'category_id');
    }
}
