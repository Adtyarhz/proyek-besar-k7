<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanKP;

class KoordinatorKPController extends Controller
{
    public function viewTableInputKPKoordinator()
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }

        $kelayakanKPs = KelayakanKP::with('user')->get();
        return view('app.koordinator.tabelinput_kp', compact('kelayakanKPs'));
    }

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
}
