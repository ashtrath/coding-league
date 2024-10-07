<?php

use App\Http\Controllers\KegiatanController;
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

Route::middleware('auth')->group(function () {
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

    // sektor 
    Route::get('sektor', [SektorController::class, 'index'])->name('sektor.index');
    Route::get('sektor/{sektor}', [SektorController::class, 'show'])->name('sektor.show');

    // kegiatan
    Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');

});

require __DIR__.'/auth.php';