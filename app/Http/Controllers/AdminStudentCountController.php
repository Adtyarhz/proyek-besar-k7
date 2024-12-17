<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentCount;

class AdminStudentCountController extends Controller
{
    public function indexCount()
    {
        // Retrieve all student counts
        $counts = StudentCount::all();
        return view('app.admin.count', compact('counts'));
    }

    public function storeCount(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2001|unique:student_counts,year',
            'count' => 'required|integer',
        ]);

        StudentCount::create($validated);

        return redirect()->route('admin.studentcount.index')->with('success', 'Success');
    }

    public function updateCount(Request $request, $id)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2001|unique:student_counts,year,' . $id,
            'count' => 'required|integer|min:1',
        ]);

        $counts = StudentCount::findOrFail($id);
        $counts->update($validated);

        return redirect()->route('admin.studentcount.index')->with('success', 'Success');
    }
}