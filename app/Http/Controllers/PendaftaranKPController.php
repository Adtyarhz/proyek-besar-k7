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

        // Validate the form inputs
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'perusahaan' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'email_perusahaan' => 'required|email|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'role' => 'required|string|max:100',
            'surat_pengantar' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload for surat_pengantar
        $suratPengantarPath = null;
        if ($request->hasFile('surat_pengantar')) {
            $file = $request->file('surat_pengantar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $suratPengantarPath = $file->storeAs('surat_pengantar', $filename, 'public');
        }

        // Save the form data into the database
        PendaftaranKP::create([
            'user_id' => $user->id,
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'perusahaan' => $validated['perusahaan'],
            'lokasi' => $validated['lokasi'],
            'email_perusahaan' => $validated['email_perusahaan'],
            'tanggal_awal' => $validated['tanggal_awal'],
            'tanggal_akhir' => $validated['tanggal_akhir'],
            'role' => $validated['role'], // Saving the role input from the form
            'surat_pengantar' => $suratPengantarPath, // Saving the file path
            'status_pendaftaran' => 'Menunggu',
        ]);

        return redirect()->route('home.mahasiswa')->with('success', 'Form Pendaftaran KP berhasil disubmit.');
    }
}
