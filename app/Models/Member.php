<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
