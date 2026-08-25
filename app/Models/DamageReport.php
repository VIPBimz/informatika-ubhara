<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DamageReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_tiket',
        'lab_id',
        'lokasi_fasilitas',
        'kategori',
        'nama_pelapor',
        'nim',
        'no_wa',
        'deskripsi',
        'foto_bukti',
        'status',
        'ditangani_oleh',
        'tanggal_lapor',
        'tanggal_selesai',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lapor' => 'datetime',
            'tanggal_selesai' => 'datetime',
        ];
    }

    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    public function handler(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'ditangani_oleh');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(DamageReportLog::class);
    }
}
