<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lab.nama')
                    ->label('Ruangan Lab')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('hari')
                    ->label('Hari')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),
                TextColumn::make('sesi_ke')
                    ->label('Sesi')
                    ->formatStateUsing(fn ($record): string => 'Sesi ' . $record->sesi_ke . ' (' . substr($record->jam_mulai, 0, 5) . ' - ' . substr($record->jam_selesai, 0, 5) . ')')
                    ->sortable(),
                TextColumn::make('mata_kuliah')
                    ->label('Mata Kuliah')
                    ->placeholder('— (Slot Kosong)')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable(),
                TextColumn::make('aslabJaga.nama')
                    ->label('Aslab Jaga')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'tersedia',
                        'info' => 'terjadwal',
                        'danger' => 'maintenance',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'tersedia' => 'Tersedia (Bisa Booking)',
                        'terjadwal' => 'Terjadwal',
                        'maintenance' => 'Maintenance',
                        default => $state,
                    }),
            ])
            ->filters([
                SelectFilter::make('lab_id')
                    ->label('Filter Ruangan')
                    ->relationship('lab', 'nama'),
                SelectFilter::make('hari')
                    ->label('Filter Hari')
                    ->options([
                        'senin' => 'Senin',
                        'selasa' => 'Selasa',
                        'rabu' => 'Rabu',
                        'kamis' => 'Kamis',
                        'jumat' => 'Jumat',
                        'sabtu' => 'Sabtu',
                    ]),
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'terjadwal' => 'Terjadwal',
                        'maintenance' => 'Maintenance',
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
