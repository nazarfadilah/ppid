@extends('petugas.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Daftar Pengajuan Informasi Publik</h3>
    </div>
    <div class="alert alert-info mb-3">
        <div class="d-flex align-items-center">
            <i class="bi bi-info-circle me-2"></i>
            <span>Total : <strong>{{ $totalPublicInformationRequest }}</strong></span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-9">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests->sortByDesc('created_at') as $request)
                    <tr data-date="{{ $request->created_at->format('Y-m-d') }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($request->request_category) }}</td>
                        <td>{{ $request->nama_pemohon }}</td>
                        <td>{{ $request->nik }}</td>
                        <td>{{ $request->no_hp }}</td>
                        <td>{{ $request->email }}</td>
                        <td>{{ $request->informasi_terkait }}</td>
                        <td>
                            @php
                                $status = strtolower($request->status);
                            @endphp
                            @if($status === 'approved')
                                <button class="btn btn-success btn-sm" disabled>Dikonfirmasi</button>
                            @elseif($status === 'rejected')
                                <button class="btn btn-danger btn-sm" disabled>Ditolak</button>
                            @else
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal-{{ $request->id }}">Approve</button>
                                <div class="modal fade" id="approveModal-{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('requests.updateStatus', $request->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Approved">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Persetujuan Permohonan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Alasan Persetujuan</label>
                                                        <textarea name="reject_reason" class="form-control" rows="3" required></textarea>
                                                        <small class="text-muted">Akan dikirim ke email pemohon</small>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Upload Dokumen</label>
                                                        <input type="file" name="lampiran" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Kirim</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $request->id }}">Reject</button>
                                <div class="modal fade" id="rejectModal-{{ $request->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('requests.rejectStatus', $request->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="Rejected">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Penolakan Permohonan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Alasan Penolakan</label>
                                                        <textarea name="reject_reason" class="form-control" rows="3" required></textarea>
                                                        <small class="text-muted">Akan dikirim ke email pemohon</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Tolak Permohonan</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('petugas-informasi-detail', $request->id) }}" class="btn btn-info btn-sm" style="font-size: 0.5rem;">Detail</a>
                        </td>
                        <td>
                            <form action="{{ route('public-information-requests.destroy', $request->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-xs py-1 px-2" style="font-size: 0.75rem;">Hapus</button>
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
    const perPageSelect = document.getElementById('perPage');
    const statusFilter = document.getElementById('statusFilter');
    const startDateFilter = document.getElementById('startDateFilter');
    const endDateFilter = document.getElementById('endDateFilter');
    const resetFilter = document.getElementById('resetFilter');
    const tableRows = Array.from(document.querySelectorAll('#requestTable tbody tr'));
    const pagination = document.getElementById('pagination');

    let currentPage = 1;

    function getFilteredRows() {
        const selectedStatus = statusFilter.value;
        const start = startDateFilter.value;
        const end = endDateFilter.value;

        return tableRows.filter(row => {
            const status = row.cells[7].textContent.trim();
            const date = row.getAttribute('data-date');
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
                    displayPage(currentPage);
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

    // Event Listeners
    perPageSelect.addEventListener('change', () => displayPage(1));
    [statusFilter, startDateFilter, endDateFilter].forEach(input => {
        input.addEventListener('input', () => displayPage(1));
    });
    resetFilter.addEventListener('click', () => {
        statusFilter.value = '';
        startDateFilter.value = '';
        endDateFilter.value = '';
        displayPage(1);
    });

    // Inisialisasi
    displayPage(1);
});
</script>
@endsection
