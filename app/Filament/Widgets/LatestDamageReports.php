<?php

namespace App\Filament\Widgets;

use App\Models\DamageReport;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestDamageReports extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('5 Laporan Kerusakan Terkini (Helpdesk)')
            ->query(
                DamageReport::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->badge()
                    ->sortable(),
                TextColumn::make('lab.nama')
                    ->label('Ruang Lab'),
                TextColumn::make('lokasi_fasilitas')
                    ->label('Fasilitas / Unit')
                    ->weight('bold'),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('nama_pelapor')
                    ->label('Pelapor')
                    ->description(fn ($record): string => "{$record->nim} | {$record->no_wa}"),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'diterima',
                        'info' => 'investigasi',
                        'primary' => 'diperbaiki',
                        'success' => 'selesai',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'diterima' => 'Diterima',
                        'investigasi' => 'Investigasi',
                        'diperbaiki' => 'Diperbaiki',
                        'selesai' => 'Selesai',
                        default => $state,
                    }),
                TextColumn::make('tanggal_lapor')
                    ->label('Waktu Lapor')
                    ->dateTime('d M Y, H:i'),
            ])
            ->paginated(false);
    }
}
