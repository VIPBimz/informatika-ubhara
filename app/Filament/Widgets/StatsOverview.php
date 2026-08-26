<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Booking;
use App\Models\DamageReport;
use App\Models\Equipment;
use App\Models\EquipmentLoan;
use App\Models\Lab;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $todayAttendance = Attendance::whereDate('tanggal', now()->toDateString())->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $pendingLoans = EquipmentLoan::where('status', 'pending')->count();
        $activeDamageTickets = DamageReport::whereIn('status', ['diterima', 'investigasi', 'diperbaiki'])->count();
        $totalActiveLabs = Lab::where('status', 'aktif')->count();
        $totalEquipmentStock = Equipment::sum('stok_tersedia');

        return [
            Stat::make('Presensi Hari Ini', $todayAttendance . ' Mahasiswa')
                ->description('Total presensi lab hari ini')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Booking Pending', $pendingBookings . ' Pengajuan')
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingBookings > 0 ? 'warning' : 'gray'),

            Stat::make('Pinjam Alat Pending', $pendingLoans . ' Permintaan')
                ->description('Menunggu verifikasi aslab')
                ->descriptionIcon('heroicon-m-cube')
                ->color($pendingLoans > 0 ? 'warning' : 'gray'),

            Stat::make('Tiket Kerusakan Aktif', $activeDamageTickets . ' Tiket')
                ->description('Dalam proses perbaikan')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color($activeDamageTickets > 0 ? 'danger' : 'success'),

            Stat::make('Laboratorium Aktif', $totalActiveLabs . ' Ruangan')
                ->description('Siap digunakan praktikum')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info'),

            Stat::make('Stok Alat Siap Pakai', $totalEquipmentStock . ' Unit')
                ->description('Tersedia di inventaris')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
        ];
    }
}
