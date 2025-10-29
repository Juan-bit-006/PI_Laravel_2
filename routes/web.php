
<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;

// Ruta pública (invitados)
Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

// Página principal (solo autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        return view('inicio');
    })->name('inicio');

    Route::resource('clientes', ClienteController::class);
    Route::get('clientes-pdf', [ClienteController::class, 'exportPdf'])->name('clientes.pdf');

    Route::resource('servicios', ServicioController::class);
    Route::get('servicios-pdf', [ServicioController::class, 'pdf'])->name('servicios.pdf');

    Route::resource('reservas', ReservaController::class);
    Route::get('/reservas/search/ajax', [ReservaController::class, 'searchAjax'])->name('reservas.searchAjax');
    Route::get('reservas/pdf', [ReservaController::class, 'exportarPDF'])->name('reservas.pdf');

    Route::resource('users', UserController::class);

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard opcional
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Autenticación Breeze
require __DIR__.'/auth.php';
