<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nim')
                    ->label('NIM Mahasiswa')
                    ->required()
                    ->maxLength(20),
                TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(150),
                TextInput::make('tujuan')
                    ->label('Tujuan Kunjungan / Praktikum')
                    ->placeholder('Contoh: Praktikum Basis Data Sesi 1')
                    ->required()
                    ->maxLength(255),
                Select::make('lab_id')
                    ->label('Ruangan Lab')
                    ->relationship('lab', 'nama')
                    ->searchable()
                    ->preload(),
                DatePicker::make('tanggal')
                    ->label('Tanggal Kunjungan')
                    ->default(now())
                    ->required(),
                TimePicker::make('jam_masuk')
                    ->label('Jam Masuk')
                    ->default(now()->format('H:i:s'))
                    ->required(),
            ]);
    }
}
