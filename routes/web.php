<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\RumdinController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\BarakController;
use App\Http\Controllers\MusholaController;
use App\Http\Controllers\GarasiController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ========== AUTH ROUTES ==========
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ========== PROTECTED ROUTES (HARUS LOGIN) ==========
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    // ========== TANAH ROUTES ==========
    Route::prefix('tanah')->name('tanah.')->group(function () {
        // Routes spesifik dulu
        Route::get('/polres', [TanahController::class, 'polres'])->name('polres');
        Route::get('/polsek', [TanahController::class, 'polsek'])->name('polsek');
        Route::get('/polres/create', [TanahController::class, 'createPolres'])->name('polres.create');
        Route::get('/polsek/create', [TanahController::class, 'createPolsek'])->name('polsek.create');
        
        // ROUTE LAPORAN PDF
        Route::get('/laporan-pdf', [TanahController::class, 'laporanPdf'])->name('laporan-pdf');
        
        // ROUTE GET BANGUNAN BY TANAH ID (AJAX ENDPOINT)
        Route::get('/{id}/bangunan', [TanahController::class, 'getBangunan'])->name('getBangunan');
        
        // CRUD Operations
        Route::post('/', [TanahController::class, 'store'])->name('store');
        Route::put('/{tanah}', [TanahController::class, 'update'])->name('update');
        Route::delete('/{tanah}', [TanahController::class, 'destroy'])->name('destroy');
        
        // Routes dengan parameter di paling bawah
        Route::get('/{tanah}/edit', [TanahController::class, 'edit'])->name('edit');
        Route::get('/{tanah}', [TanahController::class, 'show'])->name('show');
    });
    
    // ========== KANTOR ROUTES (BANGUNAN) ==========
    Route::prefix('kantor')->name('kantor.')->group(function () {
        
        Route::post('/store', [KantorController::class, 'store'])->name('store');
        
        // POLRES - Kantor
        Route::get('/polres', [KantorController::class, 'kantorPolres'])->name('polres');
        Route::get('/polres/create', [KantorController::class, 'createKantorPolres'])->name('polres.create');
        Route::get('/laporan-pdf', [KantorController::class, 'laporanPdf'])->name('laporan-pdf');
        // POLSEK - Kantor
        Route::get('/polsek', [KantorController::class, 'kantorPolsek'])->name('polsek');
        Route::get('/polsek/create', [KantorController::class, 'createKantorPolsek'])->name('polsek.create');
        
        // UPDATE & DELETE
        Route::put('/{kantor}', [KantorController::class, 'update'])->name('update');
        Route::delete('/{kantor}', [KantorController::class, 'destroy'])->name('destroy');
        
        // GET routes dengan parameter - TARUH DI PALING BAWAH
        Route::get('/{kantor}/edit', [KantorController::class, 'edit'])->name('edit');
        Route::get('/{kantor}', [KantorController::class, 'show'])->name('show');
    });
    
    // ========== BARAK ROUTES ==========
    Route::prefix('barak')->name('barak.')->group(function () {
        // CRUD Operations dulu
        Route::post('/', [BarakController::class, 'store'])->name('store');
        Route::put('/{barak}', [BarakController::class, 'update'])->name('update');
        Route::delete('/{barak}', [BarakController::class, 'destroy'])->name('destroy');
        
        Route::get('/laporan-pdf', [BarakController::class, 'laporanPdf'])->name('laporan-pdf');
        // Routes lainnya
        Route::get('/', [BarakController::class, 'index'])->name('index');
        Route::get('/create', [BarakController::class, 'create'])->name('create');
        Route::get('/{barak}/edit', [BarakController::class, 'edit'])->name('edit');
        Route::get('/{barak}', [BarakController::class, 'show'])->name('show');
    });
    
    // ========== MUSHOLA ROUTES ==========
    Route::prefix('mushola')->name('mushola.')->group(function () {
        // CRUD Operations dulu
        Route::post('/', [MusholaController::class, 'store'])->name('store');
        Route::put('/{mushola}', [MusholaController::class, 'update'])->name('update');
        Route::delete('/{mushola}', [MusholaController::class, 'destroy'])->name('destroy');
        
        Route::get('/laporan-pdf', [MusholaController::class, 'laporanPdf'])->name('laporan-pdf');
        // Routes lainnya
        Route::get('/', [MusholaController::class, 'index'])->name('index');
        Route::get('/create', [MusholaController::class, 'create'])->name('create');
        Route::get('/{mushola}/edit', [MusholaController::class, 'edit'])->name('edit');
        Route::get('/{mushola}', [MusholaController::class, 'show'])->name('show');
    });
    
    // ========== GARASI ROUTES ==========
    Route::prefix('garasi')->name('garasi.')->group(function () {
        // CRUD Operations dulu
        Route::post('/', [GarasiController::class, 'store'])->name('store');
        Route::put('/{garasi}', [GarasiController::class, 'update'])->name('update');
        Route::delete('/{garasi}', [GarasiController::class, 'destroy'])->name('destroy');
        
        Route::get('/laporan-pdf', [GarasiController::class, 'laporanPdf'])->name('laporan-pdf');
        // Routes lainnya
        Route::get('/', [GarasiController::class, 'index'])->name('index');
        Route::get('/create', [GarasiController::class, 'create'])->name('create');
        Route::get('/{garasi}/edit', [GarasiController::class, 'edit'])->name('edit');
        Route::get('/{garasi}', [GarasiController::class, 'show'])->name('show');
    });
    
    // ========== RUMDIN ROUTES ==========
    Route::prefix('rumdin')->name('rumdin.')->group(function () {
        
        // CRUD Operations dulu
        Route::post('/', [RumdinController::class, 'store'])->name('store');
        Route::put('/{rumdin}', [RumdinController::class, 'update'])->name('update');
        Route::delete('/{rumdin}', [RumdinController::class, 'destroy'])->name('destroy');
        
        Route::get('/laporan-pdf', [RumdinController::class, 'laporanPdf'])->name('laporan-pdf');

        // Polres - Rusus
        Route::get('/rusus', [RumdinController::class, 'rusus'])->name('rusus');
        Route::get('/rusus/create', [RumdinController::class, 'createRusus'])->name('rusus.create');
        
        // Polres - Satpolairud
        Route::get('/satpolairud', [RumdinController::class, 'satpolairud'])->name('satpolairud');
        Route::get('/satpolairud/create', [RumdinController::class, 'createSatpolairud'])->name('satpolairud.create');
        
        // Polsek - Pangandaran
        Route::get('/polsek/pangandaran', [RumdinController::class, 'pangandaran'])->name('polsek.pangandaran');
        Route::get('/polsek/pangandaran/create', [RumdinController::class, 'createPangandaran'])->name('polsek.pangandaran.create');
        
        // Polsek - Kalipucang
        Route::get('/polsek/kalipucang', [RumdinController::class, 'kalipucang'])->name('polsek.kalipucang');
        Route::get('/polsek/kalipucang/create', [RumdinController::class, 'createKalipucang'])->name('polsek.kalipucang.create');
        
        // Polsek - Sidamulih
        Route::get('/polsek/sidamulih', [RumdinController::class, 'sidamulih'])->name('polsek.sidamulih');
        Route::get('/polsek/sidamulih/create', [RumdinController::class, 'createSidamulih'])->name('polsek.sidamulih.create');
        
        // Routes dengan parameter di paling bawah
        Route::get('/{rumdin}/edit', [RumdinController::class, 'edit'])->name('edit');
        Route::get('/{rumdin}', [RumdinController::class, 'show'])->name('show');
    });
});