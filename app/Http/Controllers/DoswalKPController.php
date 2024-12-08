<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanKP;
use App\Models\PendaftaranKP;

class DoswalKPController extends Controller
{
    // Pertimbangan KP - View and update catatan_doswal on KelayakanKP
    public function viewTableInputKPDoswal()
    {
        $user = Auth::user();
        if ($user->role !== 'Doswal') {
            abort(403, 'Unauthorized action.');
        }

        $kelayakanKPs = KelayakanKP::with('user')->get();
        return view('app.doswal.tabelinput_kp', compact('kelayakanKPs'));
    }

    public function updateCatatanDoswal(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Doswal') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'catatan' => 'required|string',
        ]);

        $kelayakanKP = KelayakanKP::findOrFail($id);
        $kelayakanKP->catatan_doswal = $validated['catatan'];
        $kelayakanKP->save();

        return redirect()->route('doswal.tabelinputkp')->with('success', 'Catatan berhasil diperbarui.');
    }

    // Eligible KP - View and Update catatan_doswal_eligible on PendaftaranKP
    public function viewEligibleKPDoswal()
    {
        $user = Auth::user();
        if ($user->role !== 'Doswal') {
            abort(403, 'Unauthorized action.');
        }

        $pendaftaranKPs = PendaftaranKP::with('user')->orderBy('created_at', 'desc')->get();
        return view('app.doswal.table_kp', compact('pendaftaranKPs'));
    }

    public function updateEligibleCatatanDoswal(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Doswal') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'catatan_doswal_eligible' => 'required|string',
        ]);

        $p = PendaftaranKP::findOrFail($id);
        $p->catatan_doswal_eligible = $request->catatan_doswal_eligible;
        $p->save();

        return redirect()->back()->with('success', 'Catatan Dosen Wali (Eligible) berhasil diperbarui.');
    }
}

