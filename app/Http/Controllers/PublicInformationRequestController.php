<?php

namespace App\Http\Controllers;

use App\Models\PublicInformationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\StatusPermohonanMail;
use App\Http\Resources\PublicInformationRequestResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


class PublicInformationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = PublicInformationRequest::all();
        return response()->json($requests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('ktp');
        if ($request->hasFile('ktp')) {
            $file = $request->file('ktp');
            $data['ktp'] = file_get_contents($file->getRealPath()); // simpan sebagai BLOB
        }
        $data['user_id'] = Auth::user()->id; // Set user_id from authenticated user
        $publicRequest = PublicInformationRequest::create($data);
        if ($publicRequest) {
            return redirect()->route('public.information-requests')->with('success', 'Data keberatan berhasil dikirim.');
        } else {
            return redirect()->route('public.information-requests')->with('error', 'Data keberatan gagal dikirim.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = PublicInformationRequest::findOrFail($id);
        return response()->json($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publicRequest = PublicInformationRequest::findOrFail($id);
        $publicRequest->update($request->all());
        return response()->json('Request updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $request = PublicInformationRequest::findOrFail($id);
        $request->delete();
        return redirect()->route('petugas-informasi')->with('success', 'Data berhasil dihapus.');
    }
    public function showKTP($id)
    {
        // Find the public information request
        $request = PublicInformationRequest::findOrFail($id);

        // Check if KTP data exists in database
        if (!$request->ktp) {
            abort(404, 'KTP tidak ditemukan');
        }

        // Since KTP is stored as BLOB, we can directly use the binary data
        $fileContent = $request->ktp;

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
