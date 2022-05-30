<?php

use App\Http\Controllers\Dashboard\StoryController;
use App\Http\Controllers\NoticeBoardController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/notice-board')->name('home');

// Route::view('/', 'welcome')->name('home');
Route::get('notice-board', [NoticeBoardController::class, 'index'])->name('notice-board');

Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('story', StoryController::class)->only(['index', 'store', 'show']);
    Route::get('story/{story}/approve', [StoryController::class, 'approve'])->name('story.approve');
});
