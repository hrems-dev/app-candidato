<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\BiografiaController;
use App\Http\Controllers\TrayectoriaController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MensajeContactoController;
use App\Http\Controllers\PropuestaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

// ===== RUTAS ADMIN AUTHENTICATION =====

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// ===== RUTAS PÚBLICAS ======

Route::get('/', [PageController::class, 'index'])->name('home');

// Biografía
Route::get('/biografia', [BiografiaController::class, 'show'])->name('biografia.show');

// Trayectoria
Route::get('/trayectoria', [TrayectoriaController::class, 'index'])->name('trayectoria.index');

// Propuestas
Route::get('/propuestas', [PropuestaController::class, 'index'])->name('propuestas.index');
Route::get('/propuestas/{propuesta}', [PropuestaController::class, 'show'])->name('propuestas.show');

// Actividades
Route::get('/actividades', [ActividadController::class, 'index'])->name('actividades.index');

// Noticias
Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias.index');
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');

// Contacto
Route::get('/contacto', [MensajeContactoController::class, 'create'])->name('contacto.create');
Route::post('/contacto', [MensajeContactoController::class, 'store'])->name('contacto.store');

// ===== RUTAS AUTENTICADAS =====

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Mis citas
    Route::get('/citas', [CitaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/mis-citas', [CitaController::class, 'misCitas'])->name('citas.misCitas');

    // Configuración (Fortify)
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');
    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// ===== RUTAS ADMIN =====

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, '__invoke'])->name('dashboard');

    // Biografías
    Route::get('/biografias/edit', [BiografiaController::class, 'edit'])->name('biografias.edit');
    Route::put('/biografias', [BiografiaController::class, 'update'])->name('biografias.update');

    // Trayectorias
    Route::resource('trayectorias', TrayectoriaController::class);

    // Actividades
    Route::resource('actividades', ActividadController::class);

    // Noticias
    Route::resource('noticias', NoticiaController::class);

    // Propuestas
    Route::resource('propuestas', PropuestaController::class);

    // Citas
    Route::get('/citas', [CitaController::class, 'indexAdmin'])->name('citas.index');
    Route::put('/citas/{cita}/aprobar', [CitaController::class, 'aprobar'])->name('citas.aprobar');
    Route::put('/citas/{cita}/rechazar', [CitaController::class, 'rechazar'])->name('citas.rechazar');
    Route::delete('/citas/{cita}', [CitaController::class, 'destroy'])->name('citas.destroy');

    // Mensajes de contacto
    Route::get('/mensajes', [MensajeContactoController::class, 'indexAdmin'])->name('mensajes.index');
    Route::get('/mensajes/{mensaje}', [MensajeContactoController::class, 'show'])->name('mensajes.show');
    Route::delete('/mensajes/{mensaje}', [MensajeContactoController::class, 'destroy'])->name('mensajes.destroy');
});

