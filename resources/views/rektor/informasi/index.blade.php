@extends('rektor.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Statistik Permohonan Informasi Publik</h3>
    </div>

    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header"><h5 class="card-title">Filter Data</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="statusFilter" class="form-label">Status</label>
                        <select id="statusFilter" class="form-select">
                            <option value="all">Semua Status</option>
                            <option value="Checking">Checking</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="startDate" class="form-label">Dari Tanggal</label>
                        <input type="date" id="startDate" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="endDate" class="form-label">Sampai Tanggal</label>
                        <input type="date" id="endDate" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="periodFilter" class="form-label">Periode (untuk Tren)</label>
                        <select id="periodFilter" class="form-select">
                            <option value="daily">Harian</option>
                            <option value="monthly" selected>Bulanan</option>
                            <option value="yearly">Tahunan</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 text-end">
                        <button id="applyFilters" class="btn btn-primary">Terapkan Filter</button>
                        <button id="resetFilters" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header"><h5 class="card-title">Jenis Grafik</h5></div>
            <div class="card-body">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary chart-type-btn active" data-chart="requestByStatus">Permohonan per Status</button>
                    <button type="button" class="btn btn-outline-primary chart-type-btn" data-chart="requestByCategory">Permohonan per Kategori</button>
                    <button type="button" class="btn btn-outline-primary chart-type-btn" data-chart="requestTrend">Tren Permohonan</button>
                    <button type="button" class="btn btn-outline-primary chart-type-btn" data-chart="responseTime">Waktu Respon Rata-rata</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chartContainer" style="height: 400px; position: relative;"><canvas id="statisticChart"></canvas></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white"><div class="card-body"><h5 class="card-title">Total Permohonan</h5><h2 id="totalRequests">0</h2></div></div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white"><div class="card-body"><h5 class="card-title">Permohonan Disetujui</h5><h2 id="approvedRequests">0</h2></div></div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white"><div class="card-body"><h5 class="card-title">Permohonan Ditolak</h5><h2 id="rejectedRequests">0</h2></div></div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark"><div class="card-body"><h5 class="card-title">Dalam Proses</h5><h2 id="pendingRequests">0</h2></div></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const initialData = @json($initialChartData);
    let currentChartType = 'requestByStatus';
    let statisticChart = null;
    const statusFilter = document.getElementById('statusFilter');
    const startDateFilter = document.getElementById('startDate');
    const endDateFilter = document.getElementById('endDate');
    const periodFilter = document.getElementById('periodFilter');
    const applyFiltersBtn = document.getElementById('applyFilters');
    const resetFiltersBtn = document.getElementById('resetFilters');
    const chartTypeButtons = document.querySelectorAll('.chart-type-btn');

    function setDefaultDates() {
        const today = new Date();
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        startDateFilter.value = formatDate(firstDay);
        endDateFilter.value = formatDate(lastDay);
    }

    setDefaultDates();
    updateSummaryStats(initialData.summary);
    renderChart(initialData, currentChartType);

    applyFiltersBtn.addEventListener('click', loadStatistics);
    resetFiltersBtn.addEventListener('click', resetFilters);

    chartTypeButtons.forEach(button => {
        button.addEventListener('click', function() {
            chartTypeButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            currentChartType = this.getAttribute('data-chart');
            loadStatistics();
        });
    });

    function loadStatistics() {
        const filters = { status: statusFilter.value, startDate: startDateFilter.value, endDate: endDateFilter.value, period: periodFilter.value };
        fetch("{{ route('rektor-informasi-statistics') }}?" + new URLSearchParams(filters))
            .then(response => response.ok ? response.json() : Promise.reject('Network response was not ok'))
            .then(data => {
                updateSummaryStats(data.summary);
                renderChart(data, currentChartType);
            })
            .catch(error => {
                console.error('Error fetching statistics:', error);
                alert('Gagal memuat data statistik. Silakan coba lagi.');
            });
    }

    function renderChart(data, chartType) {
        if (statisticChart) statisticChart.destroy();
        const ctx = document.getElementById('statisticChart').getContext('2d');
        let chartConfig = {};
        const commonOptions = { responsive: true, maintainAspectRatio: false, plugins: { title: { display: true, font: { size: 16 } } } };
        switch(chartType) {
            case 'requestByStatus':
                chartConfig = { ...commonOptions, type: 'doughnut', data: { labels: data.byStatus.labels, datasets: [{ data: data.byStatus.values, backgroundColor: ['#1cc88a', '#e74a3b', '#f6c23e', '#858796', '#4e73df'] }] } };
                chartConfig.options.plugins.title.text = 'Permohonan Berdasarkan Status';
                break;
            case 'requestByCategory':
                chartConfig = { ...commonOptions, type: 'pie', data: { labels: data.byCategory.labels, datasets: [{ data: data.byCategory.values, backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'] }] } };
                chartConfig.options.plugins.title.text = 'Permohonan Berdasarkan Kategori';
                break;
            case 'requestTrend':
                chartConfig = { ...commonOptions, type: 'line', data: { labels: data.trend.labels, datasets: [{ label: 'Jumlah Permohonan', data: data.trend.values, borderColor: '#4e73df', backgroundColor: 'rgba(78, 115, 223, 0.1)', fill: true, tension: 0.1 }] } };
                chartConfig.options.plugins.title.text = `Tren Permohonan (${periodFilter.options[periodFilter.selectedIndex].text})`;
                chartConfig.options.scales = { y: { beginAtZero: true, ticks: { precision: 0 } } };
                break;
            case 'responseTime':
                chartConfig = { ...commonOptions, type: 'bar', data: { labels: data.responseTime.labels, datasets: [{ label: 'Waktu Respons (Hari)', data: data.responseTime.values, backgroundColor: '#36b9cc' }] } };
                chartConfig.options.plugins.title.text = 'Waktu Respon Rata-rata per Kategori';
                chartConfig.options.scales = { y: { beginAtZero: true } };
                break;
        }
        statisticChart = new Chart(ctx, chartConfig);
    }

    function updateSummaryStats(summary) {
        document.getElementById('totalRequests').textContent = summary.total || 0;
        document.getElementById('approvedRequests').textContent = summary.approved || 0;
        document.getElementById('rejectedRequests').textContent = summary.rejected || 0;
        document.getElementById('pendingRequests').textContent = summary.pending || 0;
    }

    function resetFilters() {
        statusFilter.value = 'all';
        setDefaultDates();
        periodFilter.value = 'monthly';
        loadStatistics();
    }

    function formatDate(date) { return date.toISOString().split('T')[0]; }
});
</script>
@endsection
