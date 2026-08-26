<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'nama_pemohon',
        'identitas_pemohon',
        'jenis_pemohon',
        'keperluan',
        'estimasi_peserta',
        'status',
        'catatan_admin',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'estimasi_peserta' => 'integer',
            'approved_at' => 'datetime',
        ];
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
