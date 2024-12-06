<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelayakanKP;

class DoswalKPController extends Controller
{
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
}
