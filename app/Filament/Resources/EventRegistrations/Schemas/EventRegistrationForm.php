<?php

namespace App\Filament\Resources\EventRegistrations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EventRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('event_id')
                    ->label('Kegiatan / Event')
                    ->relationship('event', 'judul')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nama')
                    ->label('Nama Lengkap Peserta')
                    ->required()
                    ->maxLength(150),
                TextInput::make('nim_nidn')
                    ->label('NIM / NIDN / Instansi')
                    ->required()
                    ->maxLength(50),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->maxLength(150),
                TextInput::make('no_wa')
                    ->label('Nomor WhatsApp')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                Select::make('status')
                    ->label('Status Kehadiran')
                    ->options([
                        'terdaftar' => 'Terdaftar (Terkonfirmasi)',
                        'hadir' => 'Hadir di Acara',
                        'batal' => 'Dibatalkan',
                    ])
                    ->default('terdaftar')
                    ->required(),
            ]);
    }
}
