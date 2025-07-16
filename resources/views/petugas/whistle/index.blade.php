@extends('petugas.layout')

@section('content')
<div class="container">
    <h3>Laporan Pengaduan Whistle Blowing</h3>

    <div class="alert alert-info mb-3">
        <div class="d-flex align-items-center">
            <i class="bi bi-info-circle me-2"></i>
            <span>Total Laporan Pengaduan: <strong>{{ $totalWhistle }}</strong></span>
        </div>
    </div>
    <!-- Filter -->
    <div class="row mb-3">
        <div class="col-md-9">
            <div class="row g-2">
                <div class="col-md-3">
                    <select id="statusFilter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending">Menunggu Konfirmasi</option>
                        <option value="confirmed">Dikonfirmasi</option>
                        <option value="finished">Selesai</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" id="startDateFilter" class="form-control" placeholder="Tanggal Awal">
                </div>
                <div class="col-md-3">
                    <input type="date" id="endDateFilter" class="form-control" placeholder="Tanggal Akhir">
                </div>
                <div class="col-md-2">
                    <button id="resetFilter" class="btn btn-secondary w-100">Reset</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex align-items-center">
                <label for="perPage" >Tampilkan</label>
                <select id="perPage" class="form-select d-inline-block w-auto">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                {{-- <span>data per halaman</span> --}}
            </div>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($whistles->sortByDesc('created_at') as $whistle)
                <tr data-date="{{ $whistle->created_at->format('Y-m-d') }}" data-status="{{ $whistle->status }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $whistle->nama }}</td>
                    <td>{{ $whistle->no_hp }}</td>
                    <td>{{ $whistle->email }}</td>
                    <td>{{ $whistle->tindakan }}</td>
                    <td>{{ $whistle->nama_terlapor }}</td>
                    <td>
                        @if($whistle->status == 'pending')
                            <span class="badge bg-warning text-dark mb-1">Menunggu Konfirmasi</span><br>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $whistle->id }}">Konfirmasi</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $whistle->id }}">Tolak</button>

                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="confirmModal{{ $whistle->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('whistle.confirm', $whistle->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="confirmed">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Laporan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea class="form-control" name="alasan" rows="3" placeholder="Alasan konfirmasi..." required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button class="btn btn-success" type="submit">Konfirmasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Tolak -->
                            <div class="modal fade" id="rejectModal{{ $whistle->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('whistle.reject', $whistle->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tolak Laporan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea class="form-control" name="alasan" rows="3" placeholder="Alasan penolakan..." required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button class="btn btn-danger" type="submit">Tolak</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @elseif($whistle->status == 'confirmed')
                            <span class="badge bg-info mb-1">Dikonfirmasi</span><br>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#finishModal{{ $whistle->id }}">Selesai</button>

                            <!-- Modal Selesai -->
                            <div class="modal fade" id="finishModal{{ $whistle->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('whistle.finish', $whistle->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="finished">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Selesaikan Laporan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea class="form-control" name="alasan" rows="3" placeholder="Keterangan penyelesaian..." required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button class="btn btn-success" type="submit">Selesai</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @elseif($whistle->status == 'finished')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($whistle->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">Tidak Diketahui</span>
                        @endif
                    </td>
                    <td><a href="{{ route('petugas-whistle-bowling-detail', $whistle->id) }}" class="btn btn-sm btn-info">Detail</a></td>
                    <td>
                        <form action="{{ route('whistles.destroy', $whistle->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <nav><ul class="pagination justify-content-center" id="pagination"></ul></nav>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('whistleTable');
    const perPageSelect = document.getElementById('perPage');
    const pagination = document.getElementById('pagination');
    const statusFilter = document.getElementById('statusFilter');
    const startDateFilter = document.getElementById('startDateFilter');
    const endDateFilter = document.getElementById('endDateFilter');
    const resetFilter = document.getElementById('resetFilter');

    let currentPage = 1;
    let rowsPerPage = parseInt(perPageSelect.value);

    perPageSelect.addEventListener('change', () => {
        rowsPerPage = parseInt(perPageSelect.value);
        currentPage = 1;
        renderTable();
    });

    [statusFilter, startDateFilter, endDateFilter].forEach(filter => {
        filter.addEventListener('input', () => {
            currentPage = 1;
            renderTable();
        });
    });

    resetFilter.addEventListener('click', () => {
        statusFilter.value = '';
        startDateFilter.value = '';
        endDateFilter.value = '';
        currentPage = 1;
        renderTable();
    });

    function getFilteredRows() {
        const status = statusFilter.value;
        const start = startDateFilter.value;
        const end = endDateFilter.value;

        return Array.from(table.querySelectorAll('tbody tr')).filter(row => {
            const rowStatus = row.dataset.status;
            const rowDate = row.dataset.date;

            const matchStatus = !status || rowStatus === status;
            const matchStart = !start || rowDate >= start;
            const matchEnd = !end || rowDate <= end;

            return matchStatus && matchStart && matchEnd;
        });
    }

    function renderPagination(totalPages) {
        pagination.innerHTML = '';

        const prev = document.createElement('li');
        prev.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prev.innerHTML = `<a class="page-link" href="#">Previous</a>`;
        prev.onclick = e => {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        };
        pagination.appendChild(prev);

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${currentPage === i ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.onclick = e => {
                e.preventDefault();
                currentPage = i;
                renderTable();
            };
            pagination.appendChild(li);
        }

        const next = document.createElement('li');
        next.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        next.innerHTML = `<a class="page-link" href="#">Next</a>`;
        next.onclick = e => {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        };
        pagination.appendChild(next);
    }

    function renderTable() {
        const rows = getFilteredRows();
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const totalPages = Math.ceil(rows.length / rowsPerPage);

        table.querySelectorAll('tbody tr').forEach(row => row.style.display = 'none');
        rows.slice(startIndex, endIndex).forEach(row => row.style.display = '');

        renderPagination(totalPages);
    }

    renderTable();
});
</script>
@endsection
