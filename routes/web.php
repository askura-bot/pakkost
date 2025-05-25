<?php

use App\Models\Property;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('dashboard.admin'); //hanya admin yang boleh mengakses
//     Route::get('/dashboard-pemilik', [PemilikController::class, 'index'])->name('dashboard.pemilik'); //hanya pemilik yang boleh mengakses
// });



Route::middleware(['auth', RoleMiddleware::class . ':pemilik'])->group(function () {
    Route::get('/dashboard-pemilik', [PemilikController::class, 'index'])->name('dashboard.pemilik'); //Menampilkan halaman dashboard pemilik
    Route::get('/property/creates', [PropertyController::class, 'create'])->name('property.create'); //Menampilkan halaman form tambah property
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store'); //Mengirim data form tambah property
    Route::get('/propertys', [PemilikController::class, 'show'])->name('property.show'); //Menampilkan property owner
    Route::get('/pemilik/property/{id}/edit', [PropertyController::class, 'edit'])->name('pemilik.property.edit'); //Menampilkan halaman form edit property
    Route::put('/pemilik/property/{id}', [PropertyController::class, 'update'])->name('pemilik.property.update'); //Mengirim data form edit property
    Route::delete('/pemilik/property/{id}', [PropertyController::class, 'destroy'])->name('pemilik.property.destroy'); //Menghapus data property

});

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('dashboard.admin'); //Menampilkan halaman dashboard admin
    Route::get('/properties', [PropertyController::class, 'show'])->name('properties.show'); //Menampilkan seluruh data property
    Route::get('/property/{property}', [AdminController::class, 'show'])->name('detail.show'); //Menampilkan halaman detail property
    Route::get('/owners', [AdminController::class, 'owner'])->name('owner.show'); //Menampilkan seluruh akun owner
    Route::get('/pemilik/{user}', [AdminController::class, 'detail'])->name('pemilik.show')->where('user', '[0-9]+'); // Hanya menerima parameter numerik (ID user)
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin.show'); //Menampilkan seluruh akun admin
    Route::get('/create-user', [AdminController::class, 'create'])->name('create.user'); //Menampilkan halaman form tambah akun
    Route::post('/store-user', [AdminController::class, 'store'])->name('store.user'); //Mengirim data form tambah akun
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); //setiap user yang login boleh mengakses
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); //setiap user yang login boleh mengakses
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); //setiap user yang login boleh mengakses
    // Route::get('/property/create', [PropertyController::class, 'create'])->name('property.create'); //hanya pemilik yang boleh mengakses
    // Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store'); //hanya pemilik yang boleh mengakses
    // Route::get('/properties', [PropertyController::class, 'show'])->name('properties.show'); //hanya admin yang boleh mengakses
    // Route::get('/propertys', [PemilikController::class, 'show'])->name('property.show'); //hanya pemilik yang boleh mengakses
    // Route::get('/pemilik/property/{id}/edit', [PropertyController::class, 'edit'])->name('pemilik.property.edit'); //hanya pemilik yang boleh mengakses
    // Route::put('/pemilik/property/{id}', [PropertyController::class, 'update'])->name('pemilik.property.update'); //hanya pemilik yang boleh mengakses
    // Route::delete('/pemilik/property/{id}', [PropertyController::class, 'destroy'])->name('pemilik.property.destroy'); //hanya pemilik yang boleh mengakses
    // Route::get('/property/{property}', [AdminController::class, 'show'])->name('detail.show'); //hanya admin yang boleh mengakses
    
});

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/{property}', [UserController::class, 'show'])->name('detail'); //Menampilkan halaman detail property
Route::post('/{property}/ulasan', [UserController::class, 'storeUlasan'])->name('ulasan.store');



require __DIR__.'/auth.php';
