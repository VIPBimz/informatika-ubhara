<?php

namespace App\Filament\Resources\GalleryAlbums\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class GalleryAlbumsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Cover')
                    ->square(),
                TextColumn::make('judul')
                    ->label('Judul Album')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(),
                TextColumn::make('category.nama')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),
                TextColumn::make('photos_count')
                    ->label('Jumlah Foto')
                    ->counts('photos')
                    ->badge()
                    ->color('info'),
                TextColumn::make('tanggal_kegiatan')
                    ->label('Tgl Kegiatan')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('tanggal_kegiatan', 'desc')
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Filter Kategori')
                    ->relationship('category', 'nama'),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
