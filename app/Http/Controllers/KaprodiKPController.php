<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanKP;

class KaprodiKPController extends Controller
{
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
}
