<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Correctly imported Auth facade
use App\Models\KelayakanMBKM;
use Illuminate\Support\Facades\Storage;

class MbkmController extends Controller
{
    /**
     * Display the Informasi MBKM page.
     */
    public function informasi()
    {
        return view('app.mahasiswa.home_mbkm');
    }

    /**
     * Show the form for creating a new Kelayakan MBKM.
     */
    public function showFormKelayakanMBKM()
    {
        $user = Auth::user();

        // Only Mahasiswa can access
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        // Check if Mahasiswa has already submitted Kelayakan MBKM
        $existing = KelayakanMBKM::where('user_id', $user->id)->first();
        if ($existing) {
            return redirect()->route('home.mahasiswa')->with('error', 'Anda telah mengajukan Form Kelayakan MBKM.');
        }

        return view('app.mahasiswa.formkelayakan_mbkm', compact('user'));
    }

    /**
     * Store a newly created Kelayakan MBKM in storage.
     */
    public function storeFormKelayakanMBKM(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        // Check if Mahasiswa has already submitted Kelayakan MBKM
        $existing = KelayakanMBKM::where('user_id', $user->id)->first();
        if ($existing) {
            return redirect()->route('home.mahasiswa')->with('error', 'Anda telah mengajukan Form Kelayakan MBKM.');
        }

        $validated = $request->validate([
            'nilai_ipk' => 'required|numeric|min:0|max:10',
            'total_sks' => 'required|integer|min:0',
            'sks_semester6' => 'required|integer|min:0',
            'mata_kuliah_tidak_lulus' => 'required|string',
            'bukti_sks_ipk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_sks_ipk')) {
            $file = $request->file('bukti_sks_ipk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $buktiPath = $file->storeAs('bukti_sks_ipk_mbkm', $filename, 'public');
        }

        KelayakanMBKM::create([
            'user_id' => $user->id,
            'nilai_ipk' => $validated['nilai_ipk'],
            'total_sks' => $validated['total_sks'],
            'sks_semester6' => $validated['sks_semester6'],
            'mata_kuliah_tidak_lulus' => $validated['mata_kuliah_tidak_lulus'],
            'bukti_sks_ipk' => $buktiPath,
            'status_kelayakan' => 'Menunggu',
            // Catatan fields are nullable and handled later
        ]);

        return redirect()->route('home.mahasiswa')->with('success', 'Form Kelayakan MBKM berhasil disubmit.');
    }

    /**
     * Show the data Kelayakan MBKM for the logged-in Mahasiswa.
     */
    public function showDataKelayakanMBKM()
    {
        $user = Auth::user();

        // Only Mahasiswa can access
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        // Retrieve the Kelayakan MBKM data for the user
        $dataKelayakan = KelayakanMBKM::where('user_id', $user->id)->get();

        return view('app.mahasiswa.data_kelayakanmbkm', compact('dataKelayakan'));
    }

    // Future methods to handle Catatan Kaprodi, Dosen Wali, Koordinator can be added here
}
