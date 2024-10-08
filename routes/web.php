<?php

use App\Http\Controllers\DashboardController;
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

Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:Admin,Mitra'])->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/export-all', 'exportAllData')->name('export.all');
});


// === Sektor Routes Public ===
Route::controller(SektorController::class)->prefix('sektor')->name('sektor.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{sektor}', 'show')->name('show');
});

// === Kegiatan Routes Public ===
Route::controller(KegiatanController::class)->prefix('kegiatan')->name('mitra.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{kegiatan}', 'show')->name('show');
});

// === Projects Routes Public ===
Route::controller(ProjectController::class)->prefix('project')->name('project.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{project}', 'show')->name('show');
});

// === Profile Routes === 
Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->middleware('auth', 'verified')->group(function () {
    Route::get('/', 'edit')->name('edit');
    Route::patch('/', 'update')->name('update');
    Route::delete('/', 'delete')->name('delete');
});

// === Mitra Routes ===
Route::controller(MitraController::class)->prefix('mitra')->name('mitra.')->middleware(['auth', 'verified', 'role:Mitra'])->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{mitra}', 'show')->name('show');
    Route::get('/{mitra}/edit', 'edit')->name('edit');
    Route::put('/{mitra}', 'update')->name('update');
    Route::delete('/{mitra}', 'delete')->name('delete');
});

// === Sektor Routes ===
Route::controller(SektorController::class)->prefix('sektor')->name('sektor.')->middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{sektor}', 'show')->name('show');
    Route::get('/{sektor}/edit', 'edit')->name('edit');
    Route::put('/{sektor}', 'update')->name('update');
    Route::delete('/{sektor}', 'delete')->name('delete');
});

// === Kegiatan Routes ===
Route::controller(KegiatanController::class)->prefix('kegiatan')->name('kegiatan.')->middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{kegiatan}/edit', 'edit')->name('edit');
    Route::put('/{kegiatan}', 'update')->name('update');
    Route::delete('/{kegiatan}', 'delete')->name('delete');
});

// === Laporan Routes ===
Route::controller(LaporanController::class)->prefix('laporan')->name('laporan.')->middleware('auth', 'verified', 'role:Admin,Mitra')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{laporan}', 'show')->name('show');
    Route::get('/{laporan}/edit', 'edit')->name('edit');
    Route::put('/{laporan}', 'update')->name('update');
    Route::delete('/{laporan}', 'delete')->name('delete');
    Route::get('/export-csv', 'exportCSV')->name('export.csv');
});

// === Projects Routes ===
Route::controller(ProjectController::class)->prefix('project')->name('project.')->middleware('auth', 'verified', 'role:Admin')->group(function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{project}/edit', 'edit')->name('edit');
    Route::put('/{project}', 'update')->name('update');
    Route::delete('/{project}', 'delete')->name('delete');
    Route::get('/export-csv', 'exportCSV')->name('export.csv');

});

require __DIR__ . '/auth.php';