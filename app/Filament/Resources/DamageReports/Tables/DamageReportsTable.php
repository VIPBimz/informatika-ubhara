<?php

namespace App\Filament\Resources\DamageReports\Tables;

use App\Models\DamageReportLog;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DamageReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('No. Tiket')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('lab.nama')
                    ->label('Ruang Lab')
                    ->searchable(),
                TextColumn::make('lokasi_fasilitas')
                    ->label('Fasilitas / Unit')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('nama_pelapor')
                    ->label('Pelapor')
                    ->description(fn ($record): string => "{$record->nim} | {$record->no_wa}")
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status Alur')
                    ->badge()
                    ->colors([
                        'warning' => 'diterima',
                        'info' => 'investigasi',
                        'primary' => 'diperbaiki',
                        'success' => 'selesai',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'diterima' => '1. Diterima',
                        'investigasi' => '2. Investigasi',
                        'diperbaiki' => '3. Diperbaiki',
                        'selesai' => '4. Selesai',
                        default => $state,
                    }),
                ImageColumn::make('foto_bukti')
                    ->label('Foto Bukti')
                    ->circular(),
                TextColumn::make('tanggal_lapor')
                    ->label('Waktu Lapor')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'diterima' => '1. Diterima',
                        'investigasi' => '2. Investigasi',
                        'diperbaiki' => '3. Diperbaiki',
                        'selesai' => '4. Selesai',
                    ]),
                SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options([
                        'hardware' => 'Hardware',
                        'software' => 'Software',
                        'jaringan' => 'Jaringan',
                        'fasilitas' => 'Fasilitas',
                    ]),
                SelectFilter::make('lab_id')
                    ->label('Filter Ruangan')
                    ->relationship('lab', 'nama'),
            ])
            ->recordActions([
                Action::make('updateStatus')
                    ->label('Update Progress')
                    ->icon('heroicon-o-arrow-path')
                    ->color('primary')
                    ->form([
                        Select::make('status')
                            ->label('Ubah Status Menjadi')
                            ->options([
                                'diterima' => '1. Laporan Diterima',
                                'investigasi' => '2. Dalam Investigasi / Pengecekan',
                                'diperbaiki' => '3. Sedang Dalam Perbaikan',
                                'selesai' => '4. Perbaikan Selesai',
                            ])
                            ->required(),
                        Textarea::make('catatan')
                            ->label('Catatan Penanganan')
                            ->placeholder('Jelaskan tindakan yang diambil teknisi / aslab...'),
                    ])
                    ->action(function ($record, array $data) {
                        $updateData = ['status' => $data['status']];
                        if ($data['status'] === 'selesai' && ! $record->tanggal_selesai) {
                            $updateData['tanggal_selesai'] = now();
                        }

                        $record->update($updateData);

                        DamageReportLog::create([
                            'damage_report_id' => $record->id,
                            'status' => $data['status'],
                            'catatan' => $data['catatan'] ?? null,
                            'updated_by' => auth()->id(),
                        ]);

                        Notification::make()
                            ->title('Status Tiket Berhasil Diperbarui')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
