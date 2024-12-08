<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanMBKM; // For tableinput_mbkm
use App\Models\MbkmPendaftaran; // For tabel_mbkm

class KaprodiMbkmController extends Controller
{
    /**
     * Display a listing of Kelayakan MBKM for Kaprodi.
     *
     * @return \Illuminate\View\View
     */
    public function indexTableInputMbkm()
    {
        $user = Auth::user();

        // Ensure the user has the 'Kaprodi' role
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Fetch all Kelayakan MBKM entries
        $kelayakanMBKMs = KelayakanMBKM::with('user')->orderBy('created_at', 'desc')->get();

        return view('app.kaprodi.tableinput_mbkm', compact('kelayakanMBKMs'));
    }

    /**
     * Update Kaprodi's comment for Kelayakan MBKM.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID of the KelayakanMBKM entry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCatatanTableInputMbkm(Request $request, $id)
    {
        $user = Auth::user();

        // Ensure the user has the 'Kaprodi' role
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Validate input
        $request->validate([
            'catatan_kaprodi' => 'required|string|max:1000',
        ]);

        // Find the KelayakanMBKM entry
        $kelayakanMBKM = KelayakanMBKM::findOrFail($id);

        // Update the Kaprodi's comment
        $kelayakanMBKM->catatan_kaprodi = $request->input('catatan_kaprodi');
        $kelayakanMBKM->save();

        return redirect()->back()->with('success', 'Catatan Kaprodi berhasil diperbarui.');
    }

    /**
     * Display a listing of Pendaftaran MBKM for Kaprodi.
     *
     * @return \Illuminate\View\View
     */
    public function indexTabelMbkm()
    {
        $user = Auth::user();

        // Ensure the user has the 'Kaprodi' role
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Fetch all Pendaftaran MBKM entries
        $pendaftaranMbkm = MbkmPendaftaran::with('user')->orderBy('created_at', 'desc')->get();

        return view('app.kaprodi.tabel_mbkm', compact('pendaftaranMbkm'));
    }

    /**
     * Update Kaprodi's comment for Pendaftaran MBKM.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID of the MbkmPendaftaran entry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCatatanTabelMbkm(Request $request, $id)
    {
        $user = Auth::user();

        // Ensure the user has the 'Kaprodi' role
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // Validate input
        $request->validate([
            'catatan_kaprodi' => 'required|string|max:1000',
        ]);

        // Find the MbkmPendaftaran entry
        $pendaftaran = MbkmPendaftaran::findOrFail($id);

        // Update the Kaprodi's comment
        $pendaftaran->catatan_kaprodi = $request->input('catatan_kaprodi');
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Catatan Kaprodi berhasil diperbarui.');
    }
}
