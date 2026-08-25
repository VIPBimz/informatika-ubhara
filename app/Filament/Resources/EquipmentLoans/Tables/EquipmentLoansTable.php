<?php

namespace App\Filament\Resources\EquipmentLoans\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EquipmentLoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('equipment.nama')
                    ->label('Alat')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record): string => "{$record->jumlah_unit} Unit"),
                TextColumn::make('nama_peminjam')
                    ->label('Peminjam')
                    ->searchable()
                    ->description(fn ($record): string => "{$record->nim} | {$record->no_wa}"),
                TextColumn::make('tanggal_pinjam')
                    ->label('Tgl Pinjam')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('tanggal_rencana_kembali')
                    ->label('Batas Kembali')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'approved',
                        'primary' => 'dipinjam',
                        'success' => 'dikembalikan',
                        'danger' => ['terlambat', 'ditolak'],
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat' => 'Terlambat',
                        'ditolak' => 'Ditolak',
                        default => $state,
                    }),
                TextColumn::make('processor.name')
                    ->label('Diproses Oleh')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                        'terlambat' => 'Terlambat',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->recordActions([
                Action::make('approveLoan')
                    ->label('Setujui')
                    ->icon('heroicon-o-check')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Pengajuan Peminjaman')
                    ->modalDescription('Stok alat yang tersedia akan otomatis dikurangi sejumlah unit yang dipinjam.')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $equipment = $record->equipment;
                        if ($equipment && $equipment->stok_tersedia >= $record->jumlah_unit) {
                            $equipment->decrement('stok_tersedia', $record->jumlah_unit);
                            $record->update([
                                'status' => 'approved',
                                'diproses_oleh' => auth()->id(),
                            ]);

                            Notification::make()
                                ->title('Peminjaman Berhasil Disetujui')
                                ->body("Stok {$equipment->nama} berkurang {$record->jumlah_unit} unit.")
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Gagal: Stok Tersedia Tidak Cukup')
                                ->danger()
                                ->send();
                        }
                    }),
                Action::make('handover')
                    ->label('Serahkan')
                    ->icon('heroicon-o-arrow-right')
                    ->color('primary')
                    ->requiresConfirmation()
                    ->modalHeading('Serahkan Alat ke Mahasiswa')
                    ->modalDescription('Tandai bahwa alat telah fisik diserahkan kepada peminjam di lab.')
                    ->visible(fn ($record) => $record->status === 'approved')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'dipinjam',
                            'diproses_oleh' => auth()->id(),
                        ]);

                        Notification::make()
                            ->title('Status Diperbarui: Alat Telah Dipinjam')
                            ->success()
                            ->send();
                    }),
                Action::make('returnLoan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-arrow-path-rounded-square')
                    ->color('success')
                    ->form([
                        Textarea::make('catatan_kondisi_kembali')
                            ->label('Catatan Kondisi Alat Saat Diterima Kembali')
                            ->placeholder('Misal: Lengkap, berfungsi normal, dus rapi...')
                            ->required(),
                    ])
                    ->visible(fn ($record) => in_array($record->status, ['dipinjam', 'terlambat']))
                    ->action(function ($record, array $data) {
                        $equipment = $record->equipment;
                        if ($equipment) {
                            $equipment->increment('stok_tersedia', $record->jumlah_unit);
                        }

                        $record->update([
                            'status' => 'dikembalikan',
                            'tanggal_kembali_aktual' => now()->toDateString(),
                            'catatan_kondisi_kembali' => $data['catatan_kondisi_kembali'],
                            'diproses_oleh' => auth()->id(),
                        ]);

                        Notification::make()
                            ->title('Alat Telah Dikembalikan')
                            ->body("Stok {$equipment?->nama} telah dikembalikan sejumlah {$record->jumlah_unit} unit.")
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
