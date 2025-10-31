
<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;

//Ruta redireccion al login
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');


/*Ruta pública (invitados)
Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome'); */

// Ruta raíz: redirige al login o al inicio según autenticación
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('login'); // Si está logueado
    }
    return redirect()->route('login'); // Si no está logueado
});

 // Página principal (solo autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        return view('inicio');
    })->name('inicio'); 

    Route::resource('clientes', ClienteController::class);
    Route::get('clientes-pdf', [ClienteController::class, 'exportPdf'])->name('clientes.pdf');

    Route::resource('servicios', ServicioController::class);
    Route::get('servicios-pdf', [ServicioController::class, 'exportPdf'])->name('servicios.pdf');

    Route::get('reservas/search/ajax', [ReservaController::class, 'searchAjax'])
        ->name('reservas.searchAjax');

    Route::get('reservas/exportar/pdf', [ReservaController::class, 'exportarPDF'])
        ->name('reservas.exportar.pdf');
    Route::resource('reservas', ReservaController::class);

//  Solo los usuarios con rol ADMIN pueden acceder a estas rutas
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
    Route::get('users/pdf', [UserController::class, 'exportPdf'])->name('users.pdf');
});


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
