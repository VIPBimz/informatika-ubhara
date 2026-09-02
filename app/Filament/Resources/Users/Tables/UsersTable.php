<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->disk('public')
                    ->checkFileExistence()
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&background=1E3A8A&color=FBBF24&bold=true&size=100'),
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Role Hak Akses')
                    ->badge()
                    ->colors([
                        'danger' => 'superadmin',
                        'success' => 'dosen',
                        'warning' => 'aslab',
                        'info' => 'himatika',
                        'gray' => 'user',
                    ])
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'superadmin' => 'Super Admin',
                        'dosen' => 'Dosen / Kalab',
                        'aslab' => 'Asisten Lab',
                        'himatika' => 'HIMATIKA',
                        'user' => 'Mahasiswa / User',
                        default => ucfirst($state ?? '—'),
                    })
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Telepon / WA')
                    ->searchable(),
                TextColumn::make('member.jabatan')
                    ->label('Jabatan Personalia')
                    ->badge()
                    ->placeholder('—')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Filter Role Akses')
                    ->options([
                        'superadmin' => 'Super Admin',
                        'dosen' => 'Dosen Pembina / Kepala Lab',
                        'aslab' => 'Asisten Lab',
                        'himatika' => 'Pengurus HIMATIKA',
                        'user' => 'Mahasiswa / Pengguna Terdaftar',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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
