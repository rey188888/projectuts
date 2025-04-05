<?php

use App\Http\Controllers\Surat\KeteranganLulusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Surat\LaporanStudiController;
use App\Http\Controllers\Surat\MhsAktifController; // Ensure this controller exists in the specified namespace
use App\Http\Controllers\Surat\PengantarTugasMKController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\StatusController;
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

// Routes for admin
Route::get('/admin/dashboard', function () {
    return view('/admin/index');
})->middleware(admin::class);

// Routes for student
Route::prefix('student')->name('student.')->middleware(student::class)->group(function () {
    Route::get('/status', [StatusController::class, 'index'])->name('student.status');

    Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
        Route::get('/', [PengajuanController::class, 'index'])->name('student.index');

        Route::get('/template_mhs_aktif', function () {
            return view('/student/template_mhs_aktif');
        })->middleware(student::class);

        Route::get('/template_pengantar_tugasmk', function () {
            return view('/student/template_pengantar_tugasmk');
        })->middleware(student::class);

        Route::get('/template_ket_lulus', function () {
            return view('/student/template_ket_lulus');
        })->middleware(student::class);

        Route::get('/template_laporan_studi', function () {
            return view('/student/template_laporan_studi');
        })->middleware(student::class);
    });
});

Route::post('/surat/store/template_mhs_aktif', [MhsAktifController::class, 'storeSurat1'])->name('detailsurat.storeSurat1');

Route::post('/surat/store/template_pengantar_tugasmk', [PengantarTugasMKController::class, 'storeSurat2'])->name('detailsurat.storeSurat2');

Route::post('/surat/store/template_ket_lulus', [KeteranganLulusController::class, 'storeSurat3'])->name('detailsurat.storeSurat3');

Route::post('/surat/store/template_laporan_studi', [LaporanStudiController::class, 'storeSurat4'])->name('detailsurat.storeSurat4');


// Route::get('/student/status', function () {
//     return view('/student/status');
// })->middleware(student::class);

// Routes for staff
Route::get('/staff/print_surat', function () {
    return view('/staff/index');
})->middleware(staff::class);

Route::get('/staff/print_surat', function () {
    return view('/staff/print_surat');
});

// Route for kaprodi
Route::get('/kaprodi/daftarsurat', [KaprodiController::class, 'index'])->middleware(kaprodi::class);

Route::post('/kaprodi/update-status', [KaprodiController::class, 'updateStatus'])->name('kaprodi.updateStatus');

// Route::prefix('staff')->middleware([staff::class])->group(function () {
//     Route::get('/', [PrintController::class, 'index'])->name('staff.print_surat');
// });

// Route::prefix('student')->middleware(student::class)->group(function () {
//     Route::get('/', [PengajuanController::class, 'index'])->name('student.index');
//     Route::get('/status', [StatusController::class, 'index'])->name('student.status');
// });

// Route::prefix('admin')->middleware([admin::class])->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
// });