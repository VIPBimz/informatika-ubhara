<?php

namespace App\Filament\Resources\EquipmentLoans\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EquipmentLoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('equipment_id')
                    ->label('Alat yang Dipinjam')
                    ->relationship('equipment', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nama_peminjam')
                    ->label('Nama Peminjam')
                    ->required()
                    ->maxLength(150),
                TextInput::make('nim')
                    ->label('NIM Peminjam')
                    ->required()
                    ->maxLength(20),
                TextInput::make('no_wa')
                    ->label('Nomor WhatsApp')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                TextInput::make('jumlah_unit')
                    ->label('Jumlah Unit')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required(),
                DatePicker::make('tanggal_pinjam')
                    ->label('Tanggal Pinjam')
                    ->default(now())
                    ->required(),
                DatePicker::make('tanggal_rencana_kembali')
                    ->label('Rencana Tanggal Pengembalian')
                    ->default(now()->addDays(3))
                    ->required(),
                DatePicker::make('tanggal_kembali_aktual')
                    ->label('Tanggal Kembali Aktual'),
                Select::make('status')
                    ->label('Status Peminjaman')
                    ->options([
                        'pending' => 'Pending (Menunggu Persetujuan)',
                        'approved' => 'Approved (Disetujui, Siap Diambil)',
                        'dipinjam' => 'Dipinjam (Alat Sudah Di Tangan Peminjam)',
                        'dikembalikan' => 'Dikembalikan (Selesai)',
                        'terlambat' => 'Terlambat Pengembalian',
                        'ditolak' => 'Ditolak',
                    ])
                    ->default('pending')
                    ->required(),
                Select::make('diproses_oleh')
                    ->label('Diproses Oleh (Aslab/Admin)')
                    ->relationship('processor', 'name')
                    ->searchable()
                    ->preload(),
                Textarea::make('keperluan')
                    ->label('Keperluan Peminjaman (TA/Praktikum/Lomba)')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('catatan_kondisi_kembali')
                    ->label('Catatan Kondisi Alat Saat Pengembalian')
                    ->placeholder('Misal: Kondisi lengkap, tanpa cacat, semua tombol berfungsi...')
                    ->columnSpanFull(),
                Checkbox::make('setuju_sop')
                    ->label('Menyetujui SOP Peminjaman Alat Laboratorium')
                    ->default(true)
                    ->required(),
            ]);
    }
}
