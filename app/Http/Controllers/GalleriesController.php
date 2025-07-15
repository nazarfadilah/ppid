<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Galleries::all();
        return response()->json($galleries);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('file_path');
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $data['file_path'] = file_get_contents($file->getRealPath()); // simpan sebagai BLOB
        }
        $request = Galleries::create($data);
        return redirect()->route('petugas-galeri')->with('success', 'Data galeri berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galleries = Galleries::findOrFail($id);
        return response()->json($galleries);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galleries $gallery)
    {
       $gallery->update($request->all());
        return redirect()->route('petugas-galeri')->with('success', 'Data galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Galleries::findOrFail($id);
        $gallery->delete();
        return redirect()->route('petugas-galeri')->with('success', 'Data galeri berhasil dihapus.');
    }
    public function showFile(){
        $galleries = Galleries::all();
        return view('admin.Gallery.index', compact('galleries'));
    }

    public function showBlob($id)
    {
        $gallery = Galleries::findOrFail($id);

        // Check if file_path data exists in database
        if (empty($gallery->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        // Since file_path is stored as BLOB, we can directly use the binary data
        $binary = $gallery->file_path;

        // Detect MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $binary);
        finfo_close($finfo);

        // If MIME type detection fails, default to image/jpeg
        if (!$mimeType || $mimeType === 'application/octet-stream') {
            // If MIME type detection fails, use generic binary type
            $mimeType = 'application/octet-stream';
        }

        return response($binary)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="file_' . $gallery->id . '.' . explode('/', $mimeType)[1] . '"');
    }
}
