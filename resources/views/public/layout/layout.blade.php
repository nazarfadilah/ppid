<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="{{ asset('images/logo_kaltim.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Di head -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('public.layout.navbar')
            <nav class="col-md-2 d-flex flex-column flex-shrink-0 p-3 bg-light ">
                <div class="sidebar-sticky">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-black {{ request()->routeIs('public-dashboard*') ? 'active' : '' }}" aria-current="page" href="{{ route('public-dashboard') }}">
                            <img src="{{ asset('assets/dashboard.svg') }}" alt="Dashboard" style="width: 20px; height: 20px; margin-right: 5px;">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-black {{ request()->routeIs('public.information-requests*') ? 'active' : '' }}" href="{{ route('public.information-requests') }}">
                                <img src="{{ asset('assets/user.svg') }}" alt="Users" style="width: 20px; height: 20px; margin-right: 5px;">
                                Informasi
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-black {{ request()->routeIs('public.objections*') ? 'active' : '' }}" href="{{ route('public.objections') }}">
                            <img src="{{ asset('assets/product.svg') }}" alt="Objection" style="width: 20px; height: 20px; margin-right: 5px;">
                                Keberatan
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-black {{ request()->routeIs('public.whistles*') ? 'active' : '' }}" href="{{ route('public.whistles') }}">
                            <img src="{{ asset('assets/admin.svg') }}" alt="Admins" style="width: 19px; height: 19px; margin-right: 6px;">
                                Laporan
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-black {{ request()->routeIs('settings*') ? 'active' : '' }}" href="">
                            <img src="{{ asset('assets/gear.svg') }}" alt="Settings" style="width: 20px; height: 20px; margin-right: 5px;">
                                Pengaturan
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-black" href="#" onclick="event.preventDefault(); if(confirm('Apakah anda yakin ingin logout?')) { document.getElementById('logout-form').submit(); }">
                                <img src="{{ asset('assets/logout.svg') }}" alt="Logout" style="width: 20px; height: 20px; margin-right: 5px;">
                                Keluar
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('api-logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </nav>
            <form id="logout-form" action="{{ route('api-logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Di akhir body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script> -->

    @stack('scripts')
</body>
</html>
