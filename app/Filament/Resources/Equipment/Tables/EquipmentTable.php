<?php

namespace App\Filament\Resources\Equipment\Tables;

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

class EquipmentTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('nama')
                    ->label('Nama Alat')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record): string => $record->model_seri ? "Seri: {$record->model_seri}" : ''),
                TextColumn::make('category.nama')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),
                TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge()
                    ->colors([
                        'success' => 'sangat_baik',
                        'info' => 'baik',
                        'danger' => 'perlu_perbaikan',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'sangat_baik' => 'Sangat Baik',
                        'baik' => 'Baik',
                        'perlu_perbaikan' => 'Perlu Perbaikan',
                        default => $state,
                    }),
                TextColumn::make('stok_tersedia')
                    ->label('Stok Tersedia')
                    ->formatStateUsing(fn ($record): string => "{$record->stok_tersedia} / {$record->stok_total} Unit")
                    ->badge()
                    ->colors([
                        'danger' => fn ($state) => (int) $state === 0,
                        'warning' => fn ($state) => (int) $state > 0 && (int) $state <= 2,
                        'success' => fn ($state) => (int) $state > 2,
                    ]),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'aktif',
                        'danger' => 'nonaktif',
                    ]),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Filter Kategori')
                    ->relationship('category', 'nama'),
                SelectFilter::make('kondisi')
                    ->label('Filter Kondisi')
                    ->options([
                        'sangat_baik' => 'Sangat Baik',
                        'baik' => 'Baik',
                        'perlu_perbaikan' => 'Perlu Perbaikan',
                    ]),
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
