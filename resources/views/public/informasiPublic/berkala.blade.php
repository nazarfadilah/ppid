@extends('public.navbar')

@section('content')
<div class="container" style="margin-top: 110px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Informasi Berkala</h2>
        <p class="text-muted">Informasi yang Wajib Disediakan dan Diumumkan Secara Berkala</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="table-responsive">
                <table class="table table-bordered align-middle bg-white">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No.</th>
                            <th>Nama Informasi Berkala</th>
                            <th style="width: 80px;">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Informasi Profil Politeknik Negeri Banjarmasin
                                <table class="table table-borderless mb-0 ms-3">
                                    <tr>
                                        <td style="width:30px;">a.</td>
                                        <td>Sejarah Poliban</td>
                                        <td style="width:80px;"><a href="https://poliban.ac.id/sejarah-poliban/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>b.</td>
                                        <td>Visi dan Misi Poliban</td>
                                        <td><a href="https://poliban.ac.id/visi-misi/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>c.</td>
                                        <td>Profil Direksi</td>
                                        <td><a href="https://poliban.ac.id/profil-direksi-poliban/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>d.</td>
                                        <td>Mars Poliban</td>
                                        <td><a href="https://poliban.ac.id/mars-poliban/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>e.</td>
                                        <td>Logo Poliban</td>
                                        <td><a href="https://poliban.ac.id/logo-poliban/" class="text-primary">Lihat</a></td>
                                    </tr>
                                </table>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Dokumen SAKIP Poliban</td>
                            <td><a href="https://poliban.ac.id/dokumen-sakip-poliban/" class="text-primary">Lihat</a></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Unit Kerja
                                <table class="table table-borderless mb-0 ms-3">
                                    <tr>
                                        <td style="width:30px;">a.</td>
                                        <td>UPA TIK</td>
                                        <td style="width:80px;"><a href="https://poliban.ac.id/upt-tik/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>b.</td>
                                        <td>UPA Perpustakaan</td>
                                        <td><a href="https://poliban.ac.id/upt-perpustakaan/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>c.</td>
                                        <td>Pusat P3MP</td>
                                        <td><a href="https://poliban.ac.id/pusat-p3mp/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>d.</td>
                                        <td>Enterpreneur Training Unit</td>
                                        <td><a href="https://poliban.ac.id/etu-poliban/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>e.</td>
                                        <td>Carrier And Development Center</td>
                                        <td><a href="https://poliban.ac.id/job/" class="text-primary">Lihat</a></td>
                                    </tr>
                                </table>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Jurusan dan Program Studi
                                <table class="table table-borderless mb-0 ms-3">
                                    <tr>
                                        <td style="width:30px;">a.</td>
                                        <td>Jurusan Teknik Sipil dan Kebumian</td>
                                        <td style="width:80px;"><a href="https://poliban.ac.id/sipil/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>b.</td>
                                        <td>Jurusan Teknik Mesin</td>
                                        <td><a href="https://poliban.ac.id/mesin/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>c.</td>
                                        <td>Jurusan Teknik Elektro</td>
                                        <td><a href="https://poliban.ac.id/elektro/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>d.</td>
                                        <td>Jurusan Akuntansi</td>
                                        <td><a href="https://poliban.ac.id/akuntansi/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>e.</td>
                                        <td>Jurusan Administrasi Bisnis</td>
                                        <td><a href="https://poliban.ac.id/administrasi-bisnis/" class="text-primary">Lihat</a></td>
                                    </tr>
                                </table>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>Penerimaan Mahasiswa Baru</td>
                            <td><a href="https://poliban.ac.id/penerimaan-jalur-prestasi-2022/" class="text-primary">Lihat</a></td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>Akademik
                                <table class="table table-borderless mb-0 ms-3">
                                    <tr>
                                        <td style="width:30px;">a.</td>
                                        <td>Informasi Akademik</td>
                                        <td style="width:80px;"><a href="https://poliban.ac.id/category/akademik/#" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>b.</td>
                                        <td>Informasi Layanan Akademik</td>
                                        <td><a href="https://poliban.ac.id/info-layanan/" class="text-primary">Lihat</a></td>
                                    </tr>
                                    <tr>
                                        <td>c.</td>
                                        <td>Kegiatan Kemahasiswaan</td>
                                        <td><a href="https://poliban.ac.id/category/akademik/data-mahasiswa/" class="text-primary">Lihat</a></td>
                                    </tr>
                                </table>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>Penelitian dan Pengabdian Kepada Masyarakat</td>
                            <td><a href="https://poliban.ac.id/penelitian-pengabdian/" class="text-primary">Lihat</a></td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>Kerjasama</td>
                            <td><a href="https://poliban.ac.id/kerjasamakampus/" class="text-primary">Lihat</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
