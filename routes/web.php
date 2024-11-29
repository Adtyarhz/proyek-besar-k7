<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

//awal
Route::get('/', function () {
    return view('auth/login');
})->name('auth/lohgin');

Route::prefix('auth')->group(function () {
    Route::get("/login", [AuthController::class, "getLogin"])->name("login");
    Route::post("/login", [AuthController::class, "postLogin"])->name("post.login");
});

//Route::get('/home', function () {
//    return 'Welcome to the home page!';
//})->name('home');

// Rute untuk Doswal
Route::middleware(['auth','checkroles:Doswal'])->group(function () {
    Route::get('/doswal/home_doswal', function () {
        return 'Welcome Doswal';
    })->name('doswal.dashboard');
});

// Rute untuk Koordinator
Route::middleware(['auth','checkroles:Koordinator'])->group(function () {
    Route::get('/koordinator/home_koordinator', function () {
        return 'Welcome Koordinator';
    })->name('koordinator.dashboard');
});

// Rute untuk Mahasiswa
Route::middleware(['auth', 'checkroles:Mahasiswa'])->group(function () {
    Route::get('/mahasiswa/home_mahasiswa', function () {
        return 'Welcome Mahasiswa';
    })->name('mahasiswa.dashboard');
});

// Rute untuk Kaprodi
Route::middleware(['auth','checkroles:Kaprodi'])->group(function () {
    Route::get('/kaprodi/home_kaprodi', function () {
        return 'Welcome Kaprodi';
    })->name('kaprodi.dashboard');
});
