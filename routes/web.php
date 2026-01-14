<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tenant;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'tenant'])
    ->prefix('{tenant:slug}')
    ->group(function () {

        Route::get('/dashboard', function (Tenant $tenant) {
            return view('tenant.dashboard', compact('tenant'));
        })->name('tenant.dashboard');

        Route::get('/clients', function (Tenant $tenant) {
            return view('tenant.clients.index', compact('tenant'));
        })->name('tenant.clients.index');

        Route::get('/projects', function (Tenant $tenant) {
            return view('tenant.projects.index', compact('tenant'));
        })->name('tenant.projects.index');

        Route::get('/tasks', function (Tenant $tenant) {
            return view('tenant.tasks.index', compact('tenant'));
        })->name('tenant.tasks.index');

        Route::get('/files', function (Tenant $tenant) {
            return view('tenant.files.index', compact('tenant'));
        })->name('tenant.files.index');

        Route::get('/settings', function (Tenant $tenant) {
            return view('tenant.settings.index', compact('tenant'));
        })->name('tenant.settings.index');
    });
