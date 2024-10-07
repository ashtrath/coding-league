<?php

use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SektorController;
use App\Http\Controllers\TagController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Public routes


Route::middleware(['auth', 'verified'])->group(function () {

    // sektor 
    Route::get('sektor', [SektorController::class, 'index'])->name('sektor.index');
    Route::get('sektor/{sektor}', [SektorController::class, 'show'])->name('sektor.show');

    // kegiatan
    Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:Admin')->group(function() {
        Route::get('sektor/{sektor}', [SektorController::class, 'show'])->name('sektor.show');
        Route::get('sektor/create', [SektorController::class, 'create'])->name('sektor.create');
        Route::post('sektor', [SektorController::class, 'store'])->name('sektor.store');  
        Route::put('sektor/{sektor}', [SektorController::class, 'update'])->name('sektor.update');
        Route::get('sektor/{sektor}/edit', [SektorController::class, 'edit'])->name('sektor.edit');
        Route::delete('sektor/{sektor}', [SektorController::class, 'destroy'])->name('sektor.destroy');
        
        Route::get('kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');
        Route::get('kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('kegiatan/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('kegiatan/{kegiatan}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
    });
  
    // Mitra routes
    Route::middleware('role:Mitra')->group(function () {
        Route::get('/mitra', [MitraController::class, 'index'])->name('mitra.index');
        Route::get('/mitra/create', [MitraController::class, 'create'])->name('mitra.create');
        Route::post('/mitra', [MitraController::class, 'store'])->name('mitra.store');
        Route::get('/mitra/{mitra}', [MitraController::class, 'show'])->name('mitra.show');
        Route::get('/mitra/{mitra}/edit', [MitraController::class, 'edit'])->name('mitra.edit');
        Route::put('/mitra/{mitra}', [MitraController::class, 'update'])->name('mitra.update');
        Route::delete('/mitra/{mitra}', [MitraController::class, 'destroy'])->name('mitra.destroy');
    });
  
    // Mitra And Admin
    Route::middleware(['role:Admin|Mitra'])->group(function() {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
        Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
        Route::get('/laporan/{laporan}', [LaporanController::class, 'show'])->name('laporan.show');
        Route::get('/laporan/{laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
        Route::put('/laporan/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');
        Route::delete('/laporan/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    });
});


require __DIR__ . '/auth.php';
