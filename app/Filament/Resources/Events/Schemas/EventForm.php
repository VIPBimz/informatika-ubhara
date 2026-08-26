<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->label('Nama Kegiatan / Acara')
                    ->placeholder('Misal: Bootcamp Fullstack Laravel & React 2026')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status Event')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published (Pendaftaran Buka)',
                        'selesai' => 'Selesai',
                    ])
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('tanggal_mulai')
                    ->label('Waktu Mulai')
                    ->required(),
                DateTimePicker::make('tanggal_selesai')
                    ->label('Waktu Selesai')
                    ->required(),
                TextInput::make('lokasi_atau_link')
                    ->label('Lokasi Fisik / Link Online')
                    ->placeholder('Misal: Lab RPL Lt. 3 / Zoom Meeting')
                    ->required()
                    ->maxLength(255),
                TextInput::make('kuota')
                    ->label('Kuota Peserta (Opsional)')
                    ->numeric()
                    ->minValue(1),
                FileUpload::make('poster')
                    ->label('Poster Acara')
                    ->image()
                    ->directory('events')
                    ->columnSpanFull(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi & Silabus Acara')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}
