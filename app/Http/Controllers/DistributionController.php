<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    // Menampilkan data persebaran
    public function indexDistributions()
    {
        // Retrieve all distributions
        $distributions = Distribution::all();
        return view('app.admin.chartpersebaran', compact('distributions'));
    }

    // Menyimpan data baru
    public function storeDistribution(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'region' => 'required|string',
            'students' => 'required|integer',
            'year' => 'required|integer',
        ]);

        Distribution::create($validated);

        return redirect()->route('distributions.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Memperbarui data
    public function updateDistribution(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'region' => 'required|string',
            'students' => 'required|integer',
            'year' => 'required|integer',
        ]);

        $distribution = Distribution::findOrFail($id);
        $distribution->update($validated);

        return redirect()->route('distributions.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Menghapus data
    public function destroyDistribution($id)
    {
        $distribution = Distribution::findOrFail($id);
        $distribution->delete();

        return redirect()->route('distributions.index')->with('success', 'Data berhasil dihapus.');
    }
}
