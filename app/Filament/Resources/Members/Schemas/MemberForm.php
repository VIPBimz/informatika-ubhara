<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Akun Login Terkait (Opsional)')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('nama')
                    ->label('Nama Lengkap beserta Gelar')
                    ->required()
                    ->maxLength(150),
                TextInput::make('nim_nidn')
                    ->label('NIM / NIDN')
                    ->maxLength(50),
                Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'dosen' => 'Dosen Pembina / Kepala Lab',
                        'aslab' => 'Asisten Laboratorium',
                        'himatika' => 'Pengurus HIMATIKA',
                    ])
                    ->required(),
                TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->placeholder('Misal: Kepala Laboratorium, Koordinator Aslab, Staf Kominfo')
                    ->required()
                    ->maxLength(150),
                TextInput::make('divisi_keahlian')
                    ->label('Keahlian / Fokus Bidang')
                    ->placeholder('Misal: Fullstack Web, Cyber Security, AI')
                    ->maxLength(150),
                TextInput::make('angkatan')
                    ->label('Angkatan')
                    ->placeholder('2022')
                    ->maxLength(10),
                Select::make('status_kepengurusan')
                    ->label('Status Kepengurusan')
                    ->options([
                        'aktif' => 'Aktif',
                        'purna' => 'Purna Tugas / Alumni',
                    ])
                    ->default('aktif')
                    ->required(),
                TextInput::make('email_kontak')
                    ->label('Email Kontak')
                    ->email()
                    ->maxLength(255),
                TextInput::make('instagram_url')
                    ->label('URL Instagram')
                    ->url()
                    ->placeholder('https://instagram.com/username'),
                TextInput::make('linkedin_url')
                    ->label('URL LinkedIn')
                    ->url()
                    ->placeholder('https://linkedin.com/in/username'),
                TextInput::make('github_url')
                    ->label('URL GitHub')
                    ->url()
                    ->placeholder('https://github.com/username'),
                TextInput::make('urutan')
                    ->label('Nomor Urut Tampilan')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_published')
                    ->label('Tampilkan di Halaman Publik Direktori')
                    ->default(true),
                FileUpload::make('foto')
                    ->label('Foto Profil')
                    ->image()
                    ->directory('members')
                    ->columnSpanFull(),
            ]);
    }
}
