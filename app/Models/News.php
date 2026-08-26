<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'category_id',
        'judul',
        'slug',
        'cover',
        'ringkasan',
        'konten',
        'penulis_id',
        'is_featured',
        'status',
        'tanggal_terbit',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'tanggal_terbit' => 'date',
            'views' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
