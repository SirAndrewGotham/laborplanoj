<?php

use App\Livewire\Boards\BoardIndex;
use App\Livewire\Boards\BoardShow;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/boards', BoardIndex::class)->name('boards.index');
Route::get('/boards/{board:slug}', BoardShow::class)->middleware(['auth:web', 'verified'])->name('board.show');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
