<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Foundation\Application;

// Ruta principal
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard') // si está logueado, al dashboard
        : redirect()->route('login');    // si no, al login
});

// Dashboard protegido
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Productos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

// Rutas de autenticación (login, register, forgot-password, etc.)
require __DIR__.'/auth.php';
