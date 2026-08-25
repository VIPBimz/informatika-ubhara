<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'equipments';

    protected $fillable = [
        'category_id',
        'nama',
        'model_seri',
        'spesifikasi',
        'kondisi',
        'foto',
        'stok_total',
        'stok_tersedia',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'stok_total' => 'integer',
            'stok_tersedia' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class, 'category_id');
    }

    public function loans(): HasMany
    {
        return $this->hasMany(EquipmentLoan::class, 'equipment_id');
    }
}
