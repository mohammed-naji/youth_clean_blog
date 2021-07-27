<?php

use App\Http\Controllers\Front\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [SiteController::class, 'index'])->name('homepage');

Route::get('blog/{post:slug}', [SiteController::class, 'show'])->name('blog.show');


// Auth
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
