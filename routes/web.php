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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Request;
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
    Route::get('/export-admin', 'exportAdminData')->name('export.admin');
});

Route::get('/email/verify', function () {
    return Inertia::render('Pages/VerifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


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

// === Mitra Routes Public ===
Route::controller(MitraController::class)->prefix('mitra')->name('mitra.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{mitra}', 'show')->name('show');
});

// === Sektor Routes Public ===
Route::controller(SektorController::class)->prefix('sektor')->name('sektor.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{sektor}', 'show')->name('show');
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

// === Projects Routes Public ===
Route::controller(ProjectController::class)->prefix('project')->name('project.')->middleware('guest')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{project}', 'show')->name('show');
});

// === Profile Routes === 
Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->middleware(['auth', 'verified', 'role:Admin,Mitra'])->group(function () {
    Route::get('/', 'edit')->name('edit');
    Route::patch('/', 'update')->name('update');
    Route::delete('/', 'delete')->name('delete');
});


// === Dashboard Routes ===
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'verified', 'role:Admin,Mitra'])->group(function () {

    // === Main Dashboard Route ===
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/export-all', 'exportAllData')->name('export.all');
    });

    // === Dashboard Mitra Routes
    Route::controller(DashboardMitraController::class)->middleware('role:Admin')->prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{mitra}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{mitra}/edit', 'edit')->name('edit');
        Route::put('/{mitra}', 'update')->name('update');
        Route::delete('/{mitra}', 'delete')->name('delete');
    });

    // === Dashboard Laporan Routes
    Route::controller(DashboardLaporanController::class)->middleware('role:Admin,Mitra')->prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{laporan}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{laporan}/edit', 'edit')->name('edit');
        Route::put('/{laporan}', 'update')->name('update');
        Route::delete('/{laporan}', 'delete')->name('delete');
        Route::post('/{laporan}/status', 'updateStatus')->name('laporan.updateStatus')->middleware(['role:Admin']);
        Route::get('/export-csv', 'exportCSV')->name('export.csv');
    });

    // === Dashboard Kegiatan Routes ===
    Route::controller(DashboardKegiatanController::class)->middleware('role:Admin')->prefix('kegiatan')->name('kegiatan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{kegiatan}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{kegiatan}/edit', 'edit')->name('edit');
        Route::put('/{kegiatan}', 'update')->name('update');
        Route::delete('/{kegiatan}', 'delete')->name('delete');
    });

    // === Dashboard Project Routes === 
    Route::controller(DashboardProjectController::class)->middleware('role:Admin')->prefix('proyek')->name('proyek.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{project}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{project}/edit', 'edit')->name('edit');
        Route::put('/{project}', 'update')->name('update');
        Route::delete('/{project}', 'delete')->name('delete');
        Route::post('/{project}/status', [DashboardProjectController::class, 'updateProjectStatus'])->name('kegiatan.updateStatus')->middleware(['role:Admin']);
        Route::get('/export-csv', 'exportCSV')->name('export.csv');
    });

    // === Dashboard Sektor Routes ===
    Route::controller(DashboardSektorController::class)->middleware('role:Admin')->prefix('sektor')->name('sektor.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{sektor}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{sektor}/edit', 'edit')->name('edit');
        Route::put('/{sektor}', 'update')->name('update');
        Route::delete('/{sektor}', 'delete')->name('delete');
    });
});

require __DIR__ . '/auth.php';
