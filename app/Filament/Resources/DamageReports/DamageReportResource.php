<?php

namespace App\Filament\Resources\DamageReports;

use App\Filament\Resources\DamageReports\Pages\CreateDamageReport;
use App\Filament\Resources\DamageReports\Pages\EditDamageReport;
use App\Filament\Resources\DamageReports\Pages\ListDamageReports;
use App\Filament\Resources\DamageReports\Schemas\DamageReportForm;
use App\Filament\Resources\DamageReports\Tables\DamageReportsTable;
use App\Models\DamageReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DamageReportResource extends Resource
{
    protected static ?string $model = DamageReport::class;

    protected static string | UnitEnum | null $navigationGroup = 'Layanan Lab';

    protected static ?string $navigationLabel = 'Tiket Kerusakan';

    protected static ?string $modelLabel = 'Tiket Kerusakan';

    protected static ?string $pluralModelLabel = 'Laporan Kerusakan & Helpdesk';

    protected static ?int $navigationSort = 3;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    public static function form(Schema $schema): Schema
    {
        return DamageReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DamageReportsTable::configure($table);
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
            'index' => ListDamageReports::route('/'),
            'create' => CreateDamageReport::route('/create'),
            'edit' => EditDamageReport::route('/{record}/edit'),
        ];
    }
}
