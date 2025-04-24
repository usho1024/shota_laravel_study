<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->middleware(RedirectIfAuthenticated::class)->name('index');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');