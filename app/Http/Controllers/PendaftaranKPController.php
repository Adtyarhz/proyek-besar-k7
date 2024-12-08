<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PendaftaranKP;
use App\Models\KelayakanKP;
use Illuminate\Support\Facades\Storage;

class PendaftaranKPController extends Controller
{
    public function showFormPendaftaranKP()
    {
        $user = Auth::user();

        // Only Mahasiswa can access
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        // Check Kelayakan KP status
        $kelayakan = KelayakanKP::where('user_id', $user->id)->first();
        if (!$kelayakan || $kelayakan->status_kelayakan !== 'Disetujui') {
            return redirect()->back()->with('error', 'Anda belum Disetujui Kelayakannya untuk KP.');
        }

        return view('app.mahasiswa.formpendaftarankp', compact('user'));
    }

    public function storeFormPendaftaranKP(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        $kelayakan = KelayakanKP::where('user_id', $user->id)->first();
        if (!$kelayakan || $kelayakan->status_kelayakan !== 'Disetujui') {
            return redirect()->back()->with('error', 'Tidak dapat mendaftar KP. Kelayakan belum Disetujui.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'perusahaan' => 'required|string|max:255',
            'pelaksanaan' => 'required|string',
            'lokasi' => 'required|string',
            'bukti-penerimaan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti-penerimaan')) {
            $file = $request->file('bukti-penerimaan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $buktiPath = $file->storeAs('bukti_penerimaan_kp', $filename, 'public');
        }

        PendaftaranKP::create([
            'user_id' => $user->id,
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'perusahaan' => $validated['perusahaan'],
            'pelaksanaan' => $validated['pelaksanaan'],
            'lokasi' => $validated['lokasi'],
            'bukti_penerimaan' => $buktiPath,
            'status_pendaftaran' => 'Menunggu', // Set initial status to 'Menunggu'
        ]);

        return redirect()->route('home.mahasiswa')->with('success', 'Form Pendaftaran KP berhasil disubmit.');
    }
}
