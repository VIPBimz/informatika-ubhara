<?php

namespace App\Filament\Resources\Members\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->checkFileExistence()
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->nama) . '&background=1E3A8A&color=FBBF24&bold=true&size=100'),
                TextColumn::make('nama')
                    ->label('Nama Personalia')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record): string => $record->nim_nidn ?? ''),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->colors([
                        'success' => 'dosen',
                        'warning' => 'aslab',
                        'primary' => 'himatika',
                    ])
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'dosen' => 'Dosen Pembina',
                        'aslab' => 'Asisten Lab',
                        'himatika' => 'Pengurus HIMATIKA',
                        default => ucfirst($state),
                    }),
                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable(),
                TextColumn::make('divisi_keahlian')
                    ->label('Keahlian')
                    ->searchable(),
                TextColumn::make('status_kepengurusan')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'aktif',
                        'gray' => 'purna',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                IconColumn::make('is_published')
                    ->label('Publik')
                    ->boolean(),
                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('urutan')
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options([
                        'dosen' => 'Dosen Pembina',
                        'aslab' => 'Asisten Lab',
                        'himatika' => 'Pengurus HIMATIKA',
                    ]),
                SelectFilter::make('status_kepengurusan')
                    ->label('Status Kepengurusan')
                    ->options([
                        'aktif' => 'Aktif',
                        'purna' => 'Purna',
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
