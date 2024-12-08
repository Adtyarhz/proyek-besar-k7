<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanKP;
use App\Models\PendaftaranKP;

class KaprodiKPController extends Controller
{
    // Pertimbangan KP
    public function viewTableInputKPKaprodi()
    {
        $user = Auth::user();
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Unauthorized action.');
        }

        $kelayakanKPs = KelayakanKP::with('user')->get();
        return view('app.kaprodi.tabelinput_kp', compact('kelayakanKPs'));
    }

    public function updateCatatanKaprodi(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'catatan' => 'required|string',
        ]);

        $kelayakanKP = KelayakanKP::findOrFail($id);
        $kelayakanKP->catatan_kaprodi = $validated['catatan'];
        $kelayakanKP->save();

        return redirect()->route('kaprodi.tabelinputkp')->with('success', 'Catatan berhasil diperbarui.');
    }

    // Eligible KP (Catatan Kaprodi)
    public function viewEligibleKPKaprodi()
    {
        $user = Auth::user();
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Unauthorized action.');
        }

        $pendaftaranKPs = PendaftaranKP::with('user')->orderBy('created_at', 'desc')->get();
        return view('app.kaprodi.table_kp', compact('pendaftaranKPs'));
    }

    public function updateEligibleCatatanKaprodi(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'catatan_kaprodi_eligible' => 'required|string',
        ]);

        $p = PendaftaranKP::findOrFail($id);
        $p->catatan_kaprodi_eligible = $request->catatan_kaprodi_eligible;
        $p->save();

        return redirect()->back()->with('success', 'Catatan Kaprodi (Eligible) berhasil diperbarui.');
    }
}
