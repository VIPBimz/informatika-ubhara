<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'hari',
        'sesi_ke',
        'jam_mulai',
        'jam_selesai',
        'mata_kuliah',
        'kelas',
        'semester',
        'dosen_pengampu',
        'aslab_jaga_id',
        'kapasitas_peserta',
        'jumlah_mahasiswa',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'sesi_ke' => 'integer',
            'kapasitas_peserta' => 'integer',
            'jumlah_mahasiswa' => 'integer',
        ];
    }

    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class);
    }

    public function aslabJaga(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'aslab_jaga_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
