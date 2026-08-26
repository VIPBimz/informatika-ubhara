<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pemohon')
                    ->label('Pemohon')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record): string => "{$record->identitas_pemohon} (" . ucfirst($record->jenis_pemohon) . ")"),
                TextColumn::make('schedule.lab.nama')
                    ->label('Ruang Lab')
                    ->badge()
                    ->searchable(),
                TextColumn::make('schedule')
                    ->label('Jadwal Slot')
                    ->formatStateUsing(fn ($record): string => "{$record->schedule?->hari}, Sesi {$record->schedule?->sesi_ke} (" . substr($record->schedule?->jam_mulai, 0, 5) . " - " . substr($record->schedule?->jam_selesai, 0, 5) . ")"),
                TextColumn::make('keperluan')
                    ->label('Keperluan')
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state)))
                    ->searchable(),
                TextColumn::make('estimasi_peserta')
                    ->label('Peserta')
                    ->suffix(' Org')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Diajukan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ]),
                SelectFilter::make('jenis_pemohon')
                    ->label('Jenis Pemohon')
                    ->options([
                        'mahasiswa' => 'Mahasiswa',
                        'dosen' => 'Dosen',
                        'organisasi' => 'Organisasi',
                    ]),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Booking Ruang')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui peminjaman/booking slot ruangan ini?')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'approved',
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                        ]);

                        // Update schedule status if desired
                        $record->schedule?->update(['status' => 'terjadwal']);

                        Notification::make()
                            ->title('Booking Berhasil Disetujui')
                            ->success()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Textarea::make('catatan_admin')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'catatan_admin' => $data['catatan_admin'],
                            'approved_by' => auth()->id(),
                            'approved_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Booking Ditolak')
                            ->warning()
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
