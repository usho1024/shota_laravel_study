<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');
