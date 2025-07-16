@extends('public.layout.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Daftar Permohonan Informasi Publik</h3>
    </div>

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('public.information-requests.create') }}" class="btn btn-primary">Tambah Permohonan</a>
            </div>
            <div class="col-md-6 text-end">
                <label for="perPage">Tampilkan</label>
                <select id="perPage" class="form-select d-inline-block w-auto">
                    <option value="5" {{ request()->input('perPage', '10') == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request()->input('perPage', '10') == '10' ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request()->input('perPage', '10') == '25' ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request()->input('perPage', '10') == '50' ? 'selected' : '' }}>50</option>
                </select>
                <span>data per halaman</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="requestTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kategori Permohonan</th>
                        <th>Nama Pemohon</th>
                        <th>NIK</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Informasi Terkait</th>
                        <th>Status</th>
                        <th>Detail</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests->sortByDesc('created_at') as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($request->request_category) }}</td>
                        <td>{{ $request->nama_pemohon }}</td>
                        <td>{{ $request->nik }}</td>
                        <td>{{ $request->no_hp }}</td>
                        <td>{{ $request->email }}</td>
                        <td>{{ $request->informasi_terkait }}</td>
                        <td>
                            @if($request->status === 'Checking')
                                <span class="badge bg-secondary">Menunggu</span>
                            @elseif($request->status === 'Approved')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($request->status === 'Rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('public-information.detail', $request->id) }}" class="btn btn-info btn-sm" style="font-size: 0.5rem;">Detail</a>
                        </td>
                        {{-- <td>
                            <form action="{{ route('public-information-requests.destroy', $request->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-xs py-1 px-2" style="font-size: 0.75rem;">Hapus</button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('perPage');
    const tableRows = document.querySelectorAll('#requestTable tbody tr');
    const paginationContainer = document.getElementById('pagination');

    // When the perPage select changes, reload the page with the new parameter
    perPageSelect.addEventListener('change', function() {
        const url = new URL(window.location.href);
        url.searchParams.set('perPage', this.value);
        window.location.href = url.toString();
    });

    // Client-side pagination implementation
    let currentPage = 1;
    const rowsPerPage = parseInt(perPageSelect.value);
    const totalPages = Math.ceil(tableRows.length / rowsPerPage);

    // Function to display the current page
    function displayPage(page) {
        const startIndex = (page - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        tableRows.forEach((row, index) => {
            row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
        });

        renderPagination();
    }

    // Function to render pagination controls
    function renderPagination() {
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
                displayPage(currentPage);
            }
        });
        prevLi.appendChild(prevLink);
        paginationContainer.appendChild(prevLi);

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const pageLi = document.createElement('li');
            pageLi.className = `page-item ${i === currentPage ? 'active' : ''}`;
            const pageLink = document.createElement('a');
            pageLink.className = 'page-link';
            pageLink.href = '#';
            pageLink.textContent = i;
            pageLink.addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = i;
                displayPage(currentPage);
            });
            pageLi.appendChild(pageLink);
            paginationContainer.appendChild(pageLi);
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
                displayPage(currentPage);
            }
        });
        nextLi.appendChild(nextLink);
        paginationContainer.appendChild(nextLi);
    }

    // Initialize pagination
    if (tableRows.length > 0) {
        displayPage(currentPage);
    }
});
</script>
@endsection
