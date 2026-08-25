<?php

namespace App\Filament\Resources\DamageReportLogs;

use App\Filament\Resources\DamageReportLogs\Pages\CreateDamageReportLog;
use App\Filament\Resources\DamageReportLogs\Pages\EditDamageReportLog;
use App\Filament\Resources\DamageReportLogs\Pages\ListDamageReportLogs;
use App\Filament\Resources\DamageReportLogs\Schemas\DamageReportLogForm;
use App\Filament\Resources\DamageReportLogs\Tables\DamageReportLogsTable;
use App\Models\DamageReportLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DamageReportLogResource extends Resource
{
    protected static ?string $model = DamageReportLog::class;

    protected static string | UnitEnum | null $navigationGroup = 'Layanan Lab';

    protected static ?string $navigationLabel = 'Log Riwayat Tiket';

    protected static ?string $modelLabel = 'Log Tiket';

    protected static ?string $pluralModelLabel = 'Log Riwayat Tiket Kerusakan';

    protected static ?int $navigationSort = 4;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedQueueList;

    public static function form(Schema $schema): Schema
    {
        return DamageReportLogForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DamageReportLogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDamageReportLogs::route('/'),
            'create' => CreateDamageReportLog::route('/create'),
            'edit' => EditDamageReportLog::route('/{record}/edit'),
        ];
    }
}
