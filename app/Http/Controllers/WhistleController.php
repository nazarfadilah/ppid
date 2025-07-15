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


class WhistleController extends Controller
{
    // Khusus route pengguna
    public function store(Request $request)
    {
        $data = $request->except('foto_bukti');
        if ($request->hasFile('foto_bukti')) {
            $file = $request->file('foto_bukti');
            $data['foto_bukti'] = file_get_contents($file->getRealPath()); // simpan sebagai BLOB
        }
        $objection = Whistle::create($data);
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
    public function showFotoBukti($id)
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

        // 5. Jika deteksi MIME gagal, gunakan default image/jpeg
        if (!$mimeType || $mimeType === 'application/octet-stream') {
            $mimeType = 'image/jpeg';
        }

        // 6. Buat respons HTTP dengan data foto bukti dan header yang sesuai
        return response($fotoBuktiData)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline');
    }
}
