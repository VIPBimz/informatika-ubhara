<?php

namespace App\Filament\Resources\GalleryAlbums\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GalleryAlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori Galeri')
                    ->relationship('category', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('judul')
                    ->label('Judul Album Kegiatan')
                    ->placeholder('Misal: Dokumentasi Workshop AI 2026')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('tanggal_kegiatan')
                    ->label('Tanggal Kegiatan')
                    ->default(now())
                    ->required(),
                FileUpload::make('cover')
                    ->label('Foto Sampul Album (Cover)')
                    ->image()
                    ->directory('gallery_covers'),
                Textarea::make('deskripsi')
                    ->label('Deskripsi Kegiatan')
                    ->rows(3)
                    ->columnSpanFull(),
                Repeater::make('photos')
                    ->label('Daftar Foto Dokumentasi dalam Album')
                    ->relationship('photos')
                    ->schema([
                        FileUpload::make('foto')
                            ->label('File Foto')
                            ->image()
                            ->directory('gallery_photos')
                            ->required(),
                        TextInput::make('keterangan')
                            ->label('Keterangan Foto')
                            ->placeholder('Misal: Sambutan Kaprodi...'),
                        TextInput::make('urutan')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
