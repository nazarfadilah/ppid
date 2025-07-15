<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $reports = Report::all();
        return response()->json($reports);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $report = Report::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        return response()->json($report, 201);
    }

    // Tampilkan data berdasarkan id
    public function show(string $id)
    {
        $report = Report::findOrFail($id);
        return response()->json($report);
    }

    // Update data berdasarkan id
    public function update(Request $request, string $id)
    {
        $report = Report::findOrFail($id);

        $report->update([
            'title' => $request->input('title', $report->title),
            'content' => $request->input('content', $report->content),
        ]);
        return response()->json($report);
    }

    // Hapus data berdasarkan id
    public function destroy(string $id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return response()->json(['message' => 'Report deleted successfully']);
    }
}
