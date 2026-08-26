<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Portal IF Ubhara Surabaya
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('index');
})->name('beranda');

// Modul Presensi / Absensi Lab
Route::get('/absensi', [AttendanceController::class, 'index'])->name('absensi');
Route::post('/absensi', [AttendanceController::class, 'store'])->name('absensi.store');
Route::get('/api/attendances/today', [AttendanceController::class, 'todayList'])->name('api.attendances.today');

Route::get('/jadwal-lab', function () {
    return view('jadwal_lab');
})->name('jadwal_lab');
Route::get('/jadwal_lab', function () {
    return redirect()->route('jadwal_lab');
});

Route::get('/pinjam-alat', function () {
    return view('pinjam_alat');
})->name('pinjam_alat');
Route::get('/pinjam_alat', function () {
    return redirect()->route('pinjam_alat');
});

Route::get('/lapor', function () {
    return view('lapor');
})->name('lapor');

use App\Http\Controllers\MemberController;

// Modul Direktori Anggota & Personalia
Route::get('/anggota', [MemberController::class, 'index'])->name('anggota');

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');
