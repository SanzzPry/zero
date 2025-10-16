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



// SUPERADMIN
Route::group(['middleware' => 'superAdmin'], function () {
    Route::prefix('super-admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('superAdmin.dashboard');

        Route::prefix('profile')->group(function () {
            Route::get('/', [SuperAdminController::class, 'profileView'])->name('profile');
            Route::get('/edit', [SuperAdminController::class, 'profileEdit'])->name('profile.edit');
            Route::put('/edit/update', [SuperAdminController::class, 'profileUpdate'])->name('profile.update');
        });

        Route::prefix('pelamar')->group(function () {
            Route::get('/', [PelamarController::class, 'index'])->name('pelamar.index');
            Route::get('/create', [PelamarController::class, 'create'])->name('pelamar.create');
            Route::post('/store', [PelamarController::class, 'store'])->name('pelamar.store');
            Route::get('/edit/{id}', [PelamarController::class, 'edit'])->name('pelamar.edit');
            Route::put('/update{id}', [PelamarController::class, 'update'])->name('pelamar.update');
            Route::get('/show/{id}', [PelamarController::class, 'show'])->name('pelamar.show');
            Route::get('/editcalon/{id}', [PelamarController::class, 'calon'])->name('kandidatToPelamar.index');
            Route::put('/updatecalon/{id}', [PelamarController::class, 'calonUpdate'])->name('kandidatToPelamar.update');
            Route::delete('/pelamar/{pelamar}', [PelamarController::class, 'destroy'])->name('pelamar.destroy');
            Route::get('/cv', [PelamarController::class, 'indexCV'])->name('cv.index');
            Route::get('/{id}/cv/download', [PelamarController::class, 'download'])->name('cv.download');
            Route::delete('/freeze/{pelamar}', [PelamarController::class, 'destroyFreeze'])->name('freeze.destroy');
            Route::patch('freeze/{id}/toggle', [FreezeController::class, 'toggle'])->name('freeze.toggle');
        });

        Route::prefix('perusahaan')->group(function () {
            Route::get('/', [PerusahaanController::class, 'index'])->name('perusahaan.index');
            Route::get('/create', [PerusahaanController::class, 'create'])->name('perusahaan.create');
            Route::post('/store', [PerusahaanController::class, 'store'])->name('perusahaan.store');
            Route::get('/edit/{id}', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
            Route::put('/update/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
            Route::get('/show/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
            Route::get('/lowongan/create/{perusahaan_id?}', [PerusahaanController::class, 'createLow'])->name('lowongan.create');
            Route::post('/lowongan/store', [PerusahaanController::class, 'storeLow'])->name('lowongan.store');
            Route::get('/lowongan/show/{id}', [PerusahaanController::class, 'showLow'])->name('lowongan.show');
            Route::get('/lowongan/edit/{id}', [PerusahaanController::class, 'editLow'])->name('lowongan.edit');
            Route::put('/lowongan/update/{id}', [PerusahaanController::class, 'updateLow'])->name('lowongan.update');
            Route::delete('/lowongan/destroy/{lowonganPerusahaan}', [PerusahaanController::class, 'destroyLow'])->name('lowongan.destroy');
            Route::delete('/destroy/{perusahaan}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
            Route::get('/showTalent/{id}', [PerusahaanController::class, 'showTalent'])->name('talent.show');
            Route::get('/createTalent/{perusahaan_id?}', [PerusahaanController::class, 'createTalent'])->name('talent.create');
            Route::post('/storeTalent', [PerusahaanController::class, 'storeTalent'])->name('talent.store');
            Route::get('/editTalent/{id}', [PerusahaanController::class, 'editTalent'])->name('talent.edit');
            Route::put('/updateTalent/{id}', [PerusahaanController::class, 'updateTalent'])->name('talent.update');
        });

        Route::prefix('finance')->group(function () {
            Route::get('/', [FinanceController::class, 'index'])->name('finance.index');
            Route::put('/update', [FinanceController::class, 'update'])->name('finance.update');
            Route::get('/transaksii/{bulan}', [FinanceController::class, 'getTransaksiByMonthh']);
            Route::get('/transaksi/export-pdff/{bulan}', [FinanceController::class, 'exportPDFF'])->name('financee.export-pdf');
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
});




// FINANCE
Route::group(['middleware' => 'finance'], function () {
    Route::prefix('finance')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('finance.dashboard');
        Route::get('/paket', [FinanceController::class, 'paketView'])->name('paket.index');
        Route::put('/paket/update', [FinanceController::class, 'paketUpdate'])->name('paket.update');
        Route::get('/catatan', [FinanceController::class, 'catatanView'])->name('catatan.index');
        Route::get('/catatan/bukti/{id}', [FinanceController::class, 'bukti'])->name('catatan.show');
        Route::get('/catatan/buktik/{id}', [FinanceController::class, 'buktik'])->name('catatank.show');
        Route::get('/omset', [FinanceController::class, 'omsetView'])->name('omset.index');
        Route::get('/omset/download', [FinanceController::class, 'downloadOmset'])->name('omset.download');
        Route::get('/laporan', [FinanceController::class, 'laporanView'])->name('laporan.index');
        Route::get('/transaksi/{bulan}', [FinanceController::class, 'getTransaksiByMonth']);
        Route::get('/transaksi/export-pdf/{bulan}', [FinanceController::class, 'exportPDF'])->name('finance.export-pdf');
    });
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
