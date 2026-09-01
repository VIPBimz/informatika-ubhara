<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_SUPERADMIN = 'superadmin';
    public const ROLE_DOSEN = 'dosen';
    public const ROLE_ASLAB = 'aslab';
    public const ROLE_HIMATIKA = 'himatika';
    public const ROLE_USER = 'user';

    /**
     * Daftar seluruh role yang didukung sistem.
     */
    public static function getRolesList(): array
    {
        return [
            self::ROLE_SUPERADMIN => 'Super Admin (Akses Penuh)',
            self::ROLE_DOSEN => 'Dosen Pembina / Kepala Lab',
            self::ROLE_ASLAB => 'Asisten Laboratorium',
            self::ROLE_HIMATIKA => 'Pengurus HIMATIKA',
            self::ROLE_USER => 'Pengguna Terdaftar / Mahasiswa',
        ];
    }

    /**
     * Cek apakah user memiliki role Super Admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    /**
     * Cek apakah user memiliki role Dosen Pembina / Kepala Lab.
     */
    public function isDosen(): bool
    {
        return $this->role === self::ROLE_DOSEN;
    }

    /**
     * Cek apakah user memiliki role Asisten Lab.
     */
    public function isAslab(): bool
    {
        return $this->role === self::ROLE_ASLAB;
    }

    /**
     * Cek apakah user memiliki role HIMATIKA.
     */
    public function isHimatika(): bool
    {
        return $this->role === self::ROLE_HIMATIKA;
    }

    /**
     * Avatar URL untuk Filament panel (HasAvatar).
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if (! $this->avatar) {
            return null;
        }

        return Storage::disk('public')->exists($this->avatar)
            ? Storage::url($this->avatar)
            : asset('storage/' . $this->avatar);
    }

    /**
     * Accessor untuk foto avatar pengguna dengan fallback dinamis.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return Storage::disk('public')->exists($this->avatar)
                ? Storage::url($this->avatar)
                : asset('storage/' . $this->avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=1E3A8A&color=FBBF24&bold=true&size=200';
    }

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
        'role',
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
