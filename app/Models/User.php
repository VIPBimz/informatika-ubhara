<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Tentukan apakah user bisa login ke Filament Admin Panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return (bool) $this->is_active;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nip_nidn',
        'phone',
        'avatar',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi ke profil Member (Personalia/Aslab/Dosen).
     */
    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }

    /**
     * Relasi ke berita yang ditulis user.
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'penulis_id');
    }

    /**
     * Relasi ke booking ruangan yang diapprove user.
     */
    public function approvedBookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'approved_by');
    }

    /**
     * Relasi ke peminjaman alat yang diproses user.
     */
    public function processedLoans(): HasMany
    {
        return $this->hasMany(EquipmentLoan::class, 'diproses_oleh');
    }

    /**
     * Relasi ke log aktivitas yang dilakukan user.
     */
    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Relasi ke jadwal yang dibuat user.
     */
    public function schedulesCreated(): HasMany
    {
        return $this->hasMany(Schedule::class, 'created_by');
    }
}
