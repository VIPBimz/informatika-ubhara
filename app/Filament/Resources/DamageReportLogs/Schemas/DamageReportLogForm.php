<?php

namespace App\Filament\Resources\DamageReportLogs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DamageReportLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('damage_report_id')
                    ->relationship('damageReport', 'id')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                Textarea::make('catatan')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('updated_by')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
