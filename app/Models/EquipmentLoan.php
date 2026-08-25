<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'nama_peminjam',
        'nim',
        'no_wa',
        'jumlah_unit',
        'tanggal_pinjam',
        'tanggal_rencana_kembali',
        'tanggal_kembali_aktual',
        'keperluan',
        'setuju_sop',
        'status',
        'catatan_kondisi_kembali',
        'diproses_oleh',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_unit' => 'integer',
            'tanggal_pinjam' => 'date',
            'tanggal_rencana_kembali' => 'date',
            'tanggal_kembali_aktual' => 'date',
            'setuju_sop' => 'boolean',
        ];
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }
}
