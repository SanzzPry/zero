<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreezeController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TipsKerjaController;
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
        Route::get('/create', [PerusahaanController::class, 'create'])->name('perusahaan.create');
    });

    Route::prefix('finance')->group(function () {
        Route::get('/', [FinanceController::class, 'index'])->name('finance.index');
    });

    Route::prefix('tips')->group(function () {
        Route::get('/', [TipsKerjaController::class, 'index'])->name('tips.index');
        Route::get('/create', [TipsKerjaController::class, 'create'])->name('tips.create');
        Route::post('/store', [TipsKerjaController::class, 'store'])->name('tips.store');
        Route::get('/show/{id}', [TipsKerjaController::class, 'show'])->name('tips.show');
        Route::post('tips/delete-multiple', [TipsKerjaController::class, 'deleteMultiple'])->name('tips.deleteMultiple');
    });

    Route::prefix('event')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('event.index');
        Route::patch('/{event}/toggle-status', [EventController::class, 'toggleStatus'])->name('event.toggleStatus');
        Route::get('/create', [EventController::class, 'create'])->name('event.create');
        Route::post('/store', [EventController::class, 'store'])->name('event.store');
        Route::get('/{id}', [EventController::class, 'show'])->name('event.show');
        Route::get('/{id}/partisipan', [EventController::class, 'partisipan'])->name('event.partisipan');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
        Route::put('/update/{event}', [EventController::class, 'update'])->name('event.update');
        Route::delete('/destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy');
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

    Route::resource('social', SocialLinkController::class);
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
