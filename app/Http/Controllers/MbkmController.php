<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanMBKM;
use Illuminate\Support\Facades\Storage;

class MbkmController extends Controller
{
    /**
     * Tampilkan halaman informasi MBKM.
     */
    public function informasi()
    {
        return view('app.mahasiswa.home_mbkm');
    }

    /**
     * Tampilkan form kelayakan MBKM.
     */
    public function showFormKelayakanMBKM()
    {
        $user = Auth::user();

        // Hanya Mahasiswa yang dapat mengakses
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Periksa apakah mahasiswa sudah pernah mengajukan form kelayakan
        $existing = KelayakanMBKM::where('user_id', $user->id)->first();
        if ($existing) {
            return redirect()->route('home.mahasiswa')->with('error', 'Anda telah mengajukan Form Kelayakan MBKM.');
        }

        return view('app.mahasiswa.formkelayakan_mbkm', compact('user'));
    }

    /**
     * Simpan data form kelayakan MBKM.
     */
    public function storeFormKelayakanMBKM(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Periksa apakah mahasiswa sudah pernah mengajukan form kelayakan
        $existing = KelayakanMBKM::where('user_id', $user->id)->first();
        if ($existing) {
            return redirect()->route('home.mahasiswa')->with('error', 'Anda telah mengajukan Form Kelayakan MBKM.');
        }

        // Validasi input
        $validated = $request->validate([
            'nilai_ipk' => 'required|numeric|min:0|max:10',
            'total_sks' => 'required|integer|min:0',
            'sks_semester6' => 'required|integer|min:0',
            'mata_kuliah_tidak_lulus' => 'required|string|max:255',
            'nilai_keasramaan' => 'required|string|max:2',
            'bukti_sks_ipk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Upload file jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti_sks_ipk')) {
            $file = $request->file('bukti_sks_ipk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $buktiPath = $file->storeAs('bukti_sks_ipk_mbkm', $filename, 'public');
        }

        // Simpan data ke database
        KelayakanMBKM::create([
            'user_id' => $user->id,
            'nilai_ipk' => $validated['nilai_ipk'],
            'total_sks' => $validated['total_sks'],
            'sks_semester6' => $validated['sks_semester6'],
            'mata_kuliah_tidak_lulus' => $validated['mata_kuliah_tidak_lulus'],
            'nilai_keasramaan' => $validated['nilai_keasramaan'],
            'bukti_sks_ipk' => $buktiPath,
            'status_kelayakan' => 'Menunggu',
        ]);

        return redirect()->route('home.mahasiswa')->with('success', 'Form Kelayakan MBKM berhasil disubmit.');
    }

    /**
     * Tampilkan data kelayakan MBKM mahasiswa.
     */
    public function showDataKelayakanMBKM()
    {
        $user = Auth::user();

        // Hanya Mahasiswa yang dapat mengakses
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Ambil data kelayakan MBKM mahasiswa
        $dataKelayakan = KelayakanMBKM::where('user_id', $user->id)->get();

        return view('app.mahasiswa.data_kelayakanmbkm', compact('dataKelayakan'));
    }
}
