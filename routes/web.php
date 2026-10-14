<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\Admin\AdminArtistController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\MediaUploadController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artisti', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artisti/{artist}', [ArtistController::class, 'show'])->name('artists.show');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/pagine/{page}', [StaticPageController::class, 'show'])->name('pages.show');

// Admin Routes (Breeze Auth & Verified)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::post('/media/upload', [MediaUploadController::class, 'upload'])->name('media.upload');
    Route::resource('artists', AdminArtistController::class);
    Route::resource('news', AdminNewsController::class);
    Route::resource('pages', AdminPageController::class)->only(['index', 'edit', 'update']);
});

require __DIR__.'/auth.php';
