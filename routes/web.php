
<?php
// Permitir POST a la raíz para evitar error 405
Route::post('/', function () {
    return view('inicio');
});

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaController;

// Página de inicio
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

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    // CRUD Clientes
    Route::resource('clientes', ClienteController::class);
    Route::get('clientes-pdf', [ClienteController::class, 'exportPdf'])->name('clientes.pdf');

    // CRUD Servicios
    Route::resource('servicios', ServicioController::class);

    // CRUD Reservas
    Route::resource('reservas', ReservaController::class);

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autenticación Breeze
require __DIR__.'/auth.php';
