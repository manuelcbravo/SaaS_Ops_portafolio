<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tenant;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    //config

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Volt::route('settings/menu', 'settings.menu')->name('settings.menu');

    //usuarios
    Volt::route('settings/users', 'config.users.index')->name('settings.users');
    Volt::route('settings/roles', 'config.roles.index')->name('settings.roles');
});

Route::middleware(['auth', 'tenant'])
    ->prefix('{tenant:slug}')
    ->group(function () {

    });

require __DIR__ . '/auth.php';
