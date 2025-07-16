@extends('public.layout.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Tambah Keberatan Informasi Publik</h3>
    </div>

    <div class="container-fluid">
        <form action="{{ route('objections-create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- ambil user id yang login saat ini dan formnya ngak usah ditampilkan --}}
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <h5>Pemohon</h5>
            <div class="mb-3">
                <label>Nama Pemohon</label>
                <input type="text" name="nama_pemohon" class="form-control" maxlength="50" required>
            </div>
            <div class="mb-3">
                <label>Alamat Pemohon</label>
                <textarea name="alamat_pemohon" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Pekerjaan Pemohon</label>
                <input type="text" name="pekerjaan_pemohon" class="form-control" maxlength="100" required>
            </div>
            <div class="mb-3">
                <label>No HP Pemohon</label>
                <input type="text" id="no_hp_pemohon" name="no_hp_pemohon" class="form-control" maxlength="15" minlength="10" required>
            </div>
            <script>
                document.getElementById('no_hp_pemohon').addEventListener('input', function (e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
                document.getElementById('no_hp_pemohon').addEventListener('blur', function (e) {
                    if (this.value.length < 10 || this.value.length > 15) {
                        this.setCustomValidity('No HP harus antara 10-15 digit');
                        this.reportValidity();
                    } else {
                        this.setCustomValidity('');
                    }
                });
            </script>
            <div class="mb-3">
                <label>Email Pemohon</label>
                <input type="email" name="email_pemohon" class="form-control" required>
            </div>

            <hr>
            <h5>Identitas Kuasa Pemohon (Opsional)</h5>
            <div class="mb-3">
                <label>Nama Kuasa Pemohon</label>
                <input type="text" name="nama_kuasa_pemohon" class="form-control" maxlength="64">
            </div>
            <div class="mb-3">
                <label>Alamat Kuasa Pemohon</label>
                <textarea name="alamat_kuasa_pemohon" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>No HP Kuasa Pemohon</label>
                <input type="text" id="no_hp_kuasa_pemohon" name="no_hp_kuasa_pemohon" class="form-control" maxlength="15" minlength="10" required>
            </div>
            <script>
                document.getElementById('no_hp_kuasa_pemohon').addEventListener('input', function (e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
                document.getElementById('no_hp_kuasa_pemohon').addEventListener('blur', function (e) {
                    if (this.value.length < 10 || this.value.length > 15) {
                        this.setCustomValidity('No HP harus antara 10-15 digit');
                        this.reportValidity();
                    } else {
                        this.setCustomValidity('');
                    }
                });

            </script>
            <div class="mb-3">
                <label>Alasan Pengajuan Keberatan</label>
                <textarea name="alasan_pengajuan" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Kasus Posisi</label>
                <textarea name="kasus_posisi" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Unggah KTP Pemohon</label>
                <input type="file" name="ktp_pemohon" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('public.objections') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
