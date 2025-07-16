@extends('public.layout.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Detail Permohonan Informasi Publik</h3>
    </div>

    <div class="container-fluid">
        <a href="{{ route('public.information-requests') }}" class="btn btn-secondary mb-3">Kembali ke Daftar</a>

        <div class="card">
            <div class="card-body">
                <form>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" value="{{ $request->id }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori Permohonan</label>
                        <input type="text" class="form-control" value="{{ ucfirst($request->request_category) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pemohon</label>
                        <input type="text" class="form-control" value="{{ $request->nama_pemohon }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control" value="{{ $request->nik }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" class="form-control" value="{{ $request->no_hp }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" value="{{ $request->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Informasi Terkait</label>
                        <input type="text" class="form-control" value="{{ $request->informasi_terkait }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alasan Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->alasan_informasi }}" readonly>
                    </div>
                    <hr>
                    <h5>Pengguna Informasi</h5>
                    <div class="mb-3">
                        <label class="form-label">Nama Pengguna Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->nama_pengguna_informasi }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIK Pengguna Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->nik_pengguna_informasi }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Pengguna Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->alamat_pengguna_informasi }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP Pengguna Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->no_hp_pengguna_informasi }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Pengguna Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->email_pengguna_informasi }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alasan Pengguna Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->alasan_pengguna_informasi }}" readonly>
                    </div>
                    <hr>
                    <h5>Informasi Tambahan</h5>
                    <div class="mb-3">
                        <label class="form-label">Cara Mendapatkan Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->cara_mendapatkan_informasi }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cara Mendapatkan Informasi Lainnya</label>
                        <input type="text" class="form-control" value="{{ $request->cara_mendapatkan_informasi_lainnya }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Format</label>
                        <input type="text" class="form-control" value="{{ $request->formats }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Format Lainnya</label>
                        <input type="text" class="form-control" value="{{ $request->format_lainnya }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pengiriman Informasi</label>
                        <input type="text" class="form-control" value="{{ $request->pengiriman_informasi }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pengiriman Informasi Lainnya</label>
                        <input type="text" class="form-control" value="{{ $request->pengiriman_informasi_lainnya }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Scan KTP</label>
                        @if($request->ktp)
                            <div>
                                <a href="{{ route('public-informasi.ktp', ['id' => $request->id]) }}" target="_blank" class="btn btn-sm btn-primary">Lihat Scan KTP</a>
                            </div>
                        @else
                            <span class="badge bg-secondary">Tidak ada file</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{ ucfirst($request->status) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alasan Penolakan</label>
                        <textarea class="form-control" rows="2" readonly>{{ $request->reject_reason }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Permohonan</label>
                        <input type="text" class="form-control" value="{{ $request->created_at ? $request->created_at->format('d-m-Y H:i') : '' }}" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
