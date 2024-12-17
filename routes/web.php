<?php

use App\Http\Controllers\DistributionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MbkmController;
use App\Http\Controllers\KpController;
use App\Http\Controllers\DoswalKPController;
use App\Http\Controllers\KaprodiKPController;
use App\Http\Controllers\KoordinatorKPController;
use App\Http\Controllers\PendaftaranKPController;
use App\Http\Controllers\KoordinatorMbkmController;
use App\Http\Controllers\DoswalMbkmController;
use App\Http\Controllers\KaprodiMbkmController;
use App\Http\Controllers\MbkmPendaftaranController;
use App\Http\Controllers\AdminStudentCountController;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('post.login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('post.register');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // MBKM Routes
    Route::get('/home_mbkm', [MbkmController::class, 'informasi'])->name('mbkm.informasi');

    // Form Kelayakan MBKM (Mahasiswa Only)
    Route::get('/formkelayakan_mbkm', [MbkmController::class, 'showFormKelayakanMBKM'])->name('mbkm.formkelayakan');
    Route::post('/formkelayakan_mbkm', [MbkmController::class, 'storeFormKelayakanMBKM'])->name('mbkm.formkelayakan.store');

    // Data Kelayakan MBKM (Mahasiswa Only)
    Route::get('/data_kelayakan_mbkm', [MbkmController::class, 'showDataKelayakanMBKM'])->name('mbkm.data_kelayakan');

    // KP (Mahasiswa) Routes
    Route::get('/formkelayakan_kp', [KpController::class, 'showFormKelayakanKP'])->name('kp.formkelayakan');
    Route::post('/formkelayakan_kp', [KpController::class, 'storeFormKelayakanKP'])->name('kp.formkelayakan.store');
    Route::get('/data_kelayakan', [KpController::class, 'showDataKelayakan'])->name('kp.data_kelayakan');
    Route::get('/home_kp', [KpController::class, 'informasi'])->name('kp.informasi');

    // Pendaftaran KP (Mahasiswa) Routes
    Route::get('/formpendaftaran_kp', [PendaftaranKPController::class, 'showFormPendaftaranKP'])->name('kp.formpendaftaran');
    Route::post('/formpendaftaran_kp', [PendaftaranKPController::class, 'storeFormPendaftaranKP'])->name('kp.formpendaftaran.store');
    Route::get('/data_pendaftaran_kp', [KpController::class, 'showDataPendaftaran'])->name('kp.data_pendaftaran');

    // Pendaftaran MBKM (Mahasiswa) Routes
    Route::get('/formfinal_mbkm', [MbkmPendaftaranController::class, 'create'])->name('mbkm_pendaftaran.create');
    Route::post('/formfinal_mbkm', [MbkmPendaftaranController::class, 'store'])->name('mbkm_pendaftaran.store');
    Route::get('/data_pendaftaran_mbkm', [MbkmPendaftaranController::class, 'showDataPendaftaran'])->name('mbkm_pendaftaran.data');

    // Home routes
    Route::get('/home', [UsersController::class, 'home'])->name('home');
    Route::get('/home/mahasiswa', [UsersController::class, 'mahasiswaHome'])->name('home.mahasiswa');
    Route::get('/home/doswal', [UsersController::class, 'doswalHome'])->name('home.doswal');
    Route::get('/home/kaprodi', [UsersController::class, 'kaprodiHome'])->name('home.kaprodi');
    Route::get('/home/koordinator', [UsersController::class, 'koordinatorHome'])->name('home.koordinator');
    Route::get('/home/admin', [UsersController::class, 'adminHome'])->name('home.admin');

    // Pertimbangan KP Routes
    // Doswal
    Route::get('/tabelinput_kp_doswal', [DoswalKPController::class, 'viewTableInputKPDoswal'])->name('doswal.tabelinputkp');
    Route::post('/tabelinput_kp_doswal/{id}/catatan', [DoswalKPController::class, 'updateCatatanDoswal'])->name('doswal.tabelinputkp.update_catatan');

    // Kaprodi
    Route::get('/tabelinput_kp_kaprodi', [KaprodiKPController::class, 'viewTableInputKPKaprodi'])->name('kaprodi.tabelinputkp');
    Route::post('/tabelinput_kp_kaprodi/{id}/catatan', [KaprodiKPController::class, 'updateCatatanKaprodi'])->name('kaprodi.tabelinputkp.update_catatan');

    // Koordinator
    Route::get('/tabelinput_kp_koordinator', [KoordinatorKPController::class, 'viewTableInputKPKoordinator'])->name('koordinator.tabelinputkp');
    Route::post('/tabelinput_kp_koordinator/{id}/catatan', [KoordinatorKPController::class, 'updateCatatanKoordinator'])->name('koordinator.tabelinputkp.update_catatan');
    Route::post('/tabelinput_kp_koordinator/{id}/status', [KoordinatorKPController::class, 'updateStatus'])->name('koordinator.tabelinputkp.update_status');

    // Eligible KP Routes
    // Koordinator
    Route::get('/table_eligible_kp_koordinator', [KoordinatorKPController::class, 'viewEligibleKP'])->name('koordinator.tableeligiblekp');
    Route::post('/table_eligible_kp_koordinator/{id}/catatan', [KoordinatorKPController::class, 'updateEligibleCatatanKoordinator'])->name('koordinator.tableeligiblekp.update_catatan');
    Route::post('/table_eligible_kp_koordinator/{id}/status', [KoordinatorKPController::class, 'updateEligibleStatus'])->name('koordinator.tableeligiblekp.update_status');
    Route::post('/table_eligible_kp_koordinator/{id}/sks', [KoordinatorKPController::class, 'updateSksKoordinator'])->name('koordinator.tableeligiblekp.update_sks');

    // Kaprodi Eligible KP
    Route::get('/table_eligible_kp_kaprodi', [KaprodiKPController::class, 'viewEligibleKPKaprodi'])->name('kaprodi.tableeligiblekp');
    Route::post('/table_eligible_kp_kaprodi/{id}/catatan', [KaprodiKPController::class, 'updateEligibleCatatanKaprodi'])->name('kaprodi.tableeligiblekp.update_catatan');

    // Doswal Eligible KP
    Route::get('/table_eligible_kp_doswal', [DoswalKPController::class, 'viewEligibleKPDoswal'])->name('doswal.tableeligiblekp');
    Route::post('/table_eligible_kp_doswal/{id}/catatan', [DoswalKPController::class, 'updateEligibleCatatanDoswal'])->name('doswal.tableeligiblekp.update_catatan');

    // Koordinator MBKM Routes
    Route::prefix('koordinator')->name('koordinator.')->group(function () {
        // Table Pertimbangan MBKM (Kelayakan MBKM)
        Route::get('/tableinput_mbkm', [KoordinatorMbkmController::class, 'indexKelayakan'])->name('tabelinput_mbkm');

        // Update Koordinator's Comment for Kelayakan MBKM
        Route::post('/tableinput_mbkm/{id}/update_catatan', [KoordinatorMbkmController::class, 'updateCatatanKelayakan'])->name('tabelinput_mbkm.update_catatan');

        // Update Status for Kelayakan MBKM
        Route::post('/tableinput_mbkm/{id}/update_status', [KoordinatorMbkmController::class, 'updateStatusKelayakan'])->name('tabelinput_mbkm.update_status');

        // Table Pendaftaran MBKM (Pendaftaran MBKM)
        Route::get('/tabel_mbkm', [KoordinatorMbkmController::class, 'indexPendaftaran'])->name('tabel_mbkm');

        // Update Status for Pendaftaran MBKM
        Route::post('/tabel_mbkm/{id}/update_status', [KoordinatorMbkmController::class, 'updateStatusPendaftaran'])->name('tabel_mbkm.update_status');

        // Update SKS for Pendaftaran MBKM
        Route::post('/tabel_mbkm/{id}/update_sks', [KoordinatorMbkmController::class, 'updateSksPendaftaran'])->name('tabel_mbkm.update_sks');

        // Update Catatan Koordinator for Pendaftaran MBKM
        Route::post('/tabel_mbkm/{id}/update_catatan', [KoordinatorMbkmController::class, 'updateCatatanPendaftaran'])->name('tabel_mbkm.update_catatan');
    });

    // Doswal MBKM Routes
    Route::prefix('doswal')->name('doswal.')->group(function () {
        // Table Input MBKM
        Route::get('/tabelinput_mbkm', [DoswalMbkmController::class, 'indexTableInputMbkm'])->name('tabelinput_mbkm');

        // Update Dosen Wali's Comment for tabelinput_mbkm
        Route::post('/tabelinput_mbkm/{id}/update_catatan', [DoswalMbkmController::class, 'updateCatatanInputMbkm'])->name('tabelinput_mbkm.update_catatan');

        // Table MBKM
        Route::get('/tabel_mbkm', [DoswalMbkmController::class, 'indexTabelMbkm'])->name('tabel_mbkm');

        // Update Dosen Wali's Comment for tabel_mbkm
        Route::post('/tabel_mbkm/{id}/update_catatan', [DoswalMbkmController::class, 'updateCatatanTabelMbkm'])->name('tabel_mbkm.update_catatan');
    });

    // Kaprodi MBKM Routes
    Route::prefix('kaprodi')->name('kaprodi.')->group(function () {
        // Table Input MBKM
        Route::get('/tabelinput_mbkm', [KaprodiMbkmController::class, 'indexTableInputMbkm'])->name('tabelinput_mbkm');

        // Update Kaprodi's Comment for Kelayakan MBKM
        Route::post('/tabelinput_mbkm/{id}/update_catatan', [KaprodiMbkmController::class, 'updateCatatanTableInputMbkm'])->name('tabelinput_mbkm.update_catatan');

        // Table Pendaftaran MBKM
        Route::get('/tabel_mbkm', [KaprodiMbkmController::class, 'indexTabelMbkm'])->name('tabel_mbkm');

        // Update Kaprodi's Comment for Pendaftaran MBKM
        Route::post('/tabel_mbkm/{id}/update_catatan', [KaprodiMbkmController::class, 'updateCatatanTabelMbkm'])->name('tabel_mbkm.update_catatan');
    });

    //Student Count Route
    Route::get('/admin/students/count', [AdminStudentCountController::class, 'indexCount'])->name('admin.studentcount.index');
    Route::post('/admin/students/count/add', [AdminStudentCountController::class, 'storeCount'])->name('addStudentCount');
    Route::put('/admin/students/count/edit', [AdminStudentCountController::class, 'updateCount'])->name('updateStudentCount');

    // Kelola Chart Persebaran
    Route::get('/admin/Distribution/kelola', [DistributionController::class, 'indexDistributions'])->name('distributions.index');
    Route::post('/admin/Distribution/add', [DistributionController::class, 'storeDistribution'])->name('distributionsadd');
    Route::put('/admin/Distribution/edit/{id}', [DistributionController::class, 'updateDistribution'])->name('distributionsedit');
    Route::delete('/admin/Distribution/delete/{id}', [DistributionController::class, 'destroyDistribution'])->name('distributiondelete');

    // Kelola Pengguna Routes
    Route::get('/admin/users/kelola', [UsersController::class, 'index'])->name('kelola');
    Route::post('/admin/users/add', [UsersController::class, 'store'])->name('adduser');
    Route::put('/admin/users/edit/{id}', [UsersController::class, 'edit'])->name('edituser');
    Route::delete('/admin/users/delete/{id}', [UsersController::class, 'delete'])->name('deleteuser');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
