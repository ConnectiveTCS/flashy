<?php

use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    //Flashcard routes
    Route::resource('flashcards', FlashcardController::class);
    Route::get('flashcards/{flashcard}/edit', [FlashcardController::class, 'edit'])->name('flashcards.edit');
    Route::put('flashcards/{flashcard}', [FlashcardController::class, 'update'])->name('flashcards.update');
    Route::delete('flashcards/{flashcard}', [FlashcardController::class, 'destroy'])->name('flashcards.destroy');
    // User management routes
});

require __DIR__.'/auth.php';
