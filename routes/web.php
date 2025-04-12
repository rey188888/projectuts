<?php

use App\Http\Controllers\Surat\KeteranganLulusController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Surat\LaporanStudiController;
use App\Http\Controllers\Surat\MhsAktifController;
use App\Http\Controllers\Surat\PengantarTugasMKController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardKaprodiController;
use App\Http\Middleware\admin;
use App\Http\Middleware\student;
use App\Http\Middleware\staff;
use App\Http\Middleware\kaprodi;
use Illuminate\Support\Facades\Route;

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

// Routes for Student

Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard')->middleware(student::class);
Route::get('/student/pengajuan', [StudentController::class, 'pengajuan'])->name('student.pengajuan')->middleware(student::class);
Route::get('/student/status', [StudentController::class, 'status'])->name('student.status')->middleware(student::class);



Route::prefix('student')->name('student.')->middleware(student::class)->group(function () {
    
    Route::get('/status', [StatusController::class, 'index'])->name('status');

    Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
        Route::get('/', [PengajuanController::class, 'index'])->name('index');
        

        Route::get('/template_mhs_aktif', function () {
            return view('student.template_mhs_aktif');
        })->middleware(student::class);

        Route::get('/template_pengantar_tugasmk', function () {
            return view('student.template_pengantar_tugasmk');
        })->middleware(student::class);

        Route::get('/template_ket_lulus', function () {
            return view('student.template_ket_lulus');
        })->middleware(student::class);

        Route::get('/template_laporan_studi', function () {
            return view('student.template_laporan_studi');
        })->middleware(student::class);
        
    });
});

Route::post('/surat/store/template_mhs_aktif', [MhsAktifController::class, 'storeSurat1'])->name('detailsurat.storeSurat1');
Route::post('/surat/store/template_pengantar_tugasmk', [PengantarTugasMKController::class, 'storeSurat2'])->name('detailsurat.storeSurat2');
Route::post('/surat/store/template_ket_lulus', [KeteranganLulusController::class, 'storeSurat3'])->name('detailsurat.storeSurat3');
Route::post('/surat/store/template_laporan_studi', [LaporanStudiController::class, 'storeSurat4'])->name('detailsurat.storeSurat4');

// Routes for Kaprodi
// Route::get('/kaprodi/daftarsurat', [KaprodiController::class, 'index'])->middleware(kaprodi::class);
Route::get('/kaprodi/index', [KaprodiController::class, 'index'])->name('kaprodi.index')->middleware(kaprodi::class);
Route::get('/kaprodi/daftarsurat', [KaprodiController::class, 'index'])->name('kaprodi.index')->middleware(kaprodi::class);
Route::post('/kaprodi/update-status', [KaprodiController::class, 'updateStatus'])->name('kaprodi.updateStatus');
Route::get('/kaprodi/dashboard', [DashboardKaprodiController::class, 'dashboard'])->name('kaprodi.dashboard')->middleware(kaprodi::class);
Route::get('/kaprodi/surat/{id}', [KaprodiController::class, 'show'])->name('kaprodi.detailSurat');



// Routes for Staff
Route::get('/staff/print_surat', function () {
    return view('/staff/print_surat');
})->middleware(staff::class);

Route::get('/staff/print_surat', [PrintController::class, 'index'])->name('staff.print_surat')->middleware(staff::class);
Route::get('/staff/print', [PrintController::class, 'index'])->name('staff.print')->middleware(staff::class);
Route::post('/staff/upload', [PrintController::class, 'uploadFile'])->name('staff.uploadFile')->middleware(staff::class);
Route::delete('/staff/delete-file', [PrintController::class, 'deleteFile'])->name('staff.deleteFile')->middleware(staff::class);

//Route::get('/staff/print_surat', function () {
//    return view('/staff/print_surat');
//});

// Routes for Admin
Route::get('/admin/dashboard', function () {
    return view('/admin/index');
})->middleware(admin::class);

// Rute untuk menampilkan form
Route::get('/admin/add-student', [AdminController::class, 'addStudentForm'])->name('admin.add-student')->middleware(admin::class);
Route::get('/admin/add-kaprodi', [AdminController::class, 'addKaprodiForm'])->name('admin.add-kaprodi')->middleware(admin::class);
Route::get('/admin/add-staff', [AdminController::class, 'addStaffForm'])->name('admin.add-staff')->middleware(admin::class);

// Rute untuk menyimpan data
Route::post('/admin/store-student', [AdminController::class, 'storeStudent'])->name('admin.store-student');
Route::post('/admin/store-kaprodi', [AdminController::class, 'storeKaprodi'])->name('admin.store-kaprodi');
Route::post('/admin/store-staff', [AdminController::class, 'storeStaff'])->name('admin.store-staff');

// Rute untuk halaman utama admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');

// Commented Routes (kept as-is for reference)
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