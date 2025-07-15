@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 110px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Informasi Serta Merta</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th style="width: 50px;">No.</th>
                        <th>Nama Informasi Serta Merta</th>
                        <th style="width: 80px;">Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1.</td>
                        <td>Pengumuman Resmi di Website Politeknik Negeri Banjarmasin</td>
                        <td class="text-center">
                            <a href="https://poliban.ac.id/category/pengumuman/" target="_blank">Lihat</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">2.</td>
                        <td>Berita Resmi di Website Politeknik Negeri Banjarmasin</td>
                        <td class="text-center">
                            <a href="https://poliban.ac.id/category/berita-terbaru/" target="_blank">Lihat</a>
                        </td>
                    </tr>
                    <!-- Tambahkan baris lain sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
