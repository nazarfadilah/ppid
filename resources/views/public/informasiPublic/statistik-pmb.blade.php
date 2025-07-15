@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 110px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Statistik PMB Tahun Akademik 2024/2025</h2>
    </div>
    <div class="d-flex justify-content-center flex-wrap gap-4">
        <div class="card shadow-sm" style="width: 420px;">
            <div class="card-body">
                <img src="{{ asset('images/statistik.png') }}" alt="Statistik PMB 2024/2025 - 1" class="img-fluid" />
            </div>
        </div>
        <div class="card shadow-sm" style="width: 420px;">
            <div class="card-body">
                <img src="{{ asset('images/statistik1.png') }}" alt="Statistik PMB 2024/2025 - 2" class="img-fluid" />
            </div>
        </div>
    </div>
</div>

@endsection
