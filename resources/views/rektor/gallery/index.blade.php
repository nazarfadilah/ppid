@extends('rektor.layout')

@section('content')
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Galeri</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dropdown perPage -->
        <div class="row mb-3">
            <div class="col-md-12 text-end">
                <label for="perPage">Tampilkan</label>
                <select id="perPage" class="form-select d-inline-block w-auto">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span>data per halaman</span>
            </div>
        </div>

        <!-- Tabel Galeri -->
        <div class="table-responsive-sm mt-2">
            <table class="table table-striped table-sm" style="width:100%" id="galleryTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th>Type</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galleries as $gallery)
                        <tr>
                            <td>{{ $gallery->id }}</td>
                            <td>{{ $gallery->title }}</td>
                            <td>
                                @if($gallery->type === 'foto')
                                    <a href="{{ asset('storage/'.$gallery->link) }}" target="_blank">Lihat Foto</a>
                                @else
                                    <a href="{{ $gallery->link }}" target="_blank">{{ $gallery->link }}</a>
                                @endif
                            </td>
                            <td>{{ ucfirst($gallery->type) }}</td>
                            <td>{{ $gallery->description }}</td>
                            <td>{{ $gallery->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <nav>
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('galleryTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = Array.from(tbody.getElementsByTagName('tr'));
    const perPageSelect = document.getElementById('perPage');
    const pagination = document.getElementById('pagination');

    function renderTable(page = 1, perPage = parseInt(perPageSelect.value)) {
        rows.forEach(row => row.style.display = 'none');
        const start = (page - 1) * perPage;
        const end = start + perPage;
        rows.slice(start, end).forEach(row => row.style.display = '');
    }

    function renderPagination(perPage = parseInt(perPageSelect.value)) {
        pagination.innerHTML = '';
        const pageCount = Math.ceil(rows.length / perPage);
        for (let i = 1; i <= pageCount; i++) {
            const li = document.createElement('li');
            li.className = 'page-item';
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.textContent = i;
            a.onclick = function(e) {
                e.preventDefault();
                renderTable(i, perPage);
                setActivePage(i);
            };
            li.appendChild(a);
            pagination.appendChild(li);
        }
        setActivePage(1);
    }

    function setActivePage(page) {
        Array.from(pagination.children).forEach((li, idx) => {
            li.classList.toggle('active', idx === page - 1);
        });
    }

    function updateTable() {
        const perPage = parseInt(perPageSelect.value);
        renderTable(1, perPage);
        renderPagination(perPage);
    }

    perPageSelect.addEventListener('change', updateTable);
    updateTable();
});
</script>
@endpush
