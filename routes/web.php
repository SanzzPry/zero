<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreezeController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Symfony\Component\CssSelector\Node\FunctionNode;

Route::get('/', function () {
    return view('auth.sign-in');
});

// Route::name('index-practice')->get('/index', function () {
//     return view('practice.index');
// });
// Route::name('index-practicee')->get('/indexx', function () {
//     return view('practice.index');
// });



Route::prefix('super-admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [SuperAdminController::class, 'profileView'])->name('profile');
        Route::get('/edit', [SuperAdminController::class, 'profileEdit'])->name('profile.edit');
        Route::put('/edit/update', [SuperAdminController::class, 'profileUpdate'])->name('profile.update');
    });

    Route::prefix('pelamar')->group(function () {
        Route::get('/', [PelamarController::class, 'index'])->name('pelamar.index');
        Route::get('/create', [PelamarController::class, 'create'])->name('pelamar.create');
    });

    Route::prefix('perusahaan')->group(function () {
        Route::get('/', [PerusahaanController::class, 'index'])->name('perusahaan.index');
    });

    Route::prefix('finance')->group(function () {
        Route::get('/', [FinanceController::class, 'index'])->name('finance.index');
    });

    Route::prefix('freeze')->group(function () {
        Route::get('/', [FreezeController::class, 'index'])->name('freeze.index');
        Route::get('/detail/{id}', [FreezeController::class, 'show'])->name('freeze.show');
    });

    Route::prefix('akun')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('akun.index');
        // Route::get('/profile', [UserController::class, 'profileView'])->name('profile');
        // Route::get('/profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');
        // Route::put('/profile/edit/update', [UserController::class, 'profileUpdate'])->name('profile.update');
        Route::get('/create', [UserController::class, 'create'])->name('akun.create');
        Route::post('/store', [UserController::class, 'store'])->name('akun.store');
        Route::get('/detail/{id}', [UserController::class, 'show'])->name('akun.show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('akun.edit');
        Route::put('/update/{id}', [SuperAdminController::class, 'profileUpdateViaAccount'])->name('akun.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('akun.destroy');
    });

    Route::get('/pengaturan', [UserController::class, 'pengaturanView'])->name('pengaturan.index');
    Route::put('/pengaturan/update', [UserController::class, 'pengaturanUpdate'])->name('pengaturan.update');
});





// api

// Provinsi
Route::get('/provinsi', function () {
    return response()->json(
        Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json')->json()
    );
});

// Kabupaten/Kota by provinsi_id
Route::get('/kabupaten/{provinsi_name}', function ($provinsi_id) {
    return response()->json(
        Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$provinsi_id}.json")->json()
    );
});

// Kecamatan by kabupaten_id
Route::get('/kecamatan/{kabupaten_name}', function ($kabupaten_id) {
    return response()->json(
        Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$kabupaten_id}.json")->json()
    );
});




require __DIR__ . '/auth.php';
