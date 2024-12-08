<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanMBKM; // For tabelinput_mbkm
use App\Models\MbkmPendaftaran; // For tabel_mbkm

class DoswalMbkmController extends Controller
{
    /**
     * Display the Table Input MBKM for Doswal.
     *
     * @return \Illuminate\View\View
     */
    public function indexTableInputMbkm()
    {
        $user = Auth::user();

        // Ensure the user has the 'Doswal' role
        if ($user->role !== 'Doswal') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Fetch all KelayakanMBKM entries assigned to this Doswal
        $kelayakanMBKMs = KelayakanMBKM::with('user')
            ->where('doswal_id', $user->id) // Assuming 'doswal_id' is the foreign key
            ->orderBy('created_at', 'desc')
            ->get();

        return view('app.doswal.tabelinput_mbkm', compact('kelayakanMBKMs'));
    }

    /**
     * Update Catatan Dosen Wali for a specific KelayakanMBKM entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID of the KelayakanMBKM
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCatatanInputMbkm(Request $request, $id)
    {
        $user = Auth::user();

        // Ensure the user has the 'Doswal' role
        if ($user->role !== 'Doswal') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Validate the input
        $request->validate([
            'catatan_dosen_wali' => 'required|string|max:1000',
        ]);

        // Find the KelayakanMBKM entry or fail
        $pendaftaran = KelayakanMBKM::findOrFail($id);

        // Ensure the Doswal is authorized to update this registration
        if ($pendaftaran->doswal_id !== $user->id) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Update the Catatan Dosen Wali
        $pendaftaran->catatan_dosen_wali = $request->input('catatan_dosen_wali');
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Catatan Dosen Wali berhasil diperbarui.');
    }

    /**
     * Display the Tabel MBKM for Doswal.
     *
     * @return \Illuminate\View\View
     */
    public function indexTabelMbkm()
    {
        $user = Auth::user();

        // Ensure the user has the 'Doswal' role
        if ($user->role !== 'Doswal') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Fetch all MbkmPendaftaran entries assigned to this Doswal
        $pendaftaranMbkm = MbkmPendaftaran::with('user')->orderBy('created_at', 'desc')->get();

        return view('app.doswal.tabel_mbkm', compact('pendaftaranMbkm'));
    }

    /**
     * Update Catatan Dosen Wali for a specific MbkmPendaftaran entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID of the MbkmPendaftaran entry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCatatanTabelMbkm(Request $request, $id)
    {
        $user = Auth::user();

        // Ensure the user has the 'Doswal' role
        if ($user->role !== 'Doswal') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Validate the input
        $request->validate([
            'catatan_dosen_wali' => 'required|string|max:1000',
        ]);

        // Find the MbkmPendaftaran entry or fail
        $pendaftaran = MbkmPendaftaran::findOrFail($id);


        // Update the Catatan Dosen Wali
        $pendaftaran->catatan_dosen_wali = $request->input('catatan_dosen_wali');
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Catatan Dosen Wali berhasil diperbarui.');
    }
}