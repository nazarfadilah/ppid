@extends('public.navbar')

@section('content')
<style>
  .box {
      height: 80%; /* Membuat box menyesuaikan dengan tinggi kontainer */
      display: flex;
      flex-direction: column;
  }

  .img-box img {
      width: 100%; /* Menjamin gambar mengisi lebar box */
      height: auto; /* Menjaga proporsi gambar */
  }

  .detail-box {
      flex-grow: 1; /* Memastikan detail-box mengambil sisa ruang */
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
  }
</style>
<div id="custom-carousel2" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#custom-carousel2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#custom-carousel2" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#custom-carousel2" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('images/banner11.jpg') }}" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/banner22.jpg') }}" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
      <img src="{{ asset('images/ppid.jpg') }}" class="d-block w-100" alt="Banner 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#custom-carousel2" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#custom-carousel2" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container my-4">

  <div class="service_section">
    <div class=" ">
      <div class="row">
        <div class="col mx-auto">
            <a href="{{ route('login') }}" class="text-decoration-none text-dark">
                <div class="box rounded-lg d-flex flex-column">
                    <div class="img-box">
                        <img src="images/s1.png" alt="" />
                    </div>
                    <div class="detail-box">
                        <h5>
                            Form Pengajuan Informasi Publik
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col mx-auto">
          <a href="{{ route('login') }}" class="text-decoration-none text-dark">
            <div class="box rounded-lg d-flex flex-column">
              <div class="img-box">
                <img src="images/s1.png" alt="" />
              </div>
              <div class="detail-box">
                <h5>
                  Form Pengajuan Keberatan
                </h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col mx-auto">
          <a href="{{ route('login') }}" class="text-decoration-none text-dark">
            <div class="box rounded-lg d-flex flex-column">
              <div class="img-box">
                <img src="images/s1.png" alt="" />
              </div>
              <div class="detail-box">
                <h5>
                  Form Laporan Pelanggaran
                </h5>
              </div>
            </div>
          </a>
        </div>

      </div>
      <div class="btn-box">
      </div>
    </div>
  </div>
</div>

<section class="professional_section layout_padding">
  <div class="container py-3">
    <div class="col-12 d-flex justify-content-center align-items-center mb-4">
      <h4 class="circle-number">Statistik Layanan Informasi Publik</h4>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="circle-box">
          <h3 class="circle-number text-warning">{{ $totalPublicInformationRequest }}</h3>
          <p>Daftar Informasi Publik</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="circle-box">
          <h3 class="circle-number text-warning">{{ $totalObjection }}</h3>
          <p>Permohonan</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="circle-box">
          <h3 class="circle-number text-warning">{{ $totalWhistle }}</h3>
          <p>Keberatan</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="circle-box">
          <h3 class="circle-number text-warning">{{ $totalRequest}}</h3>
          <p>Total Permohonan</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="awards_section layout_padding">
  <div class="container py-3">
    <h3 class="text-center mb-4">Penghargaan</h3>
    <div id="awardsCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="row">
            <div class="col-md-4 text-center">
              <img src="{{ asset('assets/Icon-Anugerah-2018.png') }}" alt="Award 1" class="img-fluid">
              <p class="keterangan">Badan Publik Pemerintah Provinsi dengan Kualifikasi Informatif</p>
              <p class="tahun">Tahun 2018</p>
            </div>
            <div class="col-md-4 text-center">
            <img src="{{ asset('assets/Icon-Anugerah-2019.png') }}" alt="Award 1" class="img-fluid">
              <p class="keterangan">Badan Publik Pemerintah Provinsi dengan Kualifikasi Informatif</p>
              <p class="tahun text-bold">Tahun 2019</p>
            </div>
            <div class="col-md-4 text-center">
            <img src="{{ asset('assets/Icon-Anugerah-2020.png') }}" alt="Award 1" class="img-fluid">
              <p class="keterangan">Badan Publik Pemerintah Provinsi dengan Kualifikasi Informatif</p>
              <p class="tahun text-bold">Tahun 2020</p>
            </div>
          </div>
        </div>
        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="row">
            <div class="col-md-4 text-center">
            <img src="{{ asset('assets/Icon-Anugerah-2021.png') }}" alt="Award 1" class="img-fluid">
              <p class="keterangan">Badan Publik Pemerintah Provinsi dengan Kualifikasi Informatif</p>
              <p class="tahun text-bold">Tahun 2021</p>
            </div>
            <div class="col-md-4 text-center">
            <img src="{{ asset('assets/Icon-Anugerah-2022.png') }}" alt="Award 1" class="img-fluid">
              <p class="keterangan">Badan Publik Pemerintah Provinsi dengan Kualifikasi Informatif</p>
              <p class="tahun text-bold">Tahun 2022</p>
            </div>
            <div class="col-md-4 text-center">
            <img src="{{ asset('assets/Icon-Anugerah-2023.png') }}" alt="Award 1" class="img-fluid">
              <p class="keterangan">Badan Publik Pemerintah Provinsi dengan Kualifikasi Informatif</p>
              <p class="tahun text-bold">Tahun 2023</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Carousel Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#awardsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#awardsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>


@endsection

@push('scripts')
<script>
 document.addEventListener('DOMContentLoaded', function () {
  var carouselElement = document.querySelector('#custom-carousel2');
  if (carouselElement) {
    var carousel = new bootstrap.Carousel(carouselElement);
  }
});

function scrollAwards(direction) {
  const container = document.querySelector('.awards-carousel');
  const scrollAmount = 200; // Sesuaikan jarak scroll
  if (direction === 'left') {
    container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
  } else {
    container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
  }
}
</script>
@endpush
