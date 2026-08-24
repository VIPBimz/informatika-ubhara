<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Portal IF Ubhara Surabaya
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('beranda');

Route::get('/absensi', function () {
    return view('absensi');
})->name('absensi');

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

Route::get('/anggota', function () {
    return view('anggota');
})->name('anggota');

Route::get('/berita', function () {
    return view('berita');
})->name('berita');

Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');
