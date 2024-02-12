<?php

use App\Http\Controllers\CauseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::get('/', [CauseController::class, 'index'])->name('home');

// Queue
Route::middleware('is_admin')->group(function () {
    Route::get('/queue', [CauseController::class, 'queue'])->name('queue');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Causes
Route::middleware('auth')->prefix('cause')->group(function () {
    Route::get('/create', [CauseController::class, 'create'])->name('cause.create');
    Route::post('/store', [CauseController::class, 'store'])->name('cause.store');
    Route::post('/{cause}/donate', [CauseController::class, 'donate'])->name('cause.donate');
    Route::get('/{cause}/edit', [CauseController::class, 'edit'])->name('cause.edit');
    Route::post('/{cause}/update', [CauseController::class, 'update'])->name('cause.update');
    Route::post('/{cause}/destroy', [CauseController::class, 'destroy'])->name('cause.destroy');
    Route::post('/{cause}/like', [CauseController::class, 'like'])->name('cause.like');
    Route::post('/{cause}/dislike', [CauseController::class, 'dislike'])->name('cause.dislike');
});

Route::get('cause/{cause}/', [CauseController::class, 'show'])->name('cause.show');

require __DIR__ . '/auth.php';
