<?php

namespace App\Filament\Resources\Equipment\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EquipmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori Alat')
                    ->relationship('category', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nama')
                    ->label('Nama Alat / Perangkat')
                    ->placeholder('Misal: Router MikroTik, Modul ESP32, VR Headset')
                    ->required()
                    ->maxLength(150),
                TextInput::make('model_seri')
                    ->label('Model / No Seri')
                    ->placeholder('Misal: RB750Gr3')
                    ->maxLength(150),
                Select::make('kondisi')
                    ->label('Kondisi Fisik')
                    ->options([
                        'sangat_baik' => 'Sangat Baik (Prima)',
                        'baik' => 'Baik (Normal)',
                        'perlu_perbaikan' => 'Perlu Perbaikan / Rusak Ringan',
                    ])
                    ->default('sangat_baik')
                    ->required(),
                TextInput::make('stok_total')
                    ->label('Total Stok Unit')
                    ->numeric()
                    ->minValue(0)
                    ->default(1)
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        if ($get('stok_tersedia') === null || $get('stok_tersedia') > $state) {
                            $set('stok_tersedia', $state);
                        }
                    }),
                TextInput::make('stok_tersedia')
                    ->label('Stok Tersedia Dipinjam')
                    ->numeric()
                    ->minValue(0)
                    ->default(1)
                    ->required(),
                Select::make('status')
                    ->label('Status Inventaris')
                    ->options([
                        'aktif' => 'Aktif (Dapat Dipinjam)',
                        'nonaktif' => 'Nonaktif (Diarsipkan/Dihapus)',
                    ])
                    ->default('aktif')
                    ->required(),
                FileUpload::make('foto')
                    ->label('Foto Alat')
                    ->image()
                    ->directory('equipments')
                    ->columnSpanFull(),
                Textarea::make('spesifikasi')
                    ->label('Spesifikasi & Kelengkapan')
                    ->placeholder('Kelengkapan: Kabel power, adaptor, dus...')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
