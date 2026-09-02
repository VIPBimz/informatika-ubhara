<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'nama',
        'nim_nidn',
        'foto',
        'kategori',
        'jabatan',
        'divisi_keahlian',
        'angkatan',
        'status_kepengurusan',
        'linkedin_url',
        'github_url',
        'instagram_url',
        'email_kontak',
        'urutan',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Accessor untuk URL foto profil personalia dengan fallback avatar.
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto) {
            return Storage::disk('public')->exists($this->foto)
                ? Storage::url($this->foto)
                : asset('storage/' . $this->foto);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama) . '&background=1E3A8A&color=FBBF24&bold=true&size=200';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'aslab_jaga_id');
    }

    public function damageReportsHandled(): HasMany
    {
        return $this->hasMany(DamageReport::class, 'ditangani_oleh');
    }
}
