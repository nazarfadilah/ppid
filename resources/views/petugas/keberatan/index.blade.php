@extends('petugas.layout')

@section('content')
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Daftar Pengajuan Keberatan Publik</h3>
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

        <div class="alert alert-info mb-3">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle me-2"></i>
                <span>Total : <strong>{{ $totalObjection }}</strong></span>
            </div>
        </div>

        <!-- Filter dan PerPage -->
        <div class="row mb-3">
            <div class="col-md-9">
                <div class="row g-2">
                    <div class="col-md-3">
                        <select id="statusFilter" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="checking">Checking</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="startDateFilter" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="endDateFilter" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <button id="resetFilter" class="btn btn-secondary w-100">Reset</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <label for="perPage">Tampilkan</label>
                <select id="perPage" class="form-select d-inline-block w-auto">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                {{-- <span>data per halaman</span> --}}
            </div>
        </div>

        <!-- Tabel -->
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objection->sortByDesc('created_at') as $obj)
                    <tr data-date="{{ $obj->created_at->format('Y-m-d') }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obj->nama_pemohon }}</td>
                        <td>{{ $obj->alamat_pemohon }}</td>
                        <td>{{ $obj->pekerjaan_pemohon }}</td>
                        <td>{{ $obj->no_hp_pemohon }}</td>
                        <td>{{ $obj->email_pemohon }}</td>
                        <td>
                            @php $status = strtolower($obj->status); @endphp
                            @if($status === 'approved')
                                <button class="btn btn-success btn-sm" disabled>Dikonfirmasi</button>
                            @elseif($status === 'rejected')
                                <button class="btn btn-danger btn-sm" disabled>Ditolak</button>
                            @else
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal-{{ $obj->id }}">Approved</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $obj->id }}">Rejected</button>

                                <!-- Modal Approve -->
                                <div class="modal fade" id="approveModal-{{ $obj->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('objection.email.konfirmasi', $obj->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Keberatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="status" value="Approved">
                                                    <label class="form-label">Alasan Menyetujui</label>
                                                    <textarea name="reject_reason" class="form-control" rows="3" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Reject -->
                                <div class="modal fade" id="rejectModal-{{ $obj->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('objection.email.tolak', $obj->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Keberatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="status" value="Rejected">
                                                    <label class="form-label">Alasan Penolakan</label>
                                                    <textarea name="reject_reason" class="form-control" rows="3" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('petugas-keberatan-detail', $obj->id) }}" class="btn btn-sm btn-info">Detail</a>
                        </td>
                        <td>
                            <form action="{{ route('objections.destroy', $obj->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keberatan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const rows = Array.from(document.querySelectorAll('#objectionTable tbody tr'));
    const perPageSelect = document.getElementById('perPage');
    const statusFilter = document.getElementById('statusFilter');
    const startDateFilter = document.getElementById('startDateFilter');
    const endDateFilter = document.getElementById('endDateFilter');
    const resetBtn = document.getElementById('resetFilter');
    const pagination = document.getElementById('pagination');

    let currentPage = 1;

    function getFilteredRows() {
        const status = statusFilter.value;
        const start = startDateFilter.value;
        const end = endDateFilter.value;

        return rows.filter(row => {
            const rowStatus = row.cells[6].textContent.trim();
            const rowDate = row.getAttribute('data-date');

            const statusMatch = !status || rowStatus === status;
            const dateMatch = (!start || rowDate >= start) && (!end || rowDate <= end);

            return statusMatch && dateMatch;
        });
    }

    function displayPage(page) {
        const perPage = parseInt(perPageSelect.value);
        const filtered = getFilteredRows();
        const totalPages = Math.ceil(filtered.length / perPage);
        const start = (page - 1) * perPage;
        const end = start + perPage;

        rows.forEach(row => row.style.display = 'none');
        filtered.slice(start, end).forEach(row => row.style.display = '');

        currentPage = page;
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        pagination.innerHTML = '';

        const addButton = (label, page, disabled = false, active = false) => {
            const li = document.createElement('li');
            li.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.textContent = label;
            a.addEventListener('click', e => {
                e.preventDefault();
                if (!disabled) displayPage(page);
            });
            li.appendChild(a);
            pagination.appendChild(li);
        };

        addButton('Previous', currentPage - 1, currentPage === 1);
        for (let i = 1; i <= totalPages; i++) addButton(i, i, false, i === currentPage);
        addButton('Next', currentPage + 1, currentPage === totalPages);
    }

    perPageSelect.addEventListener('change', () => displayPage(1));
    [statusFilter, startDateFilter, endDateFilter].forEach(input => input.addEventListener('input', () => displayPage(1)));
    resetBtn.addEventListener('click', () => {
        statusFilter.value = '';
        startDateFilter.value = '';
        endDateFilter.value = '';
        displayPage(1);
    });

    displayPage(1);
});
</script>
@endsection
