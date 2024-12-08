<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanKP;
use App\Models\PendaftaranKP;

class KoordinatorKPController extends Controller
{
    /**
     * View table input KP (Pertimbangan KP) for Koordinator.
     */
    public function viewTableInputKPKoordinator()
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }

        $kelayakanKPs = KelayakanKP::with('user')->get();
        return view('app.koordinator.tabelinput_kp', compact('kelayakanKPs'));
    }

    /**
     * Update catatan_koordinator on KelayakanKP (Pertimbangan KP).
     */
    public function updateCatatanKoordinator(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'catatan' => 'required|string',
        ]);

        $kelayakanKP = KelayakanKP::findOrFail($id);
        $kelayakanKP->catatan_koordinator = $validated['catatan'];
        $kelayakanKP->save();

        return redirect()->route('koordinator.tabelinputkp')->with('success', 'Catatan berhasil diperbarui.');
    }

    /**
     * Update status_kelayakan on KelayakanKP (Pertimbangan KP).
     * Status can be: Menunggu -> Disetujui or Ditolak.
     * Koordinator can toggle between these states.
     */
    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        $kelayakanKP = KelayakanKP::findOrFail($id);
        $kelayakanKP->status_kelayakan = $validated['status'];
        $kelayakanKP->save();

        return redirect()->route('koordinator.tabelinputkp')->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * View Table Eligible KP for Koordinator.
     */
    public function viewEligibleKP()
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }

        // Fetch data from pendaftaran_kp table (Eligible KP)
        $pendaftaranKPs = PendaftaranKP::with('user')->orderBy('created_at', 'desc')->get();

        return view('app.koordinator.table_kp', compact('pendaftaranKPs'));
    }

    /**
     * Update catatan_koordinator_eligible on PendaftaranKP.
     */
    public function updateEligibleCatatanKoordinator(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'catatan_koordinator_eligible' => 'required|string',
        ]);

        $p = PendaftaranKP::findOrFail($id);
        $p->catatan_koordinator_eligible = $request->catatan_koordinator_eligible;
        $p->save();

        return redirect()->route('koordinator.tableeligiblekp')->with('success', 'Catatan Koordinator berhasil diperbarui.');
    }

    /**
     * Update status_pendaftaran on PendaftaranKP (Eligible KP).
     * Status: Menunggu -> Disetujui or Ditolak, and can toggle back.
     */
    public function updateEligibleStatus(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        $p = PendaftaranKP::findOrFail($id);
        $p->status_pendaftaran = $request->status;
        $p->save();

        return redirect()->route('koordinator.tableeligiblekp')->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Update sks_koordinator on PendaftaranKP (Eligible KP).
     */
    public function updateSksKoordinator(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'sks_koordinator' => 'required|integer|min:0',
        ]);

        $p = PendaftaranKP::findOrFail($id);
        $p->sks_koordinator = $request->sks_koordinator;
        $p->save();

        return redirect()->route('koordinator.tableeligiblekp')->with('success', 'SKS berhasil diperbarui.');
    }
    public function tabelinput_mbkm()
    {
        // Fetch all KelayakanMBKM records with related User data
        $kelayakanMBKMs = KelayakanMBKM::with('user')->get();

        // Pass the data to the view
        return view('tableinput_mbkm', compact('kelayakanMBKMs'));
    }
}

