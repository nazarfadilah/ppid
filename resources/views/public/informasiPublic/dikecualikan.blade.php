@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 110px;">
    <div class="text-center mb-5">
        <h2 class="mb-1" style="font-size:2.8rem;font-weight:700;">Informasi Yang Dikecualikan</h2>
    </div>
    <div class="table-responsive mb-5">
        <table class="table table-bordered align-middle" style="background:#fff;">
            <thead class="table-light text-center align-middle">
                <tr>
                    <th style="width:40px;">No.</th>
                    <th style="min-width:220px;">JENIS KLASIFIKASI INFORMASI YANG DIKECUALIKAN</th>
                    <th style="min-width:340px;">ALASAN PENGECUALIAN</th>
                    <th style="min-width:160px;">JANGKA WAKTU</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Dokumen Pengadaan Barang/Jasa dari Penyedian Barang/Jasa</td>
                    <td>
                        1. Pasal 17 huruf h angka 3 Undang – Undang nomor 14 Tahun 2008 tentang keterbukaan Informasi Publik<br>
                        2. Pasal 6 Peraturan Presiden Nomor 54 Tahun 2010 Tentang Pengadaan Barang / Jasa<br>
                        3. Pasal 8 ayat (3) Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>1 Tahun</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Usulan Nama Calon Pejabat yang akan memangku suatu jabatan tertentu</td>
                    <td>
                        1. Pasal 322 Ayat (1) Undang – Undang Nomor 8 Tahun 1981 Tentang Hukum Acara Pidana<br>
                        2. Pasal 44 Ayat (1) huruf h Undang – Undang Nomor 43 Tahun 2009 Tentang kearsipan
                    </td>
                    <td>Setelah yang bersangkutan dilantik</td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Hasil proses penjatuhan hukuman disiplin pegawai</td>
                    <td>
                        1. Pasal 17 huruf h angka 4 Undang – Undang nomor 14 Tahun 2008 tentang keterbukaan Informasi Publik<br>
                        2. Pasal 322 Ayat (1) Undang – Undang Nomor 8 Tahun 1981 Tentang Hukum Acara Pidana<br>
                        3. Pasal 44 Ayat (1) huruf h Undang – Undang Nomor 43 Tahun 2009 Tentang kearsipan<br>
                        4. Pasal 8 ayat (3) Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>Dibuka setelah ada keputusan tetap dari Pimpinan badan publik</td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Dokumen perjanjian kerja sama</td>
                    <td>
                        Pasal 44 ayat (1) huruf h Undang – Undang Nomor 43 Tahun 2009 Tentang kearsipan
                    </td>
                    <td>
                        – Sampai masa perjanjian habis<br>
                        – Dengan persetujuan tertulis para pihak
                    </td>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td>Data pribadi Dosen, Staf dan Mahasiswa, Alumni serta Mitra Kerja Sama</td>
                    <td>
                        1. Pasal 44 Ayat (1) huruf h Undang-Undang Nomor 43 tahun 2009 Tentang Kearsipan<br>
                        2. Pasal 8 ayat (3) Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>Dibuka setelah mendapat persetujuan tertulis dari yang bersangkutan</td>
                </tr>
                <tr>
                    <td class="text-center">6</td>
                    <td>Dokumen Minutes Of Meeting</td>
                    <td>
                        Pasal 44 Ayat (1) huruf h Undang-Undang Nomor 43 tahun 2009 Tentang Kearsipan
                    </td>
                    <td>Dibuka setelah mendapat persetujuan para pihak</td>
                </tr>
                <tr>
                    <td class="text-center">7</td>
                    <td>Perencanaan Rotasi Pegawai</td>
                    <td>
                        1. Pasal 17 huruf i Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 8 ayat (3) huruf i Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>Dibuka setelah rotasi dilakukan</td>
                </tr>
                <tr>
                    <td class="text-center">8</td>
                    <td>Skema Remunerasi</td>
                    <td>
                        1. Pasal 17 huruf h Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 8 ayat (3) huruf h Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>Dibuka setelah ada keputusan tetap dari Pimpinan badan publik</td>
                </tr>
                <tr>
                    <td class="text-center">9</td>
                    <td>Dokumen-dokumen dan berita acara proses Pembinaan Aparatur</td>
                    <td>
                        1. Pasal 17 huruf h Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 8 ayat (3) huruf h Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>Dibuka setelah mendapatkan persetujuan tertulis dari yang bersangkutan</td>
                </tr>
                <tr>
                    <td class="text-center">10</td>
                    <td>Soal Ujian dinas dan ujian penyesuaian Ijazah</td>
                    <td>
                        1. Pasal 17 huruf h angka 4 Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 8 ayat (3) huruf h angka 4 Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>Dibuka setelah pengumuman kelulusan</td>
                </tr>
                <tr>
                    <td class="text-center">11</td>
                    <td>Data evaluasi diri jurusan / program studi</td>
                    <td>
                        1. Pasal 17 huruf b dan huruf h angka 5 Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 8 ayat (3) huruf b dan huruf h angka 5 Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>1 Tahun (diberikan berupa ringkasan temuan)</td>
                </tr>
                <tr>
                    <td class="text-center">12</td>
                    <td>Data temuan / Hasil audit mutu internal</td>
                    <td>
                        1. Pasal 17 huruf b dan huruf h angka 5 Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 8 ayat (3) huruf b dan huruf h angka 5 Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>Dibuka setelah ada persetujuan dari pimpinan badan publik</td>
                </tr>
                <tr>
                    <td class="text-center">13</td>
                    <td>Laporan Hasil monitoring tindak lanjut hasil audit</td>
                    <td>
                        1. Pasal 6 ayat (3) pasal 17 huruf b dan huruf h angka 5 Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 8 ayat (3) huruf b dan huruf h angka 5 Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>1 Tahun (diberikan berupa ringkasan laporan hasil monitoring)</td>
                </tr>
                <tr>
                    <td class="text-center">14</td>
                    <td>Kertas kerja audit</td>
                    <td>
                        1. Pasal 6 Ayat (3) Pasal 17 huruf b dan huruf h angka 5 Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 44 ayat (1) Undang-undang nomor 43 tahun 2009 tentang kearsipan<br>
                        3. Pasal 8 ayat (3) huruf b dan huruf h angka 5 Peraturan Menteri Riset, Teknologi, Dan Pendidikan Tinggi Nomor 75 Tahun 2016 Tentang Layanan Informasi Publik
                    </td>
                    <td>1 tahun dan setelah priode audit selesai dengan persetujuan tertulis dari pimpinan badan publik</td>
                </tr>
                <tr>
                    <td class="text-center">15</td>
                    <td>Kertas Kerja Monitoring (tindak lanjut hasil rekapitulasi)</td>
                    <td>
                        1. Pasal 6 Ayat (3) Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik<br>
                        2. Pasal 44 ayat (1) Undang-undang Nomor 43 tahun 2009 Tentang kearsipan
                    </td>
                    <td>Dibuka setelah mendapat persetujuan tertulis dari pimpinan badan publik</td>
                </tr>
                <tr>
                    <td class="text-center">16</td>
                    <td>Data pengaduan masyarakat dan laporan hasil pemeriksaan pengaduan masyarakat terhadap kinerja dan prilaku individu pejabat dan / atau staf</td>
                    <td>
                        1. Pasal 17 huruf a dan huruf i Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik
                    </td>
                    <td>1 Tahun (diberikan berupa rekapitulasi pengaduan)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
