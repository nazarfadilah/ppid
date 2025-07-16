@extends('public.layout.layout')

@section('content')
<div class="container">
    <h3>Laporan Whistle Blowing</h3>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('public.whistles.create') }}" class="btn btn-primary">Tambah Laporan</a>
        <div>
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

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="whistleTable">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Tindakan</th>
                    <th>Nama Terlapor</th>
                    <th>Status</th>
                    <th>Detail</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($whistles->sortByDesc('created_at') as $whistle)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $whistle->nama }}</td>
                    <td>{{ $whistle->no_hp }}</td>
                    <td>{{ $whistle->email }}</td>
                    <td>{{ $whistle->tindakan }}</td>
                    <td>{{ $whistle->nama_terlapor }}</td>
                    <td>
                        @if($whistle->status === 'pending')
                            <span class="badge bg-secondary">Pending</span>
                        @elseif($whistle->status === 'confirmed')
                            <span class="badge bg-success">Dikonfirmasi</span>
                        @elseif($whistle->status === 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @elseif($whistle->status === 'finished')
                            <span class="badge bg-info">Selesai</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('whistle-detail', $whistle->id) }}" class="btn btn-sm btn-info">Detail</a>
                    </td>
                    {{-- <td>
                        <form action="{{ route('whistles.destroy', $whistle->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
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

<script>
    // Function to show notification
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
            if (action === 'confirmed') {
                showNotification('Laporan berhasil dikonfirmasi!', 'success');
            } else if (action === 'rejected') {
                showNotification('Laporan berhasil ditolak!', 'warning');
            } else if (action === 'finished') {
                showNotification('Laporan berhasil diselesaikan!', 'success');
            }
        }
    }

document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('whistleTable');
    const perPageSelect = document.getElementById('perPage');
    const paginationContainer = document.getElementById('pagination');
    let currentPage = 1;
    let rowsPerPage = parseInt(perPageSelect.value);

    // Handle per page change
    perPageSelect.addEventListener('change', function() {
        rowsPerPage = parseInt(this.value);
        currentPage = 1;
        renderTable();
    });

    function renderTable() {
        const rows = table.querySelectorAll('tbody tr');
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        // Show/hide rows based on current page
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
        });

        // Generate pagination
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        paginationContainer.innerHTML = '';

        // Previous button
        const prevLi = document.createElement('li');
        prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        const prevLink = document.createElement('a');
        prevLink.className = 'page-link';
        prevLink.href = '#';
        prevLink.textContent = 'Previous';
        prevLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });
        prevLi.appendChild(prevLink);
        paginationContainer.appendChild(prevLi);

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            const link = document.createElement('a');
            link.className = 'page-link';
            link.href = '#';
            link.textContent = i;
            link.addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = i;
                renderTable();
            });
            li.appendChild(link);
            paginationContainer.appendChild(li);
        }

        // Next button
        const nextLi = document.createElement('li');
        nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        const nextLink = document.createElement('a');
        nextLink.className = 'page-link';
        nextLink.href = '#';
        nextLink.textContent = 'Next';
        nextLink.addEventListener('click', function(e) {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        });
        nextLi.appendChild(nextLink);
        paginationContainer.appendChild(nextLi);
    }

    // Initial render
    renderTable();
});
</script>
@endsection
