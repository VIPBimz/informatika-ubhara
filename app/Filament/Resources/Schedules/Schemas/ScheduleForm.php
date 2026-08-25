<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('lab_id')
                    ->label('Ruangan Lab')
                    ->relationship('lab', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('hari')
                    ->label('Hari')
                    ->options([
                        'senin' => 'Senin',
                        'selasa' => 'Selasa',
                        'rabu' => 'Rabu',
                        'kamis' => 'Kamis',
                        'jumat' => 'Jumat',
                        'sabtu' => 'Sabtu',
                    ])
                    ->required(),
                Select::make('sesi_ke')
                    ->label('Sesi Ke')
                    ->options([
                        1 => 'Sesi 1 (08.00 - 10.00)',
                        2 => 'Sesi 2 (10.00 - 12.00)',
                        3 => 'Sesi 3 (13.00 - 15.00)',
                        4 => 'Sesi 4 (15.30 - 17.30)',
                        5 => 'Sesi 5 (18.30 - 20.30)',
                    ])
                    ->required(),
                TimePicker::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->required(),
                TimePicker::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->required(),
                Select::make('status')
                    ->label('Status Slot')
                    ->options([
                        'tersedia' => 'Tersedia (Bisa Dibooking)',
                        'terjadwal' => 'Terjadwal (Praktikum / Terpakai)',
                        'maintenance' => 'Maintenance (Tidak Dapat Dipakai)',
                    ])
                    ->default('tersedia')
                    ->required(),
                TextInput::make('mata_kuliah')
                    ->label('Mata Kuliah')
                    ->placeholder('Contoh: Pemrograman Web Lanjut')
                    ->maxLength(150),
                TextInput::make('kelas')
                    ->label('Kelas / Paralel')
                    ->placeholder('Contoh: IF-A, IF-B')
                    ->maxLength(50),
                TextInput::make('semester')
                    ->label('Semester / Tahun Akademik')
                    ->placeholder('Contoh: Ganjil 2026/2027')
                    ->maxLength(20),
                TextInput::make('dosen_pengampu')
                    ->label('Dosen Pengampu')
                    ->maxLength(150),
                Select::make('aslab_jaga_id')
                    ->label('Asisten Lab yang Bertugas')
                    ->relationship('aslabJaga', 'nama')
                    ->searchable()
                    ->preload(),
                TextInput::make('jumlah_mahasiswa')
                    ->label('Jumlah Mahasiswa')
                    ->numeric()
                    ->minValue(0),
            ]);
    }
}
