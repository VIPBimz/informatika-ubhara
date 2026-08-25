<?php

namespace App\Filament\Resources\DamageReports\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DamageReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor_tiket')
                    ->label('Nomor Tiket')
                    ->default(fn () => 'TCK-' . date('Ymd') . '-' . rand(100, 999))
                    ->disabled()
                    ->dehydrated()
                    ->required(),
                Select::make('lab_id')
                    ->label('Ruangan Lab')
                    ->relationship('lab', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('lokasi_fasilitas')
                    ->label('Lokasi Spesifik / Nama Perangkat')
                    ->placeholder('Misal: PC-04, Switch Rack 2, Proyektor Lab RPL')
                    ->required()
                    ->maxLength(100),
                Select::make('kategori')
                    ->label('Kategori Kerusakan')
                    ->options([
                        'hardware' => 'Hardware (Perangkat Keras)',
                        'software' => 'Software (Sistem Operasi/Aplikasi)',
                        'jaringan' => 'Jaringan (Kabel/LAN/WiFi)',
                        'fasilitas' => 'Fasilitas (AC/Kursi/Listrik/Proyektor)',
                    ])
                    ->required(),
                TextInput::make('nama_pelapor')
                    ->label('Nama Pelapor')
                    ->required()
                    ->maxLength(150),
                TextInput::make('nim')
                    ->label('NIM Pelapor')
                    ->required()
                    ->maxLength(20),
                TextInput::make('no_wa')
                    ->label('No. WhatsApp Pelapor')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                Select::make('status')
                    ->label('Status Penanganan')
                    ->options([
                        'diterima' => '1. Laporan Diterima',
                        'investigasi' => '2. Dalam Investigasi / Pengecekan',
                        'diperbaiki' => '3. Sedang Dalam Perbaikan',
                        'selesai' => '4. Perbaikan Selesai',
                    ])
                    ->default('diterima')
                    ->required(),
                Select::make('ditangani_oleh')
                    ->label('Petugas / Teknisi / Aslab Penanggung Jawab')
                    ->relationship('handler', 'nama')
                    ->searchable()
                    ->preload(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi Kerusakan & Kronologi')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('foto_bukti')
                    ->label('Foto Bukti Kerusakan')
                    ->image()
                    ->directory('damage_reports')
                    ->columnSpanFull(),
                DateTimePicker::make('tanggal_lapor')
                    ->label('Waktu Pelaporan')
                    ->default(now()),
                DateTimePicker::make('tanggal_selesai')
                    ->label('Waktu Selesai Perbaikan'),
            ]);
    }
}
