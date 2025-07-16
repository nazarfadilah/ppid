{{-- resources/views/public/keberatan/detail.blade.php --}}
@extends('public.layout.layout')

@section('content')
<div class="container">
    <h2>Detail Keberatan</h2>
    @if(isset($objection))
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $objection->id }}</td>
            </tr>
            <tr>
                <th>Nama Pemohon</th>
                <td>{{ $objection->nama_pemohon }}</td>
            </tr>
            <tr>
                <th>Alamat Pemohon</th>
                <td>{{ $objection->alamat_pemohon }}</td>
            </tr>
            <tr>
                <th>Pekerjaan Pemohon</th>
                <td>{{ $objection->pekerjaan_pemohon }}</td>
            </tr>
            <tr>
                <th>No HP Pemohon</th>
                <td>{{ $objection->no_hp_pemohon }}</td>
            </tr>
            <tr>
                <th>Email Pemohon</th>
                <td>{{ $objection->email_pemohon }}</td>
            </tr>
            <tr>
                <th>Nama Kuasa Pemohon</th>
                <td>{{ $objection->nama_kuasa_pemohon ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat Kuasa Pemohon</th>
                <td>{{ $objection->alamat_kuasa_pemohon ?? '-' }}</td>
            </tr>
            <tr>
                <th>No HP Kuasa Pemohon</th>
                <td>{{ $objection->no_hp_kuasa_pemohon ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alasan Pengajuan</th>
                <td>{{ $objection->alasan_pengajuan }}</td>
            </tr>
            <tr>
                <th>Kasus Posisi</th>
                <td>{{ $objection->kasus_posisi }}</td>
            </tr>
            <tr>
                <th>KTP Pemohon</th>
                <td>
                    @if($objection->ktp_pemohon)
                        <a href="{{ route('public-objection.ktp', ['id' => $objection->id]) }}" target="_blank">Lihat KTP</a>
                    @else
                        <span class="badge bg-secondary">Tidak Ada</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $objection->status }}</td>
            </tr>
            <tr>
                <th>Alasan Penolakan</th>
                <td>{{ $objection->reject_reason ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Diajukan</th>
                <td>{{ $objection->created_at }}</td>
            </tr>
        </table>
        <a href="{{ route('public.objections') }}" class="btn btn-secondary">Kembali</a>
    @else
        <div class="alert alert-danger">
            Data keberatan tidak ditemukan.
        </div>
    @endif
</div>
@endsection
