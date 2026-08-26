<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ActivityLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Pelaku Aksi (User)')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('aksi')
                    ->label('Jenis Aksi / Event')
                    ->required()
                    ->maxLength(150),
                TextInput::make('model_type')
                    ->label('Tipe Model / Modul')
                    ->maxLength(255),
                TextInput::make('model_id')
                    ->label('ID Data')
                    ->numeric(),
                Textarea::make('deskripsi')
                    ->label('Detail Deskripsi Aksi')
                    ->rows(3)
                    ->columnSpanFull(),
                DateTimePicker::make('created_at')
                    ->label('Waktu Terjadinya Aksi')
                    ->default(now()),
            ]);
    }
}
