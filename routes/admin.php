<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('auth', 'verified')->group(function() {
    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('posts', PostController::class);
});

