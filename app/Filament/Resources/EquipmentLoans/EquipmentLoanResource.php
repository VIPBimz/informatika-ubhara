<?php

namespace App\Filament\Resources\EquipmentLoans;

use App\Filament\Resources\EquipmentLoans\Pages\CreateEquipmentLoan;
use App\Filament\Resources\EquipmentLoans\Pages\EditEquipmentLoan;
use App\Filament\Resources\EquipmentLoans\Pages\ListEquipmentLoans;
use App\Filament\Resources\EquipmentLoans\Schemas\EquipmentLoanForm;
use App\Filament\Resources\EquipmentLoans\Tables\EquipmentLoansTable;
use App\Models\EquipmentLoan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EquipmentLoanResource extends Resource
{
    protected static ?string $model = EquipmentLoan::class;

    protected static string | UnitEnum | null $navigationGroup = 'Inventaris Alat';

    protected static ?string $navigationLabel = 'Peminjaman Alat';

    protected static ?string $modelLabel = 'Peminjaman Alat';

    protected static ?string $pluralModelLabel = 'Persetujuan & Pengembalian Alat';

    protected static ?int $navigationSort = 3;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    public static function form(Schema $schema): Schema
    {
        return EquipmentLoanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EquipmentLoansTable::configure($table);
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
            'index' => ListEquipmentLoans::route('/'),
            'create' => CreateEquipmentLoan::route('/create'),
            'edit' => EditEquipmentLoan::route('/{record}/edit'),
        ];
    }
}
