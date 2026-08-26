<?php

namespace App\Filament\Resources\EventRegistrations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EventRegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Peserta')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record): string => "{$record->nim_nidn} | {$record->no_wa}"),
                TextColumn::make('event.judul')
                    ->label('Event yang Diikuti')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'info' => 'terdaftar',
                        'success' => 'hadir',
                        'danger' => 'batal',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('created_at')
                    ->label('Tgl Mendaftar')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Filter Event')
                    ->relationship('event', 'judul'),
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'terdaftar' => 'Terdaftar',
                        'hadir' => 'Hadir',
                        'batal' => 'Batal',
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
