<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardKegiatanController;
use App\Http\Controllers\Dashboard\DashboardLaporanController;
use App\Http\Controllers\Dashboard\DashboardMitraController;
use App\Http\Controllers\Dashboard\DashboardProfileController;
use App\Http\Controllers\Dashboard\DashboardProjectController;
use App\Http\Controllers\Dashboard\DashboardSektorController;
use App\Http\Controllers\DashboardNotificationController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MitraController;
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
Route::controller(DashboardProfileController::class)->prefix('profile')->name('profile.')->middleware(['auth', 'verified', 'role:Admin,Mitra', 'breadcrumbs'])->group(function () {
    Route::get('/{user}', 'index')->name('index');
    Route::get('/{user}/edit', 'edit')->name('edit');
    Route::patch('/{user}', 'update')->name('update');
    Route::delete('/', 'destroy')->name('destroy');
});

// === Dashboard Routes ===
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'verified', 'role:Admin,Mitra'])->group(function () {

    // === Main Dashboard Route ===
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/export-all', 'exportAllData')->name('export.all');
        Route::get('/export-admin', 'exportAdminData')->name('export.admin');
    });

    // === Dashboard Mitra Routes
    Route::controller(DashboardMitraController::class)->middleware('role:Admin')->prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware(['breadcrumbs']);
        Route::get('/create', 'create')->name('create')->middleware(['breadcrumbs']);
        Route::post('/', 'store')->name('store');
        Route::get('/{mitra}', 'show')->name('show')->middleware(['breadcrumbs']);
        Route::get('/{mitra}/edit', 'edit')->name('edit')->middleware(['breadcrumbs']);
        Route::put('/{mitra}', 'update')->name('update');
        Route::delete('/{mitra}', 'destroy')->name('destroy');
    });

    // === Dashboard Laporan Routes
    Route::controller(DashboardLaporanController::class)->middleware('role:Admin,Mitra')->prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware(['breadcrumbs']);
        Route::get('/create', 'create')->name('create')->middleware(['breadcrumbs']);
        Route::post('/', 'store')->name('store');
        Route::get('/{laporan}', 'show')->name('show')->middleware(['breadcrumbs']);
        Route::get('/{laporan}/edit', 'edit')->name('edit')->middleware(['breadcrumbs']);
        Route::put('/{laporan}', 'update')->name('update');
        Route::delete('/{laporan}', 'destroy')->name('destroy');
        Route::post('/{laporan}/status', 'updateStatus')->name('laporan.updateStatus')->middleware(['role:Admin']);
        Route::get('/export-csv', 'exportCSV')->name('export.csv');
    });

    // === Dashboard Kegiatan Routes ===
    Route::controller(DashboardKegiatanController::class)->middleware('role:Admin')->prefix('kegiatan')->name('kegiatan.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware(['breadcrumbs']);
        Route::get('/create', 'create')->name('create')->middleware(['breadcrumbs']);
        Route::post('/', 'store')->name('store');
        Route::get('/{kegiatan}', 'show')->name('show')->middleware(['breadcrumbs']);
        Route::get('/{kegiatan}/edit', 'edit')->name('edit')->middleware(['breadcrumbs']);
        Route::put('/{kegiatan}', 'update')->name('update');
        Route::delete('/{kegiatan}', 'destroy')->name('destroy');
    });

    // === Dashboard Project Routes === 
    Route::controller(DashboardProjectController::class)->middleware('role:Admin')->prefix('proyek')->name('proyek.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware(['breadcrumbs']);
        Route::get('/create', 'create')->name('create')->middleware(['breadcrumbs']);
        Route::post('/', 'store')->name('store');
        Route::get('/{project}', 'show')->name('show')->middleware(['breadcrumbs']);
        Route::get('/{project}/edit', 'edit')->name('edit')->middleware(['breadcrumbs']);
        Route::put('/{project}', 'update')->name('update');
        Route::delete('/{project}', 'destroy')->name('destroy');
        Route::post('/{project}/status', 'updateProjectStatus')->name('updateStatus');
        Route::get('/export-csv', 'exportCSV')->name('export.csv');
    });

    // === Dashboard Sektor Routes ===
    Route::controller(DashboardSektorController::class)->middleware('role:Admin')->prefix('sektor')->name('sektor.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware(['breadcrumbs']);
        Route::get('/create', 'create')->name('create')->middleware(['breadcrumbs']);
        Route::post('/', 'store')->name('store');
        Route::get('/{sektor}', 'show')->name('show')->middleware(['breadcrumbs']);
        Route::get('/{sektor}/edit', 'edit')->name('edit')->middleware(['breadcrumbs']);
        Route::put('/{sektor}', 'update')->name('update');
        Route::delete('/{sektor}', 'destroy')->name('destroy');
    });

    // === Dashboard Notification Routes ===
    Route::controller(DashboardNotificationController::class)->middleware('role:Admin,Mitra')->prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/read', 'markAsRead')->name('read');
    });

    // === Dashboard Email Routes ===
    Route::get('/email/verify', function () {
        return Inertia::render('Auth/VerifyEmail');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard.index');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi telah dikirim!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

require __DIR__ . '/auth.php';
