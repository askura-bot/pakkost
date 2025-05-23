<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return view('content.user.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/dashboard-pemilik', [PemilikController::class, 'index'])->name('dashboard.pemilik');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/property/create', [PropertyController::class, 'create'])->name('property.create');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
    Route::get('/propertys', [PemilikController::class, 'show'])->name('property.show');
    Route::get('/pemilik/property/{id}/edit', [PropertyController::class, 'edit'])->name('pemilik.property.edit');
    Route::put('/pemilik/property/{id}', [PropertyController::class, 'update'])->name('pemilik.property.update');
    Route::delete('/pemilik/property/{id}', [PropertyController::class, 'destroy'])->name('pemilik.property.destroy');
});

require __DIR__.'/auth.php';
