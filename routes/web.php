<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [App\Http\Controllers\Admin\AdminDashboardController::class, 'search'])->name('search'); // Nouvelle route pour la recherche
    Route::resource('packs', App\Http\Controllers\Admin\PackAlimentaireController::class)->parameters(['packs' => 'packAlimentaire']);
    Route::resource('promotions', App\Http\Controllers\Admin\PromotionController::class);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::get('clients', [App\Http\Controllers\Admin\ClientController::class, 'index'])->name('clients.index');
    Route::get('clients/orders/{client_phone}/{client_name}', [App\Http\Controllers\Admin\ClientController::class, 'showClientOrders'])->name('clients.showOrders');
    Route::get('analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics.index');

    // Settings Routes
    Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings/theme', [App\Http\Controllers\Admin\SettingsController::class, 'updateTheme'])->name('settings.theme.update');
    Route::post('settings/users', [App\Http\Controllers\Admin\SettingsController::class, 'storeUser'])->name('settings.users.store');
    Route::get('settings/users/{user}/edit', [App\Http\Controllers\Admin\SettingsController::class, 'editUser'])->name('settings.users.edit');
    Route::put('settings/users/{user}', [App\Http\Controllers\Admin\SettingsController::class, 'updateUser'])->name('settings.users.update');
    Route::delete('settings/users/{user}', [App\Http\Controllers\Admin\SettingsController::class, 'destroyUser'])->name('settings.users.destroy');
});
