<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MbkmController;
use App\Http\Controllers\KpController;
use App\Http\Controllers\DoswalKPController;
use App\Http\Controllers\KaprodiKPController;
use App\Http\Controllers\KoordinatorKPController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('post.login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('post.register');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/home_mbkm', [MbkmController::class, 'informasi'])->name('mbkm.informasi');
    Route::get('/formkelayakan_kp', [KpController::class, 'showFormKelayakanKP'])->name('kp.formkelayakan');
    Route::post('/formkelayakan_kp', [KpController::class, 'storeFormKelayakanKP'])->name('kp.formkelayakan.store');
    Route::get('/data_kelayakan', [KpController::class, 'showDataKelayakan'])->name('kp.data_kelayakan');
    Route::get('/home_kp', [KpController::class, 'informasi'])->name('kp.informasi');

    // Main home route
    Route::get('/home', [UsersController::class, 'home'])->name('home');

    // Role-specific home pages
    Route::get('/home/mahasiswa', [UsersController::class, 'mahasiswaHome'])->name('home.mahasiswa');
    Route::get('/home/doswal', [UsersController::class, 'doswalHome'])->name('home.doswal');
    Route::get('/home/kaprodi', [UsersController::class, 'kaprodiHome'])->name('home.kaprodi');
    Route::get('/home/koordinator', [UsersController::class, 'koordinatorHome'])->name('home.koordinator');

    // Doswal KP routes
    Route::get('/tabelinput_kp_doswal', [DoswalKPController::class, 'viewTableInputKPDoswal'])->name('doswal.tabelinputkp');
    Route::post('/tabelinput_kp_doswal/{id}/catatan', [DoswalKPController::class, 'updateCatatanDoswal'])->name('doswal.tabelinputkp.update_catatan');

    // Kaprodi KP routes
    Route::get('/tabelinput_kp_kaprodi', [KaprodiKPController::class, 'viewTableInputKPKaprodi'])->name('kaprodi.tabelinputkp');
    Route::post('/tabelinput_kp_kaprodi/{id}/catatan', [KaprodiKPController::class, 'updateCatatanKaprodi'])->name('kaprodi.tabelinputkp.update_catatan');

    // Koordinator KP routes
    Route::get('/tabelinput_kp_koordinator', [KoordinatorKPController::class, 'viewTableInputKPKoordinator'])->name('koordinator.tabelinputkp');
    Route::post('/tabelinput_kp_koordinator/{id}/catatan', [KoordinatorKPController::class, 'updateCatatanKoordinator'])->name('koordinator.tabelinputkp.update_catatan');
    Route::post('/tabelinput_kp_koordinator/{id}/status', [KoordinatorKPController::class, 'updateStatus'])->name('koordinator.tabelinputkp.update_status');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
