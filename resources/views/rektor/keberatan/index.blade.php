@extends('rektor.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title mb-0 p-0">Statistik & Data Keberatan Informasi</h3>
    </div>

    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header"><h5 class="card-title">Filter Statistik & Data</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select id="statusFilter" class="form-select">
                            <option value="all">Semua Status</option>
                            <option value="Checking">Checking</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="startDate" class="form-label">Dari Tanggal</label>
                        <input type="date" id="startDate" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="endDate" class="form-label">Sampai Tanggal</label>
                        <input type="date" id="endDate" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="card"><div class="card-body"><canvas id="statisticChart" style="height: 300px;"></canvas></div></div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-6 mb-3"><div class="card bg-primary text-white"><div class="card-body"><h5 class="card-title">Total</h5><h2 id="totalRequests">0</h2></div></div></div>
                    <div class="col-6 mb-3"><div class="card bg-success text-white"><div class="card-body"><h5 class="card-title">Diterima</h5><h2 id="approvedRequests">0</h2></div></div></div>
                    <div class="col-6"><div class="card bg-danger text-white"><div class="card-body"><h5 class="card-title">Ditolak</h5><h2 id="rejectedRequests">0</h2></div></div></div>
                    <div class="col-6"><div class="card bg-warning text-dark"><div class="card-body"><h5 class="card-title">Proses</h5><h2 id="pendingRequests">0</h2></div></div></div>
                </div>
            </div>
        </div>

        <hr>

        <h4 class="mt-4">Detail Data Keberatan</h4>
        <div class="row mb-3">
            <div class="col-md-6 text-end ms-auto">
                <label for="perPage">Tampilkan</label>
                <select id="perPage" class="form-select d-inline-block w-auto">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                </select>
                <span class="ms-1">data per halaman</span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemohon</th>
                        <th>Email</th>
                        <th>Alasan Pengajuan</th>
                        <th>Status</th>
                        <th>Tanggal Diajukan</th>
                    </tr>
                </thead>
                <tbody id="objectionTableBody">
                    {{-- Loop ini hanya untuk menampilkan data saat halaman pertama kali dibuka --}}
                    @forelse($objections as $obj)
                    <tr>
                        <td>{{ $loop->iteration + ($objections->currentPage() - 1) * $objections->perPage() }}</td>
                        <td>{{ $obj->nama_pemohon }}</td>
                        <td>{{ $obj->email_pemohon }}</td>
                        <td>{{ Str::limit($obj->alasan_pengajuan, 30) }}</td>
                        <td>
                            @if($obj->status == 'Approved') <span class="badge bg-success">Approved</span>
                            @elseif($obj->status == 'Rejected') <span class="badge bg-danger">Rejected</span>
                            @else <span class="badge bg-warning">Checking</span>
                            @endif
                        </td>
                        <td>{{ $obj->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <nav>
            <div id="pagination-links" class="mt-3 d-flex justify-content-center">
                {{-- Paginasi awal --}}
                {{ $objections->links('pagination::bootstrap-5') }}
            </div>
        </nav>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// KODE JAVASCRIPT INI TIDAK PERLU DIUBAH SAMA SEKALI DARI VERSI SEBELUMNYA
document.addEventListener('DOMContentLoaded', function () {
    const initialData = @json($initialChartData); // eslint-disable-line
    let statisticChart = null;
    const statusFilter = document.getElementById('statusFilter');
    const startDateFilter = document.getElementById('startDate');
    const endDateFilter = document.getElementById('endDate');
    const perPageSelect = document.getElementById('perPage');

    function fetchData(page = 1) {
        const filters = { status: statusFilter.value, startDate: startDateFilter.value, endDate: endDateFilter.value, perPage: perPageSelect.value, page: page };
        const url = "{{ route('rektor.keberatan.data') }}?" + new URLSearchParams(filters);
        fetch(url)
            .then(response => response.ok ? response.json() : Promise.reject('Network Error'))
            .then(data => {
                updateChart(data.chartData);
                updateSummaryStats(data.chartData.summary);
                document.getElementById('objectionTableBody').innerHTML = data.table_html;
                document.getElementById('pagination-links').innerHTML = data.pagination_html;
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function updateChart(chartData) {
        if (statisticChart) statisticChart.destroy();
        const ctx = document.getElementById('statisticChart').getContext('2d');
        statisticChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartData.byStatus.labels,
                datasets: [{ data: chartData.byStatus.values, backgroundColor: ['#1cc88a', '#e74a3b', '#f6c23e', '#858796'] }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { title: { display: true, text: 'Keberatan Berdasarkan Status' } } }
        });
    }

    function updateSummaryStats(summary) {
        document.getElementById('totalRequests').textContent = summary.total || 0;
        document.getElementById('approvedRequests').textContent = summary.approved || 0;
        document.getElementById('rejectedRequests').textContent = summary.rejected || 0;
        document.getElementById('pendingRequests').textContent = summary.pending || 0;
    }

    function formatDate(date) { return date.toISOString().split('T')[0]; }

    function initialize() {
        const today = new Date();
        startDateFilter.value = formatDate(new Date(today.getFullYear(), today.getMonth(), 1));
        endDateFilter.value = formatDate(new Date(today.getFullYear(), today.getMonth() + 1, 0));

        updateChart(initialData);
        updateSummaryStats(initialData.summary);

        [statusFilter, startDateFilter, endDateFilter, perPageSelect].forEach(el => {
            el.addEventListener('change', () => fetchData(1));
        });

        document.getElementById('pagination-links').addEventListener('click', function(e) {
            if (e.target.tagName === 'A' && e.target.classList.contains('page-link')) {
                e.preventDefault();
                const url = new URL(e.target.href);
                const page = url.searchParams.get('page');
                if (page) {
                    fetchData(page);
                }
            }
        });
    }

    initialize();
});
</script>
@endsection
