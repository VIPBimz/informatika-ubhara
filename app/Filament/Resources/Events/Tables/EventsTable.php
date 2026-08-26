<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('poster')
                    ->label('Poster')
                    ->square(),
                TextColumn::make('judul')
                    ->label('Nama Acara')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(),
                TextColumn::make('lokasi_atau_link')
                    ->label('Lokasi / Media')
                    ->searchable(),
                TextColumn::make('tanggal_mulai')
                    ->label('Waktu Pelaksanaan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('registrations_count')
                    ->label('Pendaftar')
                    ->counts('registrations')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state, $record) => $record->kuota ? "{$state} / {$record->kuota}" : "{$state} Org"),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                        'gray' => 'selesai',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
            ])
            ->defaultSort('tanggal_mulai', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'selesai' => 'Selesai',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
