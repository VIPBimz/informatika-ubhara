<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Kunci Pengaturan (Key)')
                    ->placeholder('Misal: jumlah_mahasiswa_aktif, instagram_url')
                    ->required()
                    ->maxLength(100)
                    ->unique(ignoreRecord: true),
                Textarea::make('value')
                    ->label('Nilai Pengaturan (Value)')
                    ->placeholder('Nilai atau teks konten pengaturan...')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
