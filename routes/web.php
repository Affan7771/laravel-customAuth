<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('/register', [AuthController::class, 'registerUser'])->name('registerUser');
Route::get('/logout', [AuthController::class, 'logoutUser'])->name('logoutUser');
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'loginUser'])->name('loginUser');
Route::get('/profile', [AuthController::class, 'userProfile'])->name('profile');
Route::post('/profile', [AuthController::class, 'updateProfile'])->name('updateProfile');

