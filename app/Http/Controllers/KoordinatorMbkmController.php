<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelayakanMBKM;
use App\Models\MbkmPendaftaran;

class KoordinatorMbkmController extends Controller
{
    /**
     * Display a listing of MBKM eligibility data.
     *
     * @return \Illuminate\View\View
     */
    public function indexKelayakan()
    {
        // Fetch all Kelayakan MBKM data with associated user information
        $kelayakanMBKMs = KelayakanMBKM::with('user')->orderBy('created_at', 'desc')->get();

        return view('app.koordinator.tableinput_mbkm', compact('kelayakanMBKMs'));
    }

    /**
     * Update the Koordinator's comment for a specific KelayakanMBKM entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID of the KelayakanMBKM entry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCatatanKelayakan(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'catatan_koordinator' => 'required|string',
        ]);

        // Find the KelayakanMBKM entry or fail
        $kelayakanMBKM = KelayakanMBKM::findOrFail($id);

        // Update the Koordinator's comment
        $kelayakanMBKM->catatan_koordinator = $request->input('catatan_koordinator');
        $kelayakanMBKM->save();

        return redirect()->back()->with('success', 'Catatan Koordinator berhasil diperbarui.');
    }

    /**
     * Update the status of a specific KelayakanMBKM entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID of the KelayakanMBKM entry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatusKelayakan(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'status_kelayakan' => 'required|in:Menunggu,Disetujui,Ditolak',
        ]);

        // Find the KelayakanMBKM entry or fail
        $kelayakanMBKM = KelayakanMBKM::findOrFail($id);

        // Update the status
        $kelayakanMBKM->status_kelayakan = $request->input('status_kelayakan');
        $kelayakanMBKM->save();

        return redirect()->back()->with('success', 'Status Kelayakan MBKM berhasil diperbarui.');
    }

    /**
     * Display a listing of MBKM registrations.
     *
     * @return \Illuminate\View\View
     */
    public function indexPendaftaran()
    {
        // Fetch all MBKM registrations with associated user information
        $pendaftaranMbkm = MbkmPendaftaran::with('user')->orderBy('created_at', 'desc')->get();

        return view('app.koordinator.tabel_mbkm', compact('pendaftaranMbkm'));
    }
    
    public function updateCatatanPendaftaran(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'catatan_koordinator' => 'required|string|max:1000',
        ]);

        // Find the MBKM registration or fail
        $pendaftaran = MbkmPendaftaran::findOrFail($id);

        // Update the Koordinator's comment
        $pendaftaran->catatan_koordinator = $request->input('catatan_koordinator');
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Catatan Koordinator berhasil diperbarui.');
    }

    /**
     * Update the status of a specific MBKM registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID of the MbkmPendaftaran entry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatusPendaftaran(Request $request, $id)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:Menunggu,Disetujui,Ditolak',
        ]);

        // Find the MBKM registration or fail
        $pendaftaran = MbkmPendaftaran::findOrFail($id);

        // Update the status
        $pendaftaran->status = $request->input('status');
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Status pendaftaran MBKM berhasil diperbarui.');
    }

    /**
     * Update the SKS for a specific MBKM registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  ID of the MbkmPendaftaran entry
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSksPendaftaran(Request $request, $id)
    {
        // Validate the SKS input
        $request->validate([
            'sks' => 'required|integer|min:1|max:24',
        ]);

        // Find the MBKM registration or fail
        $pendaftaran = MbkmPendaftaran::findOrFail($id);

        // Update the SKS
        $pendaftaran->sks_koordinator = $request->input('sks');
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Jumlah SKS berhasil diperbarui.');
    }
}
