
@extends('public.navbar')
@section('content')



    <!-- Main News Slider Start -->
    <div class="container-fluid pt-5 mt-5">
    <div class="row">
        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">
                <!-- Berita utama akan diisi oleh JavaScript -->
            </div>
        </div>
        <div class="col-lg-5 px-0">
            <div class="row mx-0">
                <!-- Berita kecil akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-dark py-3 mb-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Breaking News</div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                        style="width: calc(100% - 170px); padding-right: 90px;">
                        <!-- Breaking News akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Breaking News End -->


   
    <!-- Featured News Slider End -->


    <!-- News With Sidebar Start -->
 
        <h1 class="my-4 text-center">Latest News</h1>
        <div id="news-container"></div>
  
    <!-- News With Sidebar End -->


    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    
    @endsection

    @push('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const apiUrl = '{{ route('fetch-news') }}'; // Gantilah dengan URL yang sesuai

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && data.data && Array.isArray(data.data.data)) {
                    // Render berita ke dalam layout
                    renderNews(data.data.data);
                } else {
                    console.error('Error: Data tidak valid atau tidak dalam format yang diharapkan');
                }
            })
            .catch(error => console.error('Error fetching news:', error));

        function renderNews(articles) {
            // Pastikan articles adalah array
            if (Array.isArray(articles)) {
                // Slider Utama
                const mainCarousel = document.querySelector('.main-carousel');
                if (mainCarousel) {
                    mainCarousel.innerHTML = articles.slice(0, 1).map(article => `
                        <div class="position-relative overflow-hidden" style="height: 500px;">
                            <img class="img-fluid h-100" src="${article.image || 'https://via.placeholder.com/800x500'}" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="text-white" href="${article.link}" target="_blank">${new Date(article.publishedAt).toLocaleDateString()}</a>
                                </div>
                                <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="${article.link}" target="_blank">${article.title}</a>
                            </div>
                        </div>
                    `).join('');
                }

                // Berita Kecil (Sidebar)
                const smallNews = document.querySelector('.row.mx-0');
                if (smallNews) {
                    smallNews.innerHTML = articles.slice(1, 5).map(article => `
                        <div class="col-md-6 px-0">
                            <div class="position-relative overflow-hidden" style="height: 250px;">
                                <img class="img-fluid w-100 h-100" src="${article.image || 'https://via.placeholder.com/700x435'}" style="object-fit: cover;">
                                <div class="overlay">
                                    <div class="mb-2">
                                        <a class="text-white" href="${article.link}" target="_blank"><small>${new Date(article.publishedAt).toLocaleDateString()}</small></a>
                                    </div>
                                    <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="${article.link}" target="_blank">${article.title}</a>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }

                // Breaking News
                const trendingCarousel = document.querySelector('.tranding-carousel');
                if (trendingCarousel) {
                    trendingCarousel.innerHTML = articles.slice(0, 5).map(article => `
                        <div class="text-truncate">
                            <a class="text-white text-uppercase font-weight-semi-bold" href="${article.link}" target="_blank">${article.title}</a>
                        </div>
                    `).join('');
                }
            } else {
                console.error('Error: Artikel tidak ditemukan atau tidak dalam format array');
            }
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const apiUrl = '{{ route('fetch-news') }}'; // Gantilah dengan URL yang sesuai

        // Ambil data berita
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && data.data) {
                    // Render berita ke dalam layout
                    renderNews(data.data.data); // Pastikan kita mengambil data.data.data yang sesuai
                }
            })
            .catch(error => console.error('Error fetching news:', error));

        function renderNews(articles) {
            // Pastikan articles adalah array
            if (Array.isArray(articles)) {
                const newsContainer = document.getElementById('news-container');
                if (newsContainer) {
                    newsContainer.innerHTML = ''; // Mengosongkan kontainer sebelum menambahkan berita baru

                    // Membuat baris berita
                    let row;
                    articles.forEach((article, index) => {
                        // Jika index adalah kelipatan dari 3, buat baris baru
                        if (index % 3 === 0) {
                            row = document.createElement('div');
                            row.classList.add('row');
                            newsContainer.appendChild(row);
                        }

                        // Membuat item berita dalam kolom
                        const newsItem = document.createElement('div');
                        newsItem.classList.add('col-md-4', 'mb-4'); // 3 kolom per baris

                        // Thumbnail Gambar
                        const img = document.createElement('img');
                        img.classList.add('img-fluid');
                        img.src = article.image ? article.image : 'img/news-110x110-1.jpg'; // Gambar default jika tidak ada gambar
                        img.alt = 'Thumbnail Berita';
                        newsItem.appendChild(img);

                        // Konten Berita
                        const contentDiv = document.createElement('div');
                        contentDiv.classList.add('content');

                        // Tanggal dan Kategori
                        const dateDiv = document.createElement('div');
                        dateDiv.classList.add('date');
                        dateDiv.innerHTML = `<small>${new Date(article.isoDate).toLocaleDateString()}</small>`;
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

                        // Menambahkan item berita ke baris
                        row.appendChild(newsItem);
                    });
                }
            } else {
                console.error('Error: Artikel tidak ditemukan atau tidak dalam format array');
            }
        }
    });
</script>

    @endpush
