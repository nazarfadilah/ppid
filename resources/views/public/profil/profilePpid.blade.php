@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 120px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Profil PPID</h2>
    </div>

    <div class="mx-auto" style="max-width: 1000px;">
        <div class="text-justify">
            <h4>Profil PPID POLITEKNIK NEGERI BANJARMASIN (POLIBAN)</h4>
            <p>
                PPID Politeknik Negeri Banjarmasin (POLIBAN) adalah salah satu entitas yang berperan penting dalam memastikan transparansi, akuntabilitas, dan akses informasi publik di lingkungan Poliban.
            </p>
            <p>
                Sebagai Pejabat Pengelola Informasi dan Dokumentasi, PPID Poliban bertanggung jawab atas manajemen informasi dan dokumen yang berkaitan dengan kegiatan dan layanan yang diberikan kepada masyarakat.
            </p>
            <p>
                Salah satu aspek kunci dari PPID Poliban adalah memberikan akses terhadap informasi publik sesuai regulasi Pelayanan Publik di Kemenristekdikti.
            </p>
        </div>

        <div class="text-center my-5">
            <h2 class="mb-4">Struktur Organisasi PPID</h2>
            <img src="{{ asset('images/struktur-ppid- poliban.jpg') }}" alt="Struktur Organisasi PPID" class="img-fluid" style="max-width: 1000px;">
        </div>

        <div class="container my-5">
            <h2 class="text-center mb-4">Tugas PPID</h2>
            <ol>
                <li>Menyimpan dan mendokumentasikan informasi publik yang dihasilkan oleh Politeknik Negeri Banjarmasin.</li>
                <li>Menyediakan dan melayani permintaan informasi publik dari masyarakat.</li>
                <li>Membuat daftar informasi publik yang dikecualikan.</li>
                <li>Melakukan sosialisasi tentang hak dan kewajiban akses informasi publik.</li>
                <li>Melakukan koordinasi dengan unit kerja dalam penyediaan dan pelayanan informasi publik.</li>
            </ol>
        </div>

        <div class="container my-5">
            <h2 class="text-center mb-4">Fungsi PPID</h2>
            <ol>
                <li><strong>Fungsi Penyimpanan:</strong> Menyimpan dan mendokumentasikan seluruh informasi publik yang dihasilkan oleh Politeknik Negeri Banjarmasin.</li>
                <li><strong>Fungsi Pelayanan:</strong> Menyediakan dan melayani permintaan informasi publik dari masyarakat sesuai dengan prosedur yang berlaku.</li>
                <li><strong>Fungsi Koordinasi:</strong> Melakukan koordinasi dengan unit kerja dalam penyediaan dan pelayanan informasi publik.</li>
                <li><strong>Fungsi Sosialisasi:</strong> Melakukan sosialisasi kepada masyarakat tentang hak dan kewajiban akses informasi publik.</li>
            </ol>
        </div>
    </div>
</div>

@endsection