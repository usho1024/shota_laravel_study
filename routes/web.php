<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as UserAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserAuthController::class, 'index'])->name('index');
    Route::post('/login', [UserAuthController::class, 'authenticate'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::middleware(['auth', 'can:manage-post,post'])->group(function () {
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::put('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
});

Route::middleware(['auth', 'can:manage-comment,comment'])->group(function () {
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::post('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [AdminAuthController::class, 'index'])->name('index');
        Route::post('/login', [AdminAuthController::class, 'authenticate'])->name('login');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [TopController::class, 'index'])->name('top');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});