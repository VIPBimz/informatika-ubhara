<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('schedule_id')
                    ->label('Slot Jadwal & Ruangan')
                    ->relationship('schedule', 'mata_kuliah')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->lab?->nama} — {$record->hari}, Sesi {$record->sesi_ke} ({$record->jam_mulai} - {$record->jam_selesai})")
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nama_pemohon')
                    ->label('Nama Pemohon')
                    ->required()
                    ->maxLength(150),
                TextInput::make('identitas_pemohon')
                    ->label('NIM / NIDN')
                    ->required()
                    ->maxLength(50),
                Select::make('jenis_pemohon')
                    ->label('Jenis Pemohon')
                    ->options([
                        'mahasiswa' => 'Mahasiswa',
                        'dosen' => 'Dosen',
                        'organisasi' => 'Organisasi / UKM',
                    ])
                    ->required(),
                Select::make('keperluan')
                    ->label('Keperluan Penggunaan')
                    ->options([
                        'kuliah_pengganti' => 'Kuliah Pengganti',
                        'seminar' => 'Seminar / Workshop',
                        'riset' => 'Riset / Penelitian',
                        'ujian_praktikum' => 'Ujian Praktikum / TA',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                TextInput::make('estimasi_peserta')
                    ->label('Estimasi Peserta')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Select::make('status')
                    ->label('Status Persetujuan')
                    ->options([
                        'pending' => 'Menunggu Review (Pending)',
                        'approved' => 'Disetujui (Approved)',
                        'rejected' => 'Ditolak (Rejected)',
                    ])
                    ->default('pending')
                    ->required(),
                Textarea::make('catatan_admin')
                    ->label('Catatan Admin / Alasan Penolakan')
                    ->columnSpanFull(),
                Select::make('approved_by')
                    ->label('Ditinjau Oleh')
                    ->relationship('approver', 'name')
                    ->searchable()
                    ->preload(),
                DateTimePicker::make('approved_at')
                    ->label('Waktu Persetujuan'),
            ]);
    }
}
