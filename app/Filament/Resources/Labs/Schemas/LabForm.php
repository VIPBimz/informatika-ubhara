<?php

namespace App\Filament\Resources\Labs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LabForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->label('Kode Ruangan')
                    ->placeholder('Contoh: LAB-RPL')
                    ->required()
                    ->maxLength(20)
                    ->unique(ignoreRecord: true),
                TextInput::make('nama')
                    ->label('Nama Laboratorium')
                    ->placeholder('Contoh: Lab Rekayasa Perangkat Lunak & Basis Data')
                    ->required()
                    ->maxLength(150),
                TextInput::make('kapasitas')
                    ->label('Kapasitas Peserta/PC')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->suffix('Orang'),
                Select::make('status')
                    ->label('Status Ruangan')
                    ->options([
                        'aktif' => 'Aktif (Dapat Digunakan)',
                        'maintenance' => 'Dalam Pemeliharaan / Maintenance',
                    ])
                    ->default('aktif')
                    ->required(),
                FileUpload::make('foto')
                    ->label('Foto Ruang Lab')
                    ->image()
                    ->directory('labs')
                    ->columnSpanFull(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi & Fasilitas')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
