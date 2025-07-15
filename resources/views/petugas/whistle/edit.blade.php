@extends('petugas.layout')

@section('content')
<div class="container">
    <h3>Edit Laporan Whistle Blowing</h3>
    <form action="{{ route('whistle.update', $whistle->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pelapor</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $whistle->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $whistle->no_hp) }}" maxlength="20" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (Opsional)</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $whistle->email) }}">
        </div>

        <div class="mb-3">
            <label for="tindakan" class="form-label">Tindakan</label>
            <input type="text" class="form-control" id="tindakan" name="tindakan" value="{{ old('tindakan', $whistle->tindakan) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_terlapor" class="form-label">Nama Terlapor</label>
            <input type="text" class="form-control" id="nama_terlapor" name="nama_terlapor" value="{{ old('nama_terlapor', $whistle->nama_terlapor) }}" required>
        </div>

        <div class="mb-3">
            <label for="jabatan_terlapor" class="form-label">Jabatan Terlapor (Opsional)</label>
            <input type="text" class="form-control" id="jabatan_terlapor" name="jabatan_terlapor" value="{{ old('jabatan_terlapor', $whistle->jabatan_terlapor) }}">
        </div>

        <div class="mb-3">
            <label for="tanggal_waktu" class="form-label">Tanggal & Waktu Kejadian</label>
            <input type="datetime-local" class="form-control" id="tanggal_waktu" name="tanggal_waktu" value="{{ old('tanggal_waktu', \Carbon\Carbon::parse($whistle->tanggal_waktu)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="lokasi_kejadian" class="form-label">Lokasi Kejadian (Opsional)</label>
            <input type="text" class="form-control" id="lokasi_kejadian" name="lokasi_kejadian" value="{{ old('lokasi_kejadian', $whistle->lokasi_kejadian) }}">
        </div>

        <div class="mb-3">
            <label for="kronologis" class="form-label">Kronologis</label>
            <textarea class="form-control" id="kronologis" name="kronologis" rows="4" required>{{ old('kronologis', $whistle->kronologis) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="nominal_korupsi" class="form-label">Nominal Korupsi (Opsional)</label>
            <input type="number" class="form-control" id="nominal_korupsi" name="nominal_korupsi" value="{{ old('nominal_korupsi', $whistle->nominal_korupsi) }}" step="0.01" min="0">
        </div>

        <div class="mb-3">
            <label for="foto_bukti" class="form-label">Foto Bukti Sebelumnya</label>
            @if($whistle->foto_bukti)
                <img src="{{ asset('assets/foto/' . $whistle->foto_bukti) }}" class="img-thumbnail mb-2" style="max-width: 100%;">
            @else
                <p>Belum ada foto bukti</p>
            @endif
            <input type="file" class="form-control" id="foto_bukti" name="foto_bukti" accept=".jpg,.jpeg,.png">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('petugas-whistle-bowling', $whistle->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
