@extends('admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Edit Permohonan Informasi Publik</h3>
    </div>

    <div class="container-fluid">
        <form action="{{ route('public-information.update.edit', $request->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Kategori Permohonan</label>
                <select name="request_category" class="form-control" required>
                    <option value="individual" {{ $request->request_category == 'individual' ? 'selected' : '' }}>Individu</option>
                    <option value="organization" {{ $request->request_category == 'organization' ? 'selected' : '' }}>Organisasi</option>
                    <option value="group" {{ $request->request_category == 'group' ? 'selected' : '' }}>Kelompok</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Nama Pemohon</label>
                <input type="text" name="nama_pemohon" value="{{ $request->nama_pemohon }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>NIK Pemohon</label>
                <input type="text" name="nik" value="{{ $request->nik }}" class="form-control" maxlength="16" required>
            </div>

            <div class="mb-3">
                <label>No HP Pemohon</label>
                <input type="text" name="no_hp" value="{{ $request->no_hp }}" class="form-control" maxlength="15" required>
            </div>

            <div class="mb-3">
                <label>Email Pemohon</label>
                <input type="email" name="email" value="{{ $request->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Informasi Terkait</label>
                <input type="text" name="informasi_terkait" value="{{ $request->informasi_terkait }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alasan Permohonan Informasi</label>
                <input type="text" name="alasan_informasi" value="{{ $request->alasan_informasi }}" class="form-control" required>
            </div>

            <hr>
            <h5>Pengguna Informasi</h5>
            <div class="mb-3">
                <label>Nama Pengguna Informasi</label>
                <input type="text" name="nama_pengguna_informasi" value="{{ $request->nama_pengguna_informasi }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>NIK Pengguna Informasi</label>
                <input type="text" name="nik_pengguna_informasi" value="{{ $request->nik_pengguna_informasi }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Alamat Pengguna Informasi</label>
                <input type="text" name="alamat_pengguna_informasi" value="{{ $request->alamat_pengguna_informasi }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>No HP Pengguna Informasi</label>
                <input type="text" name="no_hp_pengguna_informasi" value="{{ $request->no_hp_pengguna_informasi }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email Pengguna Informasi</label>
                <input type="email" name="email_pengguna_informasi" value="{{ $request->email_pengguna_informasi }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Alasan Pengguna Informasi</label>
                <input type="text" name="alasan_pengguna_informasi" value="{{ $request->alasan_pengguna_informasi }}" class="form-control" required>
            </div>

            <hr>
            <h5>Informasi Tambahan</h5>
            <div class="mb-3">
                <label>Cara Mendapatkan Informasi</label>
                <input type="text" name="cara_mendapatkan_informasi" value="{{ $request->cara_mendapatkan_informasi }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>Cara Mendapatkan Informasi Lainnya</label>
                <input type="text" name="cara_mendapatkan_informasi_lainnya" value="{{ $request->cara_mendapatkan_informasi_lainnya }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>Format</label>
                <input type="text" name="formats" value="{{ $request->formats }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>Format Lainnya</label>
                <input type="text" name="format_lainnya" value="{{ $request->format_lainnya }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>Pengiriman Informasi</label>
                <input type="text" name="pengiriman_informasi" value="{{ $request->pengiriman_informasi }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>Pengiriman Informasi Lainnya</label>
                <input type="text" name="pengiriman_informasi_lainnya" value="{{ $request->pengiriman_informasi_lainnya }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Unggah KTP (jika ingin ganti)</label>
                <input type="file" name="ktp" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('request-index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
