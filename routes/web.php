<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('resumes/create', [ResumeController::class, 'create'])->name('resumes.create');
    Route::post('resumes', [ResumeController::class, 'store'])->name('resumes.store');
});

require __DIR__.'/settings.php';
