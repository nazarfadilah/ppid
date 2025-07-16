@extends('admin.layout')

@section('content')
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Laporan Pengaduan Whistle Blowing</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active" aria-current="page">Whistle Blowing</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <!-- Info & Export -->
            <div class="row mb-3">
                <div>
                    <div class="alert alert-info mb-1">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total : <strong>{{ $totalWhistle }}</strong></span>
                            <span class="ms-3 me-3">|</span>
                            <div class="d-inline">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
                                    <i class="bi bi-file-earmark-arrow-down"></i> Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-end">
                    <form action="{{ request()->url() }}" method="GET" class="mb-3">
                        <div class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <select id="statusFilter" class="form-select">
                                        <option value="">Semua Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="finished">Finished</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="startDateFilter" class="form-control" placeholder="Tanggal Mulai">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="endDateFilter" class="form-control" placeholder="Tanggal Akhir">
                                </div>
                                <div class="col-md-3 d-flex">
                                    <button id="resetFilter" class="btn btn-secondary" type="button">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
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

            <!-- Tabel -->
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($whistles->sortByDesc('created_at') as $whistle)
                        <tr data-created="{{ $whistle->created_at->format('Y-m-d') }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $whistle->nama }}</td>
                            <td>{{ $whistle->no_hp }}</td>
                            <td>{{ $whistle->email }}</td>
                            <td>{{ $whistle->tindakan }}</td>
                            <td>{{ $whistle->nama_terlapor }}</td>
                            <td>{{ $whistle->status }}</td>
                            <td>
                                <a href="{{ route('admin-whistle-detail', $whistle->id) }}" class="btn btn-sm btn-info">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination justify-content-center" id="pagination"></ul>
                </nav>
            </div>

            <!-- Modal Export -->
            <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin-whistle-export') }}" method="POST" target="_blank">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Export Data Whistle Blowing</h5>
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
                                            $years = \App\Models\Whistle::selectRaw('YEAR(created_at) as year')
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
</div>

<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9998;"></div>
<div id="loadingSpinner" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.querySelector('#whistleTable tbody');
    const allRows = Array.from(table.querySelectorAll('tr'));
    const perPageSelect = document.getElementById('perPage');
    const pagination = document.getElementById('pagination');
    const statusFilter = document.getElementById('statusFilter');
    const startDateFilter = document.getElementById('startDateFilter');
    const endDateFilter = document.getElementById('endDateFilter');
    const resetFilter = document.getElementById('resetFilter');

    let currentPage = 1;
    let rowsPerPage = parseInt(perPageSelect.value);
    let filteredRows = [...allRows];

    function filterRows() {
        const selectedStatus = statusFilter.value.trim();
        const startDate = startDateFilter.value;
        const endDate = endDateFilter.value;

        filteredRows = allRows.filter(row => {
            const statusText = row.cells[6].textContent.trim();
            const createdDate = row.getAttribute('data-created');

            const statusMatch = selectedStatus === '' || statusText === selectedStatus;
            const startMatch = !startDate || createdDate >= startDate;
            const endMatch = !endDate || createdDate <= endDate;

            return statusMatch && startMatch && endMatch;
        });
    }

    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        allRows.forEach(row => row.style.display = 'none');
        filteredRows.slice(start, end).forEach(row => row.style.display = '');

        updatePagination();
    }

    function updatePagination() {
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        pagination.innerHTML = '';

        const createPageItem = (label, pageNum, disabled = false, active = false) => {
            const li = document.createElement('li');
            li.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.textContent = label;
            a.addEventListener('click', function (e) {
                e.preventDefault();
                if (!disabled) {
                    currentPage = pageNum;
                    showPage(currentPage);
                }
            });
            li.appendChild(a);
            return li;
        };

        pagination.appendChild(createPageItem('Previous', currentPage - 1, currentPage === 1));
        for (let i = 1; i <= totalPages; i++) {
            pagination.appendChild(createPageItem(i, i, false, i === currentPage));
        }
        pagination.appendChild(createPageItem('Next', currentPage + 1, currentPage === totalPages));
    }

    // Event listeners
    perPageSelect.addEventListener('change', () => {
        rowsPerPage = parseInt(perPageSelect.value);
        currentPage = 1;
        showPage(currentPage);
    });

    [statusFilter, startDateFilter, endDateFilter].forEach(input => {
        input.addEventListener('input', () => {
            filterRows();
            currentPage = 1;
            showPage(currentPage);
        });
    });

    resetFilter.addEventListener('click', () => {
        statusFilter.value = '';
        startDateFilter.value = '';
        endDateFilter.value = '';
        filterRows();
        currentPage = 1;
        showPage(currentPage);
    });

    // Init
    filterRows();
    showPage(currentPage);
});
</script>
@endsection
