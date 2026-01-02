<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); // ← مهم جدًا
});

Route::get('/testapi', function () {
        return view('dashboard');
    })->name('dashboard'); // ← مهم جدًا