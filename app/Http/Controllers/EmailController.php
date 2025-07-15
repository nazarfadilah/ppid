<?php

namespace App\Http\Controllers;
use App\Models\Objection;
use App\Http\Resources\ObjectionResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\ObjectionDiresponMail;
use App\Mail\ObjectionDiresponMail2;
use App\Models\PublicInformationRequest;
use App\Http\Resources\PublicInformationRequestResource;
use Illuminate\Support\Facades\Auth;
use App\Mail\StatusPermohonanMail;
use App\Models\Whistle;
use App\Http\Resources\WhistleResource;
use App\Mail\WhistleConfirmedMail;
use App\Mail\WhistleRejectedMail;
use App\Mail\WhistleFinishedMail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function ObjectionConfirmed(Request $request, $id)
    {
        // 1. Cari data keberatan berdasarkan ID
        $obj = Objection::findOrFail($id);

        // 2. Ambil alasan dari form input
        $reason = $request->input('reject_reason');

        // 3. Update status dan alasan di database
        $obj->status = 'Approved';
        $obj->reject_reason = $reason; // Simpan alasan persetujuan
        $obj->save();

        // 4. Kirim email dengan menyertakan data keberatan dan alasannya
        Mail::to($obj->email_pemohon)->send(new ObjectionDiresponMail($obj, $reason));

        // 5. Redirect kembali dengan notifikasi sukses
        return redirect()->route('petugas-keberatan')->with('success', 'Status keberatan berhasil diubah menjadi Approved.');
    }

    public function ObjectionRejected(Request $request, $id)
    {
        // 1. Cari data keberatan berdasarkan ID
        $obj = Objection::findOrFail($id);

        // 2. Ambil alasan dari form input
        $reason = $request->input('reject_reason');

        // 3. Update status dan alasan di database
        $obj->status = 'Rejected';
        $obj->reject_reason = $reason; // Simpan alasan penolakan
        $obj->save();

        // 4. Kirim email dengan menyertakan data keberatan dan alasannya
        Mail::to($obj->email_pemohon)->send(new ObjectionDiresponMail2($obj, $reason));

        // 5. Redirect kembali dengan notifikasi sukses
        return redirect()->route('petugas-keberatan')->with('success', 'Status keberatan berhasil diubah menjadi Rejected.');
    }

    public function whistleConfirmed(Request $request, $id)
    {
        $whistle = Whistle::findOrFail($id);
        $alasan = $request->input('alasan'); // 1. Ambil alasan dari form

        // 2. Update status dan alasan di database
        $whistle->status = 'confirmed';
        $whistle->alasan = $alasan;
        $whistle->save();

        // 3. Kirim email dengan menyertakan objek whistle dan alasannya
        Mail::to($whistle->email)->send(new WhistleConfirmedMail($whistle, $alasan));

        return redirect()->route('petugas-whistle-bowling')->with('success', 'Laporan berhasil dikonfirmasi.');
    }

    public function whistleFinished(Request $request, $id)
    {
        $whistle = Whistle::findOrFail($id);
        $alasan = $request->input('alasan'); // 1. Ambil alasan dari form

        // 2. Update status dan alasan di database
        $whistle->status = 'finished';
        $whistle->alasan = $alasan;
        $whistle->save();

        // 3. Kirim email dengan menyertakan objek whistle dan alasannya
        Mail::to($whistle->email)->send(new WhistleFinishedMail($whistle, $alasan));

        return redirect()->route('petugas-whistle-bowling')->with('success', 'Laporan berhasil diselesaikan.');
    }

    public function whistleRejected(Request $request, $id)
    {
        $whistle = Whistle::findOrFail($id);
        $alasan = $request->input('alasan'); // 1. Ambil alasan dari form

        // 2. Update status dan alasan di database
        $whistle->status = 'rejected';
        $whistle->alasan = $alasan;
        $whistle->save();

        // 3. Kirim email dengan menyertakan objek whistle dan alasannya
        Mail::to($whistle->email)->send(new WhistleRejectedMail($whistle, $alasan));

        return redirect()->route('petugas-whistle-bowling')->with('success', 'Laporan berhasil ditolak.');
    }

    public function approveRequest(Request $request, $id)
    {
        $data = PublicInformationRequest::findOrFail($id);

        // Validasi file lampiran
        $request->validate([
            'lampiran' => 'required|file|max:2048',
            'reject_reason' => 'required|string', // Tambahkan validasi untuk alasan
        ]);
        // 1. Ambil alasan dari form
        $reason = $request->input('reject_reason');

        // 2. Update status dan alasan di database
        $data->status = 'Approved';
        $data->reject_reason = $reason;
        $data->save();

        // Ambil data untuk email
        $pemohonNama = $data->nama_pemohon;
        $pemohonEmail = $data->email;
        $informasi = $data->informasi_terkait;

        // 3. Buat pesan email yang menyertakan alasan
        $pesan = "Halo {$pemohonNama},\n\nPermohonan informasi Anda terkait \"{$informasi}\" telah disetujui.\n\nCatatan dari kami:\n{$reason}\n\nSilakan lihat file terlampir.";

        // Ambil file lampiran dari request
        $lampiran = $request->file('lampiran');

        // Kirim email ke pemohon (dan pengguna informasi jika perlu)
        Mail::to($pemohonEmail)->send(
            (new StatusPermohonanMail($pesan))
                ->attach($lampiran->getRealPath(), [
                    'as' => $lampiran->getClientOriginalName(),
                    'mime' => $lampiran->getClientMimeType(),
                ])
        );
        // Jika email pengguna informasi berbeda dan perlu dikirim juga, ulangi proses Mail::send di sini.

        return redirect()->route('petugas-informasi')->with('success', 'Permohonan disetujui dan email telah dikirim.');
    }


    public function rejectRequest(Request $request, $id)
    {
        $data = PublicInformationRequest::findOrFail($id);

        // Tambahkan validasi untuk alasan
        $request->validate([
            'reject_reason' => 'required|string',
        ]);

        // 1. Ambil alasan penolakan dari form
        $reason = $request->input('reject_reason');

        // 2. Update status dan alasan di database
        $data->status = 'Rejected';
        $data->reject_reason = $reason;
        $data->save();

        // Ambil data untuk email
        $pemohonNama = $data->nama_pemohon;
        $pemohonEmail = $data->email;
        $informasi = $data->informasi_terkait;

        // 3. Buat pesan email yang menyertakan alasan penolakan
        $pesan = "Halo {$pemohonNama},\n\nMohon maaf, permohonan informasi Anda terkait \"{$informasi}\" telah ditolak.\n\nAlasan penolakan:\n{$reason}";

        // Kirim email ke pemohon (dan pengguna informasi jika perlu)
        Mail::to($pemohonEmail)->send(new StatusPermohonanMail($pesan));

        return redirect()->route('petugas-informasi')->with('success', 'Permohonan ditolak dan email telah dikirim.');
    }
}
