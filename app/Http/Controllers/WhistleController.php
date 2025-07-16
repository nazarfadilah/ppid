<?php

namespace App\Http\Controllers;

use App\Http\Resources\WhistleResource;
use App\Models\Whistle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WhistleConfirmedMail;
use App\Mail\WhistleFinishedMail;
use App\Mail\WhistleRejectedMail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class WhistleController extends Controller
{
    // Khusus route pengguna
    public function store(Request $whistle)
{
    $data = $whistle->except('foto_bukti');
    if ($whistle->hasFile('foto_bukti')) {
        $file = $whistle->file('foto_bukti');
        $data['foto_bukti'] = file_get_contents($file->getRealPath()); // simpan sebagai BLOB
    }

    $data['user_id'] = Auth::user()->id;
    $whistle = Whistle::create($data);

    return redirect()->route('public.index')->with('success', 'Data keberatan berhasil dikirim.');
}


    // Tampilkan semua data
    public function index()
    {
        $whistles = Whistle::all();
        return response()->json($whistles);
    }


    // Tampilkan data berdasarkan id
    public function show($id)
    {
        $whistle = Whistle::findOrFail($id);
        return new WhistleResource($whistle);
    }

    // Update data berdasarkan id tanpa validasi
    public function update(Request $request, $id)
    {
        $whistle = Whistle::findOrFail($id);
        $whistle->update($request->all());
    }

    // Hapus data berdasarkan id
    public function destroy($id)
    {
        $whistle = Whistle::findOrFail($id);
        $whistle->delete();
        return redirect()->route('petugas-whistle-bowling')->with('success', 'Data berhasil dihapus.');
    }
    public function showImage($id)
    {
        // 1. Cari data whistle berdasarkan ID, jika tidak ketemu akan error 404
        $whistle = Whistle::findOrFail($id);

        // 2. Cek apakah kolom foto_bukti ada isinya
        if (!$whistle->foto_bukti) {
            // Jika tidak ada data foto bukti, kembalikan error 404
            abort(404, 'Foto bukti tidak ditemukan.');
        }

        // 3. Ambil data biner foto bukti dari kolom
        $fotoBuktiData = $whistle->foto_bukti;

        // 4. Deteksi tipe MIME dari data biner
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_buffer($finfo, $fotoBuktiData);
        finfo_close($finfo);

        // 5. Handle berbagai jenis file
        $supportedMimes = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 
            'image/tiff', 'image/svg+xml', 'application/pdf'
        ];

        // Jika deteksi MIME gagal atau tidak didukung, coba tentukan dari data
        if (!$mimeType || !in_array($mimeType, $supportedMimes)) {
            // Deteksi berdasarkan signature file
            if (substr($fotoBuktiData, 0, 4) === "\x25\x50\x44\x46") { // %PDF
                $mimeType = 'application/pdf';
            } elseif (substr($fotoBuktiData, 0, 2) === "\xFF\xD8") {
                $mimeType = 'image/jpeg';
            } elseif (substr($fotoBuktiData, 0, 8) === "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A") {
                $mimeType = 'image/png';
            } elseif (substr($fotoBuktiData, 0, 6) === "\x47\x49\x46\x38\x37\x61" || 
                     substr($fotoBuktiData, 0, 6) === "\x47\x49\x46\x38\x39\x61") {
                $mimeType = 'image/gif';
            } else {
                $mimeType = 'application/octet-stream';
            }
        }

        // 6. Buat respons HTTP dengan data foto bukti dan header yang sesuai
        return response($fotoBuktiData)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline');
    }
}
