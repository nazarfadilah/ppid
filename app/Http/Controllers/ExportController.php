<?php

namespace App\Http\Controllers;
use App\Models\Objection;
use App\Models\PublicInformationRequest;
use App\Models\Whistle;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PublicInformationExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $requests)
    {
        $format = $requests->input('format');
        $year = $requests->input('year');
        $requests = PublicInformationRequest::whereYear('created_at', $year)->get();
        switch ($format) {
            case 'excel':
                return Excel::download(new PublicInformationExport($requests), 'permohonan_informasi_' . $year . '.xlsx');
            case 'pdf':
                $pdf = PDF::loadView('admin.exports.public_information_pdf', compact('requests', 'year'));
                return $pdf->download('permohonan_informasi_' . $year . '.pdf');
            case 'word':
                return response()->view('admin.exports.public_information_word', compact('requests', 'year'))
                    ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                    ->header('Content-Disposition', 'attachment; filename="permohonan_informasi_' . $year . '.docx"');
            case 'png':
                $image = View::make('admin.exports.public_information_png', compact('requests', 'year'))->render();
                // kamu bisa gunakan dompdf + spatie/pdf-to-image untuk generate png dari pdf jika perlu
                return response($image); // untuk development
            default:
                return back()->with('error', 'Format tidak valid!');
        }
    }
    public function exportObjection(Request $request)
    {
        $format = $request->input('format');
        $year = $request->input('year');
        $objections = Objection::whereYear('created_at', $year)->get();

        switch ($format) {
            case 'excel':
                return Excel::download(new \App\Exports\ObjectionExport($objections), 'data_keberatan_' . $year . '.xlsx');
            case 'pdf':
                $pdf = PDF::loadView('admin.exports.objection_pdf', compact('objections', 'year'));
                return $pdf->download('data_keberatan_' . $year . '.pdf');
            case 'word':
                return response()->view('admin.exports.objection_word', compact('objections', 'year'))
                    ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                    ->header('Content-Disposition', 'attachment; filename="data_keberatan_' . $year . '.docx"');
            case 'png':
                $html = View::make('admin.exports.objection_png', compact('objections', 'year'))->render();
                return response($html); // Untuk preview PNG dari HTML, jika perlu bisa diubah ke image
            default:
                return back()->with('error', 'Format tidak valid!');
        }
    }
    public function exportWhistle(Request $request)
    {
        $format = $request->input('format');
        $year = $request->input('year');
        $whistles = Whistle::whereYear('created_at', $year)->get();
        switch ($format) {
            case 'excel':
                return Excel::download(new \App\Exports\WhistleExport($whistles), 'data_pengaduan_' . $year . '.xlsx');
            case 'pdf':
                $pdf = PDF::loadView('admin.exports.whistle_pdf', compact('whistles', 'year'));
                return $pdf->download('data_pengaduan_' . $year . '.pdf');
            case 'word':
                return response()->view('admin.exports.whistle_word', compact('whistles', 'year'))
                    ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                    ->header('Content-Disposition', 'attachment; filename="data_pengaduan_' . $year . '.docx"');
            case 'png':
                $html = View::make('admin.exports.whistle_png', compact('whistles', 'year'))->render();
                return response($html); // Untuk preview PNG dari HTML, jika perlu bisa diubah ke image
            default:
                return back()->with('error', 'Format tidak valid!');
        }
    }

    private function exportToCsv(array $filters)
    {
        // Implement CSV export logic here
    }

    private function exportToXlsx(array $filters)
    {
        // Implement XLSX export logic here
    }
}


