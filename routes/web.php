<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCommentController;
use Illuminate\Support\Facades\Route;

// ── Front-office (public) ──────────────────────────────────────
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// ── Commentaires (utilisateur connecté) ───────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// ── Back-office (admin uniquement) ────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Articles
    Route::resource('posts', AdminPostController::class);

    // Catégories
    Route::resource('categories', AdminCategoryController::class);

    // Commentaires
    Route::get('comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::patch('comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::delete('comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';