<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpleadoController;


// =============================
// 🔹 RUTA PRINCIPAL → LOGIN
// =============================
Route::get('/', function () {
    return redirect()->route('login');
});


// =============================
// 🔹 RUTAS PÚBLICAS (Breeze)
// =============================
require __DIR__.'/auth.php';


// =============================
// 🔹 RUTAS GENERALES (AUTENTICADOS)
// =============================
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/inicio', function () {
        return view('inicio');
    })->name('inicio');

    // CLIENTES
    Route::resource('clientes', ClienteController::class);
    Route::get('clientes-pdf', [ClienteController::class, 'exportPdf'])
        ->name('clientes.pdf');

    // SERVICIOS
    Route::resource('servicios', ServicioController::class);
    Route::get('servicios-pdf', [ServicioController::class, 'exportPdf'])
        ->name('servicios.pdf');

    // RESERVAS
    Route::get('reservas/search/ajax', [ReservaController::class, 'searchAjax'])
        ->name('reservas.searchAjax');

    Route::get('reservas/exportar/pdf', [ReservaController::class, 'exportarPDF'])
        ->name('reservas.exportar.pdf');

    Route::resource('reservas', ReservaController::class);

    // PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =============================
// 🔹 RUTAS SOLO ADMIN
// =============================
Route::middleware(['auth', 'isAdmin'])->group(function () {

    // LOGINS / USERS
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/pdf', [UserController::class, 'exportPdf'])->name('users.pdf');

    // EMPLEADOS
    Route::resource('empleados', EmpleadoController::class)->except(['show']);
});
