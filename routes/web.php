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
    Route::get('/{cause}', [CauseController::class, 'show'])->name('cause.show');
});

require __DIR__ . '/auth.php';
