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
        Galleries::create($request->all());
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
    $data = $request->except('file_path', 'link');

    if ($request->type === 'link') {
        // Simpan link jika tipe adalah "link"
        $data['link'] = $request->input('link');
        $data['file_path'] = null;
    } else {
        // Simpan file jika tipe adalah selain "link"
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $data['file_path'] = file_get_contents($file->getRealPath());
        }
        $data['link'] = null;
    }

    $gallery->update($data);

    // return redirect()->route('petugas-galeri')->with('success', 'Data galeri berhasil diperbarui.');
    return response()->json('Gallery updated successfully');
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
        $gallery = Gallery::findOrFail($id);

        if (empty($gallery->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $binary = $gallery->file_path;

        // Deteksi MIME type otomatis dari BLOB
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($binary);

        return response($binary)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline');
    }
}
