@extends('admin.layout')

@section('content')
<div class="container">
    <h3>Laporan Pengaduan Whistle Blowing</h3>

        <div class="container-fluid">
            <div class="row mb-3">
                <div>
                    <div class="alert alert-info mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Total : <strong>{{ $totalWhistle }}</strong></span>
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

    function applyFilters() {
        const selectedStatus = statusFilter.value.trim();
        const startDate = startDateFilter.value;
        const endDate = endDateFilter.value;

        filteredRows = allRows.filter(row => {
            const status = row.cells[6].textContent.trim();
            const created = row.getAttribute('data-created');

            const matchStatus = selectedStatus === '' || status === selectedStatus;
            const matchStart = !startDate || created >= startDate;
            const matchEnd = !endDate || created <= endDate;

            return matchStatus && matchStart && matchEnd;
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

        const createItem = (label, pageNum, disabled = false, active = false) => {
            const li = document.createElement('li');
            li.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.textContent = label;
            a.addEventListener('click', e => {
                e.preventDefault();
                if (!disabled) {
                    currentPage = pageNum;
                    showPage(currentPage);
                }
            });
            li.appendChild(a);
            return li;
        };

        pagination.appendChild(createItem('Previous', currentPage - 1, currentPage === 1));
        for (let i = 1; i <= totalPages; i++) {
            pagination.appendChild(createItem(i, i, false, i === currentPage));
        }
        pagination.appendChild(createItem('Next', currentPage + 1, currentPage === totalPages));
    }

    // Event listeners
    perPageSelect.addEventListener('change', () => {
        rowsPerPage = parseInt(perPageSelect.value);
        currentPage = 1;
        showPage(currentPage);
    });

    [statusFilter, startDateFilter, endDateFilter].forEach(input => {
        input.addEventListener('input', () => {
            applyFilters();
            currentPage = 1;
            showPage(currentPage);
        });
    });

    resetFilter.addEventListener('click', () => {
        statusFilter.value = '';
        startDateFilter.value = '';
        endDateFilter.value = '';
        applyFilters();
        currentPage = 1;
        showPage(currentPage);
    });

    // Init
    applyFilters();
    showPage(currentPage);
});
</script>

@endsection
