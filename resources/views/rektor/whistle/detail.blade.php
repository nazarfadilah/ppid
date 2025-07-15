@extends('admin.layout')

@section('content')
<div class="container"></div>
    <h2>Detail Laporan Whistle</h2>
    @if(isset($whistle))
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $whistle->id }}</td>
            </tr>
            <tr>
                <th>Nama Pelapor</th>
                <td>{{ $whistle->nama }}</td>
            </tr>
            <tr>
                <th>No HP</th>
                <td>{{ $whistle->no_hp }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $whistle->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tindakan</th>
                <td>{{ $whistle->tindakan }}</td>
            </tr>
            <tr>
                <th>Nama Terlapor</th>
                <td>{{ $whistle->nama_terlapor }}</td>
            </tr>
            <tr>
                <th>Jabatan Terlapor</th>
                <td>{{ $whistle->jabatan_terlapor ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal & Waktu Kejadian</th>
                <td>{{ $whistle->tanggal_waktu }}</td>
            </tr>
            <tr>
                <th>Lokasi Kejadian</th>
                <td>{{ $whistle->lokasi_kejadian ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kronologis</th>
                <td>{{ $whistle->kronologis }}</td>
            </tr>
            <tr>
                <th>Nominal Korupsi</th>
                <td>{{ $whistle->nominal_korupsi ? number_format($whistle->nominal_korupsi, 2, ',', '.') : '-' }}</td>
            </tr>
            <tr>
                <th>Foto Bukti</th>
                <td>
                    @if($whistle->foto_bukti)
                        <a href="{{ asset('storage/'.$whistle->foto_bukti) }}" target="_blank">Lihat Bukti</a>
                    @else
                        <span class="badge bg-secondary">Tidak Ada</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $whistle->status }}</td>
            </tr>
            <tr>
                <th>Tanggal Diajukan</th>
                <td>{{ $whistle->created_at }}</td>
            </tr>
        </table>
        <a href="{{ route('admin-whistle') }}" class="btn btn-secondary">Kembali</a>
    @else
        <div class="alert alert-danger">
            Data laporan tidak ditemukan.
        </div>
    @endif
</div>
@endsection
