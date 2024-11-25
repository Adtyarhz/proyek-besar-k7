<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//awal
Route::get('/', function () {
    return view('auth/login');
})->name('auth/lohgin');

Route::prefix('auth')->group(function () {
    Route::get("/login", [AuthController::class, "getLogin"])->name("login");
    Route::post("/login", [AuthController::class, "postLogin"])->name("post.login");
});