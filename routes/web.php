<?php

use App\Http\Controllers\PistaController;
use App\Http\Controllers\ReservaController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('pistas', PistaController::class);
Route::resource('reservas', ReservaController::class);
Route::get('/selector', [PistaController::class, 'selector'])->name('selector');
Route::get('/counter', Counter::class);

require __DIR__.'/auth.php';
