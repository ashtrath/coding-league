<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardKegiatanController;
use App\Http\Controllers\Dashboard\DashboardLaporanController;
use App\Http\Controllers\Dashboard\DashboardMitraController;
use App\Http\Controllers\Dashboard\DashboardProjectController;
use App\Http\Controllers\Dashboard\DashboardSektorController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SektorController;
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

// === Sektor Routes Public ===
Route::controller(SektorController::class)->prefix('sektor')->name('sektor.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{sektor}', 'show')->name('show');
});

// === Projects Routes Public ===
Route::controller(ProjectController::class)->prefix('project')->name('project.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{project}', 'show')->name('show');
});

// === Mitra Routes Public ===
Route::controller(MitraController::class)->prefix('mitra')->name('mitra.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{mitra}', 'show')->name('show');
});

// === Kegiatan Routes Public ===
Route::controller(KegiatanController::class)->prefix('kegiatan')->name('kegiatan.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{kegiatan}', 'show')->name('show');
});

// === Laporan Routes Public ===
Route::controller(LaporanController::class)->prefix('laporan')->name('laporan.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{laporan}', 'show')->name('show');
});

// === Profile Routes === 
Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->middleware(['auth', 'verified', 'role:Admin,Mitra'])->group(function () {
    Route::get('/', 'edit')->name('edit');
    Route::patch('/', 'update')->name('update');
    Route::delete('/', 'destroy')->name('destroy');
});

// === Dashboard Routes ===
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'verified', 'role:Admin,Mitra', 'breadcrumbs'])->group(function () {

    // === Main Dashboard Route ===
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/export-all', 'exportAllData')->name('export.all');
        Route::get('/export-admin', 'exportAdminData')->name('export.admin');
    });

    // === Dashboard Mitra Routes
    Route::controller(DashboardMitraController::class)->middleware('role:Admin')->prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{mitra}', 'show')->name('show');
        Route::get('/{mitra}/edit', 'edit')->name('edit');
        Route::put('/{mitra}', 'update')->name('update');
        Route::delete('/{mitra}', 'destroy')->name('destroy');
    });

    // === Dashboard Laporan Routes
    Route::controller(DashboardLaporanController::class)->middleware('role:Admin,Mitra')->prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{laporan}', 'show')->name('show');
        Route::get('/{laporan}/edit', 'edit')->name('edit');
        Route::put('/{laporan}', 'update')->name('update');
        Route::delete('/{laporan}', 'destroy')->name('destroy');
        Route::post('/{laporan}/status', 'updateStatus')->name('laporan.updateStatus')->middleware(['role:Admin']);
        Route::get('/export-csv', 'exportCSV')->name('export.csv');
    });

    // === Dashboard Kegiatan Routes ===
    Route::controller(DashboardKegiatanController::class)->middleware('role:Admin')->prefix('kegiatan')->name('kegiatan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{kegiatan}', 'show')->name('show');
        Route::get('/{kegiatan}/edit', 'edit')->name('edit');
        Route::put('/{kegiatan}', 'update')->name('update');
        Route::delete('/{kegiatan}', 'destroy')->name('destroy');
    });

    // === Dashboard Project Routes === 
    Route::controller(DashboardProjectController::class)->middleware('role:Admin')->prefix('proyek')->name('proyek.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{project}', 'show')->name('show');
        Route::get('/{project}/edit', 'edit')->name('edit');
        Route::put('/{project}', 'update')->name('update');
        Route::delete('/{project}', 'destroy')->name('destroy');
        Route::post('/{project}/status', 'updateProjectStatus')->name('updateStatus');
        Route::get('/export-csv', 'exportCSV')->name('export.csv');
    });

    // === Dashboard Sektor Routes ===
    Route::controller(DashboardSektorController::class)->middleware('role:Admin')->prefix('sektor')->name('sektor.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{sektor}', 'show')->name('show');
        Route::get('/{sektor}/edit', 'edit')->name('edit');
        Route::put('/{sektor}', 'update')->name('update');
        Route::delete('/{sektor}', 'destroy')->name('destroy');
    });
});

require __DIR__ . '/auth.php';
