@extends('rektor.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title mb-0 p-0">Statistik & Data Whistle Blowing</h3>
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
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="rejected">Rejected</option>
                            <option value="finished">Finished</option>
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
                <div class="card"><div class="card-body"><canvas id="statisticChart" style="height: 320px;"></canvas></div></div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-6 mb-3"><div class="card bg-primary text-white"><div class="card-body"><h5 class="card-title">Total</h5><h2 id="totalRequests">0</h2></div></div></div>
                    <div class="col-6 mb-3"><div class="card bg-success text-white"><div class="card-body"><h5 class="card-title">Dikonfirmasi</h5><h2 id="confirmedRequests">0</h2></div></div></div>
                    <div class="col-6 mb-3"><div class="card bg-danger text-white"><div class="card-body"><h5 class="card-title">Ditolak</h5><h2 id="rejectedRequests">0</h2></div></div></div>
                    <div class="col-6 mb-3"><div class="card bg-warning text-white"><div class="card-body"><h5 class="card-title">Selesai</h5><h2 id="finishedRequests">0</h2></div></div></div>
                    <div class="col-12"><div class="card bg-info text-dark"><div class="card-body"><h5 class="card-title">Pending</h5><h2 id="pendingRequests">0</h2></div></div></div>
                </div>
            </div>
        </div>

        <hr>

        <h4 class="mt-4">Detail Laporan Whistle Blowing</h4>
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
                        <th>Nama Pelapor</th>
                        <th>Email</th>
                        <th>Tindakan</th>
                        <th>Nama Terlapor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="whistleTableBody">
                    {{-- Data awal ditampilkan di sini --}}
                    @forelse($whistles as $whistle)
                    <tr>
                        <td>{{ $loop->iteration + ($whistles->currentPage() - 1) * $whistles->perPage() }}</td>
                        <td>{{ $whistle->nama }}</td>
                        <td>{{ $whistle->email }}</td>
                        <td>{{ Str::limit($whistle->tindakan, 25) }}</td>
                        <td>{{ $whistle->nama_terlapor }}</td>
                        <td>
                            @if($whistle->status == 'confirmed') <span class="badge bg-info">Confirmed</span>
                            @elseif($whistle->status == 'rejected') <span class="badge bg-danger">Rejected</span>
                            @elseif($whistle->status == 'finished') <span class="badge bg-success">Finished</span>
                            @else <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <nav>
            <div id="pagination-links" class="mt-3 d-flex justify-content-center">
                {{ $whistles->links('pagination::bootstrap-5') }}
            </div>
        </nav>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const initialData = @json($initialChartData);
    let statisticChart = null;

    const statusFilter = document.getElementById('statusFilter');
    const startDateFilter = document.getElementById('startDate');
    const endDateFilter = document.getElementById('endDate');
    const perPageSelect = document.getElementById('perPage');

    function fetchData(page = 1) {
        const filters = { status: statusFilter.value, startDate: startDateFilter.value, endDate: endDateFilter.value, perPage: perPageSelect.value, page: page };
        const url = "{{ route('rektor.whistle.data') }}?" + new URLSearchParams(filters);
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => response.ok ? response.json() : Promise.reject('Network Error'))
            .then(data => {
                updateChart(data.chartData);
                updateSummaryStats(data.chartData.summary);
                document.getElementById('whistleTableBody').innerHTML = data.table_html;
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
                datasets: [{ data: chartData.byStatus.values, backgroundColor: ['#36b9cc', '#e74a3b', '#1cc88a', '#f6c23e', '#4e73df'] }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { title: { display: true, text: 'Laporan Whistle Blowing Berdasarkan Status' } } }
        });
    }

    function updateSummaryStats(summary) {
        document.getElementById('totalRequests').textContent = summary.total || 0;
        document.getElementById('confirmedRequests').textContent = summary.confirmed || 0;
        document.getElementById('rejectedRequests').textContent = summary.rejected || 0;
        document.getElementById('finishedRequests').textContent = summary.finished || 0;
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
                if (page) fetchData(page);
            }
        });
    }
    initialize();
});
</script>
@endsection
