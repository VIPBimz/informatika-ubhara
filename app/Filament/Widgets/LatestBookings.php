<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBookings extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('5 Pengajuan Booking Ruangan Terbaru')
            ->query(
                Booking::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('nama_pemohon')
                    ->label('Pemohon')
                    ->weight('bold')
                    ->description(fn ($record): string => "{$record->identitas_pemohon} (" . ucfirst($record->jenis_pemohon) . ")"),
                TextColumn::make('schedule.lab.nama')
                    ->label('Ruang Lab')
                    ->badge(),
                TextColumn::make('schedule')
                    ->label('Slot Jadwal')
                    ->formatStateUsing(fn ($record): string => "{$record->schedule?->hari}, Sesi {$record->schedule?->sesi_ke} (" . substr($record->schedule?->jam_mulai, 0, 5) . " - " . substr($record->schedule?->jam_selesai, 0, 5) . ")"),
                TextColumn::make('keperluan')
                    ->label('Keperluan')
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('created_at')
                    ->label('Diajukan')
                    ->dateTime('d M Y, H:i'),
            ])
            ->paginated(false);
    }
}
