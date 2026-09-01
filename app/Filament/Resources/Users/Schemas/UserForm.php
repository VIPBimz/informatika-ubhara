<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(150),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->maxLength(150)
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                Select::make('role')
                    ->label('Role & Hak Akses CMS')
                    ->options(function () {
                        /** @var \App\Models\User|null $currentUser */
                        $currentUser = Auth::user();
                        $roles = [
                            'superadmin' => 'Super Admin (Akses Tertinggi)',
                            'dosen' => 'Dosen Pembina / Kepala Lab',
                            'aslab' => 'Asisten Laboratorium',
                            'himatika' => 'Pengurus HIMATIKA',
                            'user' => 'Pengguna Terdaftar / Mahasiswa',
                        ];

                        // Jika user saat ini adalah superadmin, seluruh role (hingga superadmin) dapat diset
                        if ($currentUser && $currentUser->isSuperAdmin()) {
                            return $roles;
                        }

                        // Jika bukan superadmin, opsi superadmin disembunyikan
                        unset($roles['superadmin']);
                        return $roles;
                    })
                    ->default('user')
                    ->required()
                    ->disabled(function ($record) {
                        /** @var \App\Models\User|null $currentUser */
                        $currentUser = Auth::user();
                        if (! $currentUser) {
                            return true;
                        }
                        // Hanya Super Admin yang berhak mengubah role
                        return ! $currentUser->isSuperAdmin();
                    })
                    ->helperText(function () {
                        /** @var \App\Models\User|null $currentUser */
                        $currentUser = Auth::user();
                        if ($currentUser && $currentUser->isSuperAdmin()) {
                            return 'Super Admin berwenang penuh mengubah role pengguna lain hingga tingkat maksimal Super Admin.';
                        }
                        return 'Hanya Super Admin yang dapat mengubah role akun ini.';
                    }),
                TextInput::make('nip_nidn')
                    ->label('NIP / NIDN / NIM')
                    ->maxLength(50),
                TextInput::make('phone')
                    ->label('Nomor Telepon / WA')
                    ->tel()
                    ->maxLength(20),
                Toggle::make('is_active')
                    ->label('Akun Aktif (Dapat Login CMS)')
                    ->default(true)
                    ->disabled(function ($record) {
                        $currentUser = Auth::user();
                        // Lindungi superadmin yang sedang login agar tidak menonaktifkan akun sendiri
                        if ($record && $currentUser && $record->id === $currentUser->id && $record->isSuperAdmin()) {
                            return true;
                        }
                        return false;
                    })
                    ->helperText(function ($record) {
                        $currentUser = Auth::user();
                        if ($record && $currentUser && $record->id === $currentUser->id && $record->isSuperAdmin()) {
                            return 'Akun Super Admin Anda yang sedang aktif tidak dapat dinonaktifkan sendiri.';
                        }
                        return 'Super Admin dapat mengaktifkan / menonaktifkan izin login akun ini.';
                    }),
                FileUpload::make('avatar')
                    ->label('Foto Avatar Pengguna')
                    ->image()
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(5120)
                    ->helperText('Format JPG, PNG, atau WEBP. Maksimal 5MB. Disimpan di storage publik.')
                    ->columnSpanFull(),
            ]);
    }
}
