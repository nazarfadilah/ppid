<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>PPID POLIBAN</title>

  <link rel="icon" href="{{ asset('images/logo_polibanaja.png') }}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/style1.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" /> -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" />
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<script src="https://www.youtube.com/iframe_api"></script>
@stack('styles')


</head>

<body>
<div class="wrapper">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
    <div class="header_bottom">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <!-- Logo dan Nama Brand -->
          <a class="navbar-brand d-flex align-items-center" href="{{route('public.index')}}">
            <!-- Logo -->
            <img src="{{ asset('images/logo_polibanaja.png') }}" alt="Logo" class="brand-logo me-2" style="width: 35px; height: 42px;">

            <!-- Text -->
            <div class="brand-text" style="font-family: 'Roboto', sans-serif;">
              <span class="d-block">PPID POLIBAN</span>
              <small class="d-block text-secondary">Politeknik Negeri Banjarmasin</small>
            </div>
          </a>

          <!-- Toggler Button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <!-- Navbar Menu -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item {{ Route::is('public.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('public.index')}}">Beranda <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown {{ Route::is('profile*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" id="profilDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  Profil
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="profilDropdown">
                  <li><a class="dropdown-item" href="{{route('profile-ppid')}}">Profil PPID</a></li>
                  <li><a class="dropdown-item" href="{{route('profile-visimisi-ppid')}}">Visi dan Misi</a></li>
                  <li><a class="dropdown-item" href="{{route('profile-struktur-ppid')}}">Struktur Organisasi PPID</a></li>
                  <li><a class="dropdown-item" href="{{ route( 'tugas-dan-fungsi') }}">Tugas dan Fungsi</a></li>
                  <li><a class="dropdown-item" href="{{route('maklumat-pelayanan')}}">Maklumat Pelayanan Informasi Publik</a></li>
                  <li><a class="dropdown-item" href="{{route('kontak')}}">Kontak Kami</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown {{ Route::is('info*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" id="informasiDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  Informasi Publik
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="informasiDropdown">
                  <li><a class="dropdown-item" href="{{route('info-berkala')}}">Informasi Berkala</a></li>
                  <li><a class="dropdown-item" href="{{route('info-serta-merta')}}">Informasi Serta Merta</a></li>
                  <li><a class="dropdown-item" href="{{route('info-setiap-saat')}}">Informasi Publik Tersedia Setiap Saat</a></li>
                  <li><a class="dropdown-item" href="{{route('info-dikecualikan')}}">Informasi Yang Dikecualikan</a></li>
                  <li><a class="dropdown-item" href="{{ route('ringkasan-laporan') }}">Ringkasan Laporan Akses Layanan Informasi Publik</a></li>
                  <li><a class="dropdown-item" href="{{ route('statistik-pmb') }}">Statistik PMB 2024/2025</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown {{ Route::is('standar*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" id="standarLayananDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  Standar Informasi
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="standarLayananDropdown">
                  <li><a class="dropdown-item" href="{{route('standar-informasi')}}">Tata Cara Permohonan Informasi</a></li>
                  <li><a class="dropdown-item" href="{{route('standar-keberatan')}}">Tata Cara Permohonan Keberatan</a></li>
                  <li><a class="dropdown-item" href="{{route('standar-sengketa')}}">Tata Cara Penyelesaian Sengketa Informasi</a></li>
                  <li><a class="dropdown-item" href=" {{ route('tata-cara-pengaduan') }}">Tata Cara Pengaduan Penyalahgunaan Wewenang</a></li>
                  <li><a class="dropdown-item" href="{{ route('jadwal-pelayanan') }}">Jadwal Pelayanan PPID</a></li>
                  <li><a class="dropdown-item" href="{{ route('whistle-bowler') }}">Whistle Blower System(BWS)</a></li>
                  <li><a class="dropdown-item" href="{{ route('hak-hak-masyarakat') }}">Hak-Hak Masyarakat Dalam Pelayanan Informasi Publik</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link " href="https://www.lapor.go.id/" id="beritaDropdown" role="button">
                  Lapor
                </a>
              </li>
              <li class="nav-item dropdown {{ Request::is('news') ? 'active' : '' }}">
                <a class="nav-link " href="/news" id="beritaDropdown" role="button">
                  Berita
                </a>

              </li>

              <li class="nav-item dropdown {{ Request::is('gallery*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" id="galeriDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                  Galeri
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="galeriDropdown">
                  <li><a class="dropdown-item" href="/gallery/photos">Foto</a></li>
                  <li><a class="dropdown-item" href="/gallery/video">Video</a></li>
                  <li><a class="dropdown-item" href="/gallery/podcast">Podcast</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown {{ Request::is('contact') ? 'active' : '' }}">
                <a class="nav-link " href="/contact"  role="button"  aria-expanded="false">
                  Kontak
                </a>

              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>
    <!-- end header section -->
  </div>

  <div class="content">
      @yield('content')
  </div>

  <br>
  <br>
  <br>
  <!-- footer section -->
  <footer class="footer_section pt-5">
    <div class="container">
        <div class="row">
            <!-- Kolom Informasi Kontak -->
            <div class="col-lg-6">
                <h6 class="font-weight-bold"  style="color:white;">Informasi Kontak</h6>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Alamat Kantor:</div>
                    <div class="col-8">JL. Adhyaksa No 1 Banjarmasin, 70123 Kalimantan Selatan</div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Email:</div>
                    <div class="col-8">ppid@poliban.ac.id</div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Telepon:</div>
                    <div class="col-8">0511-3305052</div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 font-weight-bold">Jam Pelayanan:</div>
                    <div class="col-8">
                        Senin–Kamis (08.00–15.30)<br>
                        Istirahat (12.00–13.00)<br>
                        Jumat (08.00–15.00)<br>
                        Sabtu–Minggu: Tutup
                    </div>
                </div>
            </div>

            <!-- Kolom Lokasi -->
            <div class="col-lg-6">
                <h6 class="font-weight-bold"  style="color:white;">Lokasi</h6>
                <!-- Tambahkan iframe Google Maps untuk lokasi -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe
                        class="embed-responsive-item"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31825.287629398876!2d114.5739312!3d-3.3166941!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de4201345e91c45%3A0x472b51421dd3c5f5!2sJl.%20Adhyaksa%20No.1%2C%20Banjarmasin%2C%20Kalimantan%20Selatan!5e0!3m2!1sen!2sid!4v1697010113756!5m2!1sen!2sid"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <p>&copy; <span id="displayDateYear"></span> Dinas Pendidikan dan Kebudayaan Politeknik Negeri Banjarmasin</p>
        </div>
    </div>
</footer>


</div>
  <!-- footer section -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->



  <!-- Template Javascript -->
  <script src="js/main.js"></script>

  @if (session('success'))
      <script>
          Swal.fire({
              title: 'Berhasil!',
              text: "{{ session('success') }}",
              icon: 'success',
              confirmButtonText: 'OK'
          });
      </script>
  @endif

  <script>
    document.addEventListener("scroll", function () {
      const header = document.querySelector(".header_section");
      if (window.scrollY > 50) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }
    });
  </script>

  @stack('scripts')

</body>

</html>
