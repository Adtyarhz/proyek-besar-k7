<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MbkmPendaftaran;
use App\Models\KelayakanMBKM;

class MbkmPendaftaranController extends Controller
{
    /**
     * Tampilkan form pendaftaran MBKM.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();

        // Jika pengguna sudah memiliki pendaftaran, redirect ke halaman home
        if ($user->mbkmPendaftaran) {
            return redirect()->route('home.mahasiswa')->with('info', 'Anda sudah mendaftar MBKM.');
        }

        // Cek status kelayakan
        $kelayakan = KelayakanMBKM::where('user_id', $user->id)->first();

        // Jika tidak memenuhi syarat kelayakan, redirect ke halaman home
        if (!$kelayakan || $kelayakan->status_kelayakan !== 'Disetujui') {
            return redirect()->route('home.mahasiswa')->with('error', 'Anda belum memenuhi syarat untuk mendaftar MBKM.');
        }

        // Tampilkan form pendaftaran MBKM
        return view('app.mahasiswa.formfinal_mbkm', compact('user'));
    }

    public function showDataPendaftaran()
    {
        $user = Auth::user();
        
        // Retrieve the MBKM pendaftaran data for the authenticated user
        $pendaftaranMbkm = MbkmPendaftaran::where('user_id', $user->id)->first();
        
        return view('app.mahasiswa.data_pendaftaranmbkm', compact('pendaftaranMbkm'));
    }
    
    /**
     * Simpan data pendaftaran MBKM.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Jika pengguna sudah memiliki pendaftaran, redirect ke halaman home
        if ($user->mbkmPendaftaran) {
            return redirect()->route('home.mahasiswa')->with('info', 'Anda sudah mendaftar MBKM.');
        }

        // Cek status kelayakan
        $kelayakan = KelayakanMBKM::where('user_id', $user->id)->first();

        // Jika tidak memenuhi syarat kelayakan, redirect ke halaman home
        if (!$kelayakan || $kelayakan->status_kelayakan !== 'Disetujui') {
            return redirect()->route('home.mahasiswa')->with('error', 'Anda belum memenuhi syarat untuk mendaftar MBKM.');
        }

        // Validasi input
        $validated = $request->validate([
            'rencana_pelaksanaan_mbkm' => 'required|string|max:1000',
            'lokasi_mbkm' => 'required|string|max:255',
            'bukti_penerimaan_mbkm' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Upload file jika ada
        $path = null;
        if ($request->hasFile('bukti_penerimaan_mbkm')) {
            $path = $request->file('bukti_penerimaan_mbkm')->store('bukti_mbkm', 'public');
        }

        // Simpan data pendaftaran
        MbkmPendaftaran::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'nim' => $user->nim,
            'email' => $user->email,
            'rencana_pelaksanaan_mbkm' => $validated['rencana_pelaksanaan_mbkm'],
            'lokasi_mbkm' => $validated['lokasi_mbkm'],
            'bukti_penerimaan_mbkm' => $path,
            'status' => 'Menunggu',
        ]);

        // Redirect ke halaman home dengan pesan sukses
        return redirect()->route('home.mahasiswa')->with('success', 'Pendaftaran MBKM berhasil disubmit. Status Anda: Menunggu.');
    }
}
