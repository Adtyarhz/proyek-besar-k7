<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelayakanKP;
use App\Models\PendaftaranKP;
use Illuminate\Support\Facades\Auth;

class KpController extends Controller
{
    /**
     * Display KP information page (Mahasiswa only).
     */
    public function informasi()
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        return view('app.mahasiswa.home_kp');
    }

    /**
     * Show the Form Kelayakan KP page (Mahasiswa only).
     */
    public function showFormKelayakanKP()
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        return view('app.mahasiswa.formkelayakan_kp');
    }

    /**
     * Store the Form Kelayakan KP data (Mahasiswa only).
     * Each Mahasiswa can only submit once.
     */
    public function storeFormKelayakanKP(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        // Check if the user already submitted once
        $existing = KelayakanKP::where('user_id', $user->id)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan Form Kelayakan KP sebelumnya.');
        }

        // Validate input
        $validated = $request->validate([
            'nilai_ipk' => 'required|numeric|min:0|max:4',
            'total_sks' => 'required|integer|min:0',
            'sks_semester6' => 'required|integer|min:0',
            'mata_kuliah_tidak_lulus' => 'required|string|max:255',
            'bukti_sks_ipk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'mata_kuliah_tidak_lulus.required' => 'Mata Kuliah Tidak Lulus wajib diisi.',
            'mata_kuliah_tidak_lulus.string' => 'Mata Kuliah Tidak Lulus harus berupa teks.',
            'mata_kuliah_tidak_lulus.max' => 'Mata Kuliah Tidak Lulus tidak boleh lebih dari 255 karakter.',
        ]);

        // Handle file upload
        $path = null;
        if ($request->hasFile('bukti_sks_ipk')) {
            $file = $request->file('bukti_sks_ipk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bukti_sks_ipk', $filename, 'public');
        }

        // Create the Kelayakan KP record with default status "Menunggu"
        KelayakanKP::create([
            'user_id' => $user->id,
            'nilai_ipk' => $validated['nilai_ipk'],
            'total_sks' => $validated['total_sks'],
            'sks_semester6' => $validated['sks_semester6'],
            'mata_kuliah_tidak_lulus' => $validated['mata_kuliah_tidak_lulus'],
            'bukti_sks_ipk' => $path,
            'status_kelayakan' => 'Menunggu',
        ]);

        return redirect()->route('kp.data_kelayakan')->with('success', 'Form Kelayakan KP berhasil disubmit.');
    }

    /**
     * Display the Data Kelayakan KP for the authenticated Mahasiswa.
     */
    public function showDataKelayakan()
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        $dataKelayakan = KelayakanKP::where('user_id', $user->id)->get();
        return view('app.mahasiswa.data_kelayakan', compact('dataKelayakan'));
    }

    /**
     * Show the data from Pendaftaran KP for the authenticated Mahasiswa.
     */
    public function showDataPendaftaran()
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        // Retrieve the PendaftaranKP records for this Mahasiswa
        $dataPendaftaran = PendaftaranKP::where('user_id', $user->id)->get();
        return view('app.mahasiswa.data_pendaftarankp', compact('dataPendaftaran'));
    }
}
