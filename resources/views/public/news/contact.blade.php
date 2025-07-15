
@extends('public.navbar')
@section('content')



    <!-- Main News Slider Start -->
    <div class="container-fluid mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title mb-0">
                    <h4 class="m-0 text-uppercase font-weight-bold">Tentang Kami</h4>
                </div>
                <div class="bg-white border border-top-0 p-4 mb-3">
                    <div class="mb-4">
                        <h6 class="text-uppercase font-weight-bold">Informasi Kontak</h6>
                        <p class="mb-4">
                            PPID LLDIKTI XI melayani pertanyaan dan kebutuhan informasi terkait layanan kami.
                        </p>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa fa-map-marker-alt text-primary mr-2"></i>
                                <h6 class="font-weight-bold mb-0">Alamat Kantor</h6>
                            </div>
                            <p class="m-0">JL. Adhyaksa No 1 Banjarmasin, 70123 Kalimantan Selatan</p>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa fa-envelope-open text-primary mr-2"></i>
                                <h6 class="font-weight-bold mb-0">Email Kami</h6>
                            </div>
                            <p class="m-0">tulidiki11@kemendikbud.go.id</p>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa fa-phone-alt text-primary mr-2"></i>
                                <h6 class="font-weight-bold mb-0">Hubungi Kami</h6>
                            </div>
                            <p class="m-0">0511-3304583, 0511-3304477</p>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fa fa-clock text-primary mr-2"></i>
                                <h6 class="font-weight-bold mb-0">Jam Pelayanan</h6>
                            </div>
                            <p class="m-0">Senin-Jumat: 08:00 - 16:00</p>
                            <p class="m-0">Sabtu-Minggu: Tutup</p>
                        </div>
                    </div>
                    <h6 class="text-uppercase font-weight-bold mb-3">Tautan Penting</h6>
                    <ul>
                        <li><a href="#">Kemendikbudristek</a></li>
                        <li><a href="#">PPID Kemendikbudristek</a></li>
                        <li><a href="#">PODIKTI</a></li>
                        <li><a href="#">Website Resmi LLDIKTI Wilayah XI</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    
    @endsection

    @push('scripts')
    <script>
  document.addEventListener("DOMContentLoaded", function () {
    const apiKey = "e9a061f5446641d49dfa04619400cf3e"; // API key Anda
    const apiUrl = `https://newsapi.org/v2/everything?q=tesla&from=2024-11-02&sortBy=publishedAt&apiKey=${apiKey}`;

    // Fungsi untuk mengambil data berita
    async function fetchNews() {
        try {
            const response = await fetch(apiUrl);
            const data = await response.json();

            if (data.status === 'ok') {
                const newsContainer = document.getElementById('news-container');
                newsContainer.innerHTML = ''; // Mengosongkan kontainer sebelum menambahkan berita baru

                // Loop untuk menampilkan setiap berita
                data.articles.forEach((article) => {
                    const newsItem = document.createElement('div');
                    newsItem.classList.add('news-item');

                    // Thumbnail Gambar
                    const img = document.createElement('img');
                    img.classList.add('img-fluid');
                    img.src = article.urlToImage ? article.urlToImage : 'img/news-110x110-1.jpg'; // Jika tidak ada gambar, menggunakan default
                    img.alt = 'Thumbnail Berita';
                    newsItem.appendChild(img);

                    // Konten Berita
                    const contentDiv = document.createElement('div');
                    contentDiv.classList.add('content');

                    // Tanggal dan Kategori
                    const dateDiv = document.createElement('div');
                    dateDiv.classList.add('date');
                    dateDiv.innerHTML = `<small>${new Date(article.publishedAt).toLocaleDateString()}</small>`;
                    contentDiv.appendChild(dateDiv);

                    // Judul Berita
                    const title = document.createElement('a');
                    title.classList.add('title');
                    title.href = article.url; // Link ke artikel penuh
                    title.target = '_blank';
                    title.textContent = article.title;
                    contentDiv.appendChild(title);

                    // Menambahkan konten ke dalam item berita
                    newsItem.appendChild(contentDiv);

                    // Menambahkan item berita ke kontainer
                    newsContainer.appendChild(newsItem);
                });
            } else {
                console.error('Error fetching news:', data.message);
            }
        } catch (error) {
            console.error('Error fetching news:', error);
        }
    }

    // Panggil fungsi untuk mengambil berita
    fetchNews();
});
</script>
    @endpush

