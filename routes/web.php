<?php

use App\Http\Controllers\KeteranganLulusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LaporanStudiController;
use App\Http\Controllers\MhsAktifController;
use App\Http\Controllers\PengantarTugasMKController;
use App\Http\Middleware\admin;
use App\Http\Middleware\student;
use App\Http\Middleware\staff;
use App\Http\Middleware\kaprodi;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/unauthenticated', function () {
    return view('/error/unauthenticated');
});

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', function () {
    return view('/admin/index');
})->middleware(admin::class);

Route::get('/student', function () {
    return view('/student/index');
})->middleware(student::class);

Route::get('/student/template_mhs_aktif', function () {
    return view('/student/template_mhs_aktif');
})->middleware(student::class);

Route::get('/student/template_pengantar_tugasmk', function () {
    return view('/student/template_pengantar_tugasmk');
})->middleware(student::class);

Route::get('/student/template_ket_lulus', function () {
    return view('/student/template_ket_lulus');
})->middleware(student::class);

Route::get('/student/template_laporan_studi', function () {
    return view('/student/template_laporan_studi');
})->middleware(student::class);

Route::post('/surat/store/template_mhs_aktif', [MhsAktifController::class, 'storeSurat1'])->name('surat.storeSurat1');

Route::post('/surat/store/template_pengantar_tugasmk', [PengantarTugasMKController::class, 'storeSurat2'])->name('surat.storeSurat2');

Route::post('/surat/store/template_ket_lulus', [KeteranganLulusController::class, 'storeSurat3'])->name('surat.storeSurat3');

Route::post('/surat/store/template_laporan_studi', [LaporanStudiController::class, 'storeSurat4'])->name('surat.storeSurat4');


Route::get('/student/status', function () {
    return view('/student/status');
})->middleware(student::class);

Route::get('/staff', function () {
    return view('/staff/index');
})->middleware(staff::class);

Route::get('/kaprodi', function () {
    return view('/kaprodi/index');
})->middleware(kaprodi::class);