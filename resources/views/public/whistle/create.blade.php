@extends('public.layout.layout')

@section('content')
<div class="container">
    <h3>Tambah Laporan Whistle Blowing</h3>
    <form action="{{ route('whistles-create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- ambil user id yang login saat ini dan formnya ngak usah ditampilkan --}}
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pelapor</label>
            <input type="text" class="form-control" id="nama" name="nama" maxlength="64" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" maxlength="15" minlength="10" required>
        </div>
        <script>
            document.getElementById('no_hp').addEventListener('input', function (e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
            document.getElementById('no_hp').addEventListener('blur', function (e) {
                if (this.value.length < 10 || this.value.length > 15) {
                    this.setCustomValidity('No HP harus antara 10-15 digit');
                    this.reportValidity();
                } else {
                    this.setCustomValidity('');
                }
            });
        </script>

        <div class="mb-3">
            <label for="email" class="form-label">Email (Opsional)</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
            <label for="tindakan" class="form-label">Tindakan</label>
            <textarea class="form-control" id="tindakan" name="tindakan" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="nama_terlapor" class="form-label">Nama Terlapor</label>
            <input type="text" class="form-control" id="nama_terlapor" name="nama_terlapor" maxlength="64" required>
        </div>

        <div class="mb-3">
            <label for="jabatan_terlapor" class="form-label">Jabatan Terlapor (Opsional)</label>
            <input type="text" class="form-control" id="jabatan_terlapor" name="jabatan_terlapor" maxlength="64">
        </div>

        <div class="mb-3">
            <label for="tanggal_waktu" class="form-label">Tanggal & Waktu Kejadian</label>
            <input type="datetime-local" class="form-control" id="tanggal_waktu" name="tanggal_waktu" required>
        </div>

        <div class="mb-3">
            <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian (Opsional)</label>
            <textarea class="form-control" id="lokasi_kejadian" name="lokasi_kejadian" rows="2"></textarea>
        </div>

        <div class="mb-3">
            <label for="kronologis" class="form-label">Kronologis</label>
            <textarea class="form-control" id="kronologis" name="kronologis" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="nominal_korupsi" class="form-label">Nominal Korupsi (Opsional)</label>
            <input type="number" class="form-control" id="nominal_korupsi" name="nominal_korupsi" step="0.01" min="0">
        </div>

        <div class="mb-3">
            <label for="foto_bukti" class="form-label">Foto Bukti</label>
            <input type="file" class="form-control" id="foto_bukti" name="foto_bukti" accept=".jpg,.jpeg,.png" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('public.whistles') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
