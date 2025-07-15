@extends('petugas.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Edit Keberatan</h3>
    </div>

    <div class="container-fluid">
        <form action="{{ route('objection.update', $objection->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Pemohon</label>
                <input type="text" name="nama_pemohon" value="{{ $objection->nama_pemohon }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Alamat Pemohon</label>
                <input type="text" name="alamat_pemohon" value="{{ $objection->alamat_pemohon }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Pekerjaan Pemohon</label>
                <input type="text" name="pekerjaan_pemohon" value="{{ $objection->pekerjaan_pemohon }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>No HP Pemohon</label>
                <input type="text" name="no_hp_pemohon" value="{{ $objection->no_hp_pemohon }}" class="form-control" maxlength="15" required>
            </div>
            <div class="mb-3">
                <label>Email Pemohon</label>
                <input type="email" name="email_pemohon" value="{{ $objection->email_pemohon }}" class="form-control" required>
            </div>
            <hr>
            <h5>Identitas Kuasa Pemohon (Opsional)</h5>
            <div class="mb-3">
                <label>Nama Kuasa Pemohon</label>
                <input type="text" name="nama_kuasa_pemohon" value="{{ $objection->nama_kuasa_pemohon }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>Alamat Kuasa Pemohon</label>
                <input type="text" name="alamat_kuasa_pemohon" value="{{ $objection->alamat_kuasa_pemohon }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>No HP Kuasa Pemohon</label>
                <input type="text" name="no_hp_kuasa_pemohon" value="{{ $objection->no_hp_kuasa_pemohon }}" class="form-control" maxlength="15">
            </div>
            <hr>
            <div class="mb-3">
                <label>Alasan Pengajuan</label>
                <input type="text" name="alasan_pengajuan" value="{{ $objection->alasan_pengajuan }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kasus Posisi</label>
                <input type="text" name="kasus_posisi" value="{{ $objection->kasus_posisi }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Unggah KTP Pemohon (jika ingin ganti)</label>
                <input type="file" name="ktp_pemohon" class="form-control">
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Approved" {{ $objection->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Rejected" {{ $objection->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="Checking" {{ $objection->status == 'Checking' ? 'selected' : '' }}>Checking</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Alasan Penolakan (jika status Rejected)</label>
                <textarea name="reject_reason" class="form-control">{{ $objection->reject_reason }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('petugas-keberatan') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
