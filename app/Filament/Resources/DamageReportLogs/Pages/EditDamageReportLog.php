<?php

namespace App\Filament\Resources\DamageReportLogs\Pages;

use App\Filament\Resources\DamageReportLogs\DamageReportLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDamageReportLog extends EditRecord
{
    protected static string $resource = DamageReportLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
