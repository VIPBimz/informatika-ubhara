<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(150),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->maxLength(150)
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                TextInput::make('nip_nidn')
                    ->label('NIP / NIDN / NIM')
                    ->maxLength(50),
                TextInput::make('phone')
                    ->label('Nomor Telepon / WA')
                    ->tel()
                    ->maxLength(20),
                Toggle::make('is_active')
                    ->label('Akun Aktif (Dapat Login CMS)')
                    ->default(true),
                FileUpload::make('avatar')
                    ->label('Foto Avatar')
                    ->image()
                    ->directory('avatars')
                    ->columnSpanFull(),
            ]);
    }
}
