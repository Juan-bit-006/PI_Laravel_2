<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::get('clientes-pdf', [ClienteController::class, 'exportPdf'])->name('clientes.pdf');
    Route::resource('servicios', ServicioController::class);

    // si usas PDF
    Route::get('servicios-pdf', [\App\Http\Controllers\ServicioController::class, 'pdf'])->name('servicios.pdf');
});

// CRUD Clientes
Route::resource('clientes', ClienteController::class)->middleware('auth');

// CRUD Servicios
Route::resource('servicios', ServicioController::class)->middleware('auth');

// CRUD Reservas
Route::resource('reservas', ReservaController::class)->middleware('auth');

// Exportar clientes a PDF
Route::get('/clientes/pdf', [ClienteController::class, 'exportPdf'])->name('clientes.pdf')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
