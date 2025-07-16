<?php

namespace App\Http\Controllers;
use App\Models\Objection;
use App\Http\Resources\ObjectionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ObjectionDiresponMail;
use App\Mail\ObjectionDiresponMail2;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ObjectionController extends Controller
{
    public function index()
    {
        $objection = Objection::all();
        return ObjectionResource::collection($objection);
    }

public function store(Request $objection)
{
    $data = $objection->except('ktp_pemohon');

    if ($objection->hasFile('ktp_pemohon')) {
        $file = $objection->file('ktp_pemohon');
        $data['ktp_pemohon'] = file_get_contents($file->getRealPath());
    }

    $data['user_id'] = Auth::id();
    // Optional debug
    // dd($data);
    $objection = Objection::create($data);

    return redirect()->route('public.objections')->with('success', 'Data keberatan berhasil dikirim.');
}


    public function show(Objection $objection)
    {
        return new ObjectionResource($objection);
    }

    public function update(Request $request, $id)
    {
        $objection = Objection::findOrFail($id);
        $objection->update($request->all());
        return response()->json('Objection updated successfully');
    }
    public function destroy(Objection $objection)
    {
        $objection->delete();
        return redirect()->route('petugas-keberatan')->with('success', 'Data keberatan berhasil dihapus.');
    }
    public function showKTP($id)
    {
        // Find the objection by ID
        $objection = Objection::findOrFail($id);

        // Check if KTP data exists in database
        if (!$objection->ktp_pemohon) {
            abort(404, 'KTP tidak ditemukan');
        }

        // Since KTP is stored as BLOB, we can directly use the binary data
        $fileContent = $objection->ktp_pemohon;

        // Detect MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $fileContent);
        finfo_close($finfo);

        // If MIME type detection fails, default to image/jpeg
        if (!$mimeType || $mimeType === 'application/octet-stream') {
            $mimeType = 'image/jpeg';
        }

        // Return response with appropriate headers for image display
        return response($fileContent)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline');
    }
}

