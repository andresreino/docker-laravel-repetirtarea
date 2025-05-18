<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CitasClienteController;
use App\Http\Controllers\CitasTallerController;
use App\Http\Middleware\TallerMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ClienteMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/users', UserController::class)->middleware(TallerMiddleware::class);
    Route::resource('/citas', CitasTallerController::class)->middleware(TallerMiddleware::class);
    Route::get('/pendientes', [CitasTallerController::class, 'pendientes'])->middleware(TallerMiddleware::class)->name('citas.pendientes');
    Route::resource('/citasclientes', CitasClienteController::class)->only('index', 'create', 'store');
    Route::get('/citasclientes/{cita}', [CitasClienteController::class, 'show'])->middleware(ClienteMiddleware::class)->name('citasclientes.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
