<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\BetTypeController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\DepositController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/informacion', function () {
    return view('informacion');
})->name('informacion');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rutas protegidas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/betting', [BettingController::class, 'index'])->name('betting.index');
    Route::post('/betting/{event}/bet', [BettingController::class, 'placeBet'])->name('betting.placeBet');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/betting/history', [BettingController::class, 'history'])->name('betting.history');
    
    // Rutas de depósitos para usuarios
    Route::get('/deposits', [DepositController::class, 'index'])->name('user.deposits.index');
    Route::post('/deposits', [DepositController::class, 'store'])->name('user.deposits.store');

    Route::get('/billetera', [DepositController::class, 'wallet'])->name('user.wallet');

    // Ruta de logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Ruta para mostrar la vista de apuesta
    Route::get('/betting/{event}/apostar', [App\Http\Controllers\BettingController::class, 'bet'])->name('betting.bet');

    // Ruta para cancelar la apuesta
    Route::patch('/betting/{bet}/cancel', [App\Http\Controllers\BettingController::class, 'cancel'])->name('betting.cancel');

    // Ruta para realizar cashout de la apuesta
    Route::patch('/betting/{bet}/cashout', [App\Http\Controllers\BettingController::class, 'cashout'])->name('betting.cashout');

    // Ruta para obtener notificaciones del usuario vía AJAX
    Route::get('/betting/notifications', [App\Http\Controllers\BettingController::class, 'notifications']);

    // Ruta para marcar notificaciones como leídas
    Route::post('/betting/notifications/mark-as-read', [App\Http\Controllers\BettingController::class, 'markNotificationsAsRead'])->name('betting.notifications.markAsRead');
});

// Rutas de administración
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', App\Http\Controllers\Admin\EventController::class);
        Route::resource('bet-types', App\Http\Controllers\Admin\BetTypeController::class);
        Route::resource('payment-methods', App\Http\Controllers\Admin\PaymentMethodController::class);
        Route::resource('announcements', App\Http\Controllers\Admin\AnnouncementController::class);
        Route::post('announcements/{announcement}/toggle', [App\Http\Controllers\Admin\AnnouncementController::class, 'toggle'])
            ->name('announcements.toggle');
        Route::resource('deposits', App\Http\Controllers\Admin\DepositController::class);
        Route::post('deposits/{deposit}/approve', [App\Http\Controllers\Admin\DepositController::class, 'approve'])
            ->name('deposits.approve');
        Route::post('deposits/{deposit}/reject', [App\Http\Controllers\Admin\DepositController::class, 'reject'])
            ->name('deposits.reject');
    });

// Términos y condiciones
Route::get('/terms', function () {
    return view('auth.terms');
})->name('terms');

