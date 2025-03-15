<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\admin;
use App\Http\Middleware\student;
use App\Http\Middleware\staff;
use App\Http\Middleware\kaprodi;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('/auth/login');
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

Route::get('/staff', function () {
    return view('/staff/index');
})->middleware(staff::class);

Route::get('/kaprodi', function () {
    return view('/kaprodi/index');
})->middleware(kaprodi::class);