<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Aplicar middleware a las rutas de Filament
Route::middleware(['auth', 'verified', \App\Http\Middleware\CheckFilamentUserStatus::class])->group(function () {
    Route::get('/dashboard', function () {
        if (Gate::allows('access-admin', Auth::user())) {
            return redirect()->route('filament.admin.pages.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Cargar rutas de autenticación
require __DIR__.'/auth.php';


