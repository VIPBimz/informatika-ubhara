<?php

namespace App\Filament\Resources\DamageReportLogs\Pages;

use App\Filament\Resources\DamageReportLogs\DamageReportLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDamageReportLogs extends ListRecords
{
    protected static string $resource = DamageReportLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
