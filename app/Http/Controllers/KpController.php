<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelayakanKP;
use Illuminate\Support\Facades\Auth;

class KpController extends Controller
{
    public function informasi()
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        return view('app.mahasiswa.home_kp');
    }

    public function showFormKelayakanKP()
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        return view('app.mahasiswa.formkelayakan_kp');
    }

    public function storeFormKelayakanKP(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'nilai-ipk' => 'required|numeric|min:0|max:4',
            'total-sks' => 'required|integer|min:0',
            'sks-semester-6' => 'required|integer|min:0',
            'mata-kuliah-tidak_lulus' => 'required|string|max:255',
            'bukti-sks-ipk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('bukti-sks-ipk')) {
            $file = $request->file('bukti-sks-ipk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bukti_sks_ipk', $filename, 'public');
        }

        KelayakanKP::create([
            'user_id' => Auth::id(),
            'nilai_ipk' => $validated['nilai-ipk'],
            'total_sks' => $validated['total-sks'],
            'sks_semester6' => $validated['sks-semester-6'],
            'mata_kuliah_tidak_lulus' => $validated['mata-kuliah-tidak_lulus'],
            'bukti_sks_ipk' => $path ?? null,
            'status_kelayakan' => 'Menunggu',
        ]);

        return redirect()->route('kp.data_kelayakan')->with('success', 'Form Kelayakan KP berhasil disubmit.');
    }

    public function showDataKelayakan()
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }

        $dataKelayakan = KelayakanKP::where('user_id', Auth::id())->get();
        return view('app.mahasiswa.data_kelayakan', compact('dataKelayakan'));
    }
}
