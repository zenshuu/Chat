<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChatController::class, 'index'])->name('home');
Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');
Route::get('/chats/{chat}/edit', [ChatController::class, 'edit'])->name('chats.edit');
Route::patch('/chats/{chat}', [ChatController::class, 'update'])->name('chats.update');
Route::delete('/chats/{chat}', [ChatController::class, 'destroy'])->name('chats.destroy');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');
