@extends('admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Daftar Pengajuan Informasi Publik</h3>
    </div>
        <div class="container-fluid">
            <div class="row mb-3">
                <div>
                    <div class="alert alert-info mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total : <strong>{{ $totalPublicInformationRequest }}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-end">
                    <div>
                    <form action="{{ request()->url() }}" method="GET" class="mb-3">
                        <div class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <select id="statusFilter" class="form-select">
                                        <option value="">Semua Status</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Checking">Checking</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="startDateFilter" class="form-control" placeholder="Tanggal Mulai">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="endDateFilter" class="form-control" placeholder="Tanggal Akhir">
                                </div>
                                <div class="col-md-3 d-flex">
                                    <button type="button" id="resetFilter" class="btn btn-secondary flex-grow-1">
                                        <i class="bi bi-x-circle me-1"></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests->sortByDesc('created_at') as $request)
                    <tr data-created="{{ $request->created_at->format('Y-m-d') }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($request->request_category) }}</td>
                        <td>{{ $request->nama_pemohon }}</td>
                        <td>{{ $request->nik }}</td>
                        <td>{{ $request->no_hp }}</td>
                        <td>{{ $request->email }}</td>
                        <td>{{ $request->informasi_terkait }}</td>
                        <td>{{ $request->status }}</td>
                        <td>
                            <a href="{{ route('admin-request-detail', $request->id) }}" class="btn btn-info btn-sm" style="font-size: 0.5rem;">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <nav>
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
        <!-- Tombol Export -->
        <div class="mt-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="bi bi-file-earmark-arrow-down me-1"></i> Export Data
            </button>
        </div>

        <!-- Modal Export -->
        <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin-request-export') }}" method="POST" target="_blank">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Export Data Permohonan Informasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="format" class="form-label">Pilih Format File:</label>
                            <select name="format" id="format" class="form-select" required>
                                <option value="">-- Pilih Format --</option>
                                <option value="excel">Excel (.xlsx)</option>
                                <option value="pdf">PDF (.pdf)</option>
                                <option value="word">Word (.docx)</option>
                                <option value="png">PNG (.png)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Pilih Tahun:</label>
                            <select name="year" id="year" class="form-select" required>
                                @php
                                    $years = \App\Models\PublicInformationRequest::selectRaw('YEAR(created_at) as year')
                                        ->distinct()->orderBy('year', 'desc')->pluck('year');
                                @endphp
                                @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                </div>
            </form>
        </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('perPage');
    const statusFilter = document.getElementById('statusFilter');
    const startDateFilter = document.getElementById('startDateFilter');
    const endDateFilter = document.getElementById('endDateFilter');
    const resetFilterBtn = document.getElementById('resetFilter');
    const tableRows = Array.from(document.querySelectorAll('#requestTable tbody tr'));
    const paginationContainer = document.getElementById('pagination');

    let currentPage = 1;

    function getFilteredRows() {
        const selectedStatus = statusFilter.value;
        const start = startDateFilter.value;
        const end = endDateFilter.value;

        return tableRows.filter(row => {
            const status = row.cells[7].textContent.trim();
            const date = row.getAttribute('data-date'); // format: Y-m-d

            const matchStatus = selectedStatus === '' || status === selectedStatus;
            const matchDate = (!start || date >= start) && (!end || date <= end);

            return matchStatus && matchDate;
        });
    }

    function displayPage(page) {
        const rowsPerPage = parseInt(perPageSelect.value);
        const filteredRows = getFilteredRows();
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        const startIndex = (page - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;

        tableRows.forEach(row => row.style.display = 'none');
        filteredRows.slice(startIndex, endIndex).forEach(row => row.style.display = '');

        currentPage = page;
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        paginationContainer.innerHTML = '';

        const createPageItem = (text, pageNum, disabled = false, active = false) => {
            const li = document.createElement('li');
            li.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.textContent = text;
            a.addEventListener('click', function(e) {
                e.preventDefault();
                if (!disabled) {
                    currentPage = pageNum;
                    displayPage(currentPage);
                }
            });
            li.appendChild(a);
            return li;
        };

        paginationContainer.appendChild(createPageItem('Previous', currentPage - 1, currentPage === 1));

        for (let i = 1; i <= totalPages; i++) {
            paginationContainer.appendChild(createPageItem(i, i, false, i === currentPage));
        }

        paginationContainer.appendChild(createPageItem('Next', currentPage + 1, currentPage === totalPages));
    }

    // Event Listeners
    perPageSelect.addEventListener('change', () => displayPage(1));

    [statusFilter, startDateFilter, endDateFilter].forEach(input => {
        input.addEventListener('input', () => {
            currentPage = 1;
            displayPage(currentPage);
        });
    });

    resetFilterBtn.addEventListener('click', () => {
        statusFilter.value = '';
        startDateFilter.value = '';
        endDateFilter.value = '';
        currentPage = 1;
        displayPage(currentPage);
    });

    // Tambahkan atribut data-date (sudah ada dari Blade)
    displayPage(1);
});
</script>

@endsection
