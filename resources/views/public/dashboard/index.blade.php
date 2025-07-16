@extends('public.layout.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Dashboard</h3>
        <p class="text-muted">Selamat datang di dasbor Publik!</p>
    </div>

    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="fw-bold">Statistik Layanan Informasi Publik</h4>
            </div>
        </div>
        <div class="mb-4"></div>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('public.information-requests') }}" class="text-decoration-none">
                    <div class="card bg-primary text-white shadow-sm h-100 rounded-3 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                            <h2 class="display-4 fw-bold mb-3">{{ $publicInformationRequests }}</h2>
                            <p class="card-text">Daftar Permohonan Informasi Publik</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('public.objections') }}" class="text-decoration-none">
                    <div class="card bg-success text-white shadow-sm h-100 rounded-3 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                            <h2 class="display-4 fw-bold mb-3">{{ $objections }}</h2>
                            <p class="card-text">Keberatan</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('public.whistles') }}" class="text-decoration-none">
                    <div class="card bg-danger text-white shadow-sm h-100 rounded-3 border-0">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center py-4">
                            <h2 class="display-4 fw-bold mb-3">{{ $whistles }}</h2>
                            <p class="card-text">Laporan Pengaduan</p>
                        </div>
                    </div>
                </a>
            </div>

            
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-wrapper {
        min-height: calc(100vh - 60px);
    }

    .page-breadcrumb {
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .card {
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
