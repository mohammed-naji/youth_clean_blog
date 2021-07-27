<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('auth', 'verified', 'admin_or_user')->group(function() {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');

    Route::resource('posts', PostController::class);

    Route::resource('categories', CategoryController::class);

    // Route::resource('tags', PostController::class);
});

