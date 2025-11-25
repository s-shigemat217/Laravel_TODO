<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('todos', [TodoController::class, 'store'])->name('todos.store');

    // edit, update, destroy にミドルウェアを適用
    Route::middleware('role')->group(function () {
        Route::get('todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');
        Route::patch('todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
        Route::delete('todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
    });

    Route::get('todos/{todo}', [TodoController::class, 'show'])->name('todos.show');
});

require __DIR__.'/auth.php';
