@extends('public.layout.layout')

@section('content')
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Keberatan Informasi Publik</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active" aria-current="page">Keberatan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Tambah -->
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('public.objections.create') }}" class="btn btn-primary">Tambah Keberatan</a>
            </div>
            <div class="col-md-6 text-end">
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

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="objectionTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemohon</th>
                        <th>Alamat Pemohon</th>
                        <th>Pekerjaan Pemohon</th>
                        <th>No HP Pemohon</th>
                        <th>Email Pemohon</th>
                        <th>Status</th>
                        <th>Detail</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($objections->sortByDesc('created_at') as $obj)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obj->nama_pemohon }}</td>
                        <td>{{ $obj->alamat_pemohon }}</td>
                        <td>{{ $obj->pekerjaan_pemohon }}</td>
                        <td>{{ $obj->no_hp_pemohon }}</td>
                        <td>{{ $obj->email_pemohon }}</td>
                        <td>
                            @if($obj->status === 'Checking')
                                <span class="badge bg-secondary">Menunggu</span>
                            @elseif($obj->status === 'Approved')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($obj->status === 'Rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('objection.show', $obj->id) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                        {{-- <td>
                            <form action="{{ route('objections.destroy', $obj->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus keberatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td> --}}
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

<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9998;"></div>
<div id="loadingSpinner" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script>
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '9999';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        // Add to DOM
        document.body.appendChild(notification);

        // Remove after 5 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    // Check URL parameters for status messages
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('status')) {
        const status = urlParams.get('status');
        const action = urlParams.get('action');

        if (status === 'success') {
            if (action === 'Approved') {
                showNotification('Laporan berhasil disetujui!', 'success');
            } else if (action === 'Rejected') {
                showNotification('Laporan berhasil ditolak!', 'warning');
            }
        }
    }
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('objectionTable').getElementsByTagName('tbody')[0];
    const rows = Array.from(table.getElementsByTagName('tr'));
    const perPageSelect = document.getElementById('perPage');
    // Pagination function
    let currentPage = 1;
    let rowsPerPage = parseInt(perPageSelect.value);

    function updatePagination() {
        const totalPages = Math.ceil(rows.length / rowsPerPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        // Previous button
        const prevLi = document.createElement('li');
        prevLi.className = 'page-item' + (currentPage === 1 ? ' disabled' : '');
        const prevLink = document.createElement('a');
        prevLink.className = 'page-link';
        prevLink.href = '#';
        prevLink.textContent = 'Previous';
        prevLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });
        prevLi.appendChild(prevLink);
        pagination.appendChild(prevLi);

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = 'page-item' + (i === currentPage ? ' active' : '');
            const link = document.createElement('a');
            link.className = 'page-link';
            link.href = '#';
            link.textContent = i;
            link.addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = i;
                showPage(currentPage);
            });
            li.appendChild(link);
            pagination.appendChild(li);
        }

        // Next button
        const nextLi = document.createElement('li');
        nextLi.className = 'page-item' + (currentPage === totalPages ? ' disabled' : '');
        const nextLink = document.createElement('a');
        nextLink.className = 'page-link';
        nextLink.href = '#';
        nextLink.textContent = 'Next';
        nextLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        });
        nextLi.appendChild(nextLink);
        pagination.appendChild(nextLi);
    }

    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? '' : 'none';
        });

        updatePagination();
    }

    // Per page change handler
    perPageSelect.addEventListener('change', function() {
        rowsPerPage = parseInt(this.value);
        currentPage = 1;
        showPage(currentPage);
    });

    // Initialize pagination
    showPage(currentPage);
});
</script>
@endsection
