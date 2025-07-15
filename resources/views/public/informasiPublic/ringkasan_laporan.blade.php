@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 110px;">
    <div class="text-center mb-5">
        <h1 class="mb-1" style="font-size: 3rem; font-weight: bold;">Ringkasan Laporan Akses Layanan Informasi Publik</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="table-responsive">
                <table class="table table-bordered align-middle" style="background: #fff;">
                    <thead class="text-center align-middle">
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Nama Dokumen</th>
                            <th style="width: 120px;">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1.</td>
                            <td>Jumlah Permohonan Informasi Publik yang diterima</td>
                            <td class="text-center">
                                <a href="https://drive.google.com/drive/folders/1k84Nti5b7PeictGOMnKfCP2a2ZRyL7l4" target="_blank">Lihat<br>Dokumen</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td>Waktu yang diperlukan dalam memenuhi setiap Permohonan Informasi Publik</td>
                            <td class="text-center">
                                <a href="https://drive.google.com/drive/folders/1k84Nti5b7PeictGOMnKfCP2a2ZRyL7l4" target="_blank">Lihat<br>Dokumen</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3.</td>
                            <td>Jumlah Permohonan Informasi Publik yang dikabulkan baik sebagian atau seluruhnya dan Permintaan Informasi Publik yang ditolak</td>
                            <td class="text-center">
                                <a href="https://drive.google.com/drive/folders/1k84Nti5b7PeictGOMnKfCP2a2ZRyL7l4" target="_blank">Lihat<br>Dokumen</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4.</td>
                            <td>Alasan penolakan Permohonan Informasi Publik</td>
                            <td class="text-center">
                                <a href="https://drive.google.com/drive/folders/1k84Nti5b7PeictGOMnKfCP2a2ZRyL7l4" target="_blank">Lihat<br>Dokumen</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .table th, .table td {
        vertical-align: middle !important;
    }
    .table a {
        color: #1a0dab;
        text-decoration: underline;
        font-size: 1rem;
    }
    .table a:hover {
        color: #c82333;
        text-decoration: underline;
    }
</style>

@endsection
