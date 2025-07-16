@extends('admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Daftar User </h3>
    </div>
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 text-end">
                    <div>
                    <form action="{{ request()->url() }}" method="GET" class="mb-3">
                        <div class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <select id="userFilter" class="form-select">
                                        <option value="">Semua User</option>
                                        <option value="3">Petugas</option>
                                        <option value="4">User/Publik</option>
                                    </select>
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
            <table class="table table-bordered table-hover" id="requestTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users->filter(fn($user) => $user->user_level_id == 3 || $user->user_level_id == 4)->sortByDesc(fn($user) => $user->user_level_id == 3 ? 1 : 0)->values() as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($user->name) }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->user_level_id == 3 ? 'Petugas' : 'User/Publik' }}
                        </td>
                        <td>
                            <form action="{{ route('admin.user.hapus', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
document.addEventListener('DOMContentLoaded', function() {
    const perPageSelect = document.getElementById('perPage');
    const userFilter = document.getElementById('userFilter');
    const resetFilterBtn = document.getElementById('resetFilter');
    const tableRows = Array.from(document.querySelectorAll('#requestTable tbody tr'));
    const paginationContainer = document.getElementById('pagination');

    let currentPage = 1;

    function getFilteredRows() {
        const selectedUser = userFilter.value;

        return tableRows.filter(row => {
            const userRole = row.cells[3].textContent.trim();

            if (selectedUser === '3') {
                return userRole.includes('Petugas');
            } else if (selectedUser === '4') {
                return userRole.includes('User/Publik');
            }

            return true; // Tampilkan semua jika tidak ada filter
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
        paginationContainer.innerHTML = '';

        const createPageItem = (text, pageNum, disabled = false, active = false) => {
            const li = document.createElement('li');
            li.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.textContent = text;
            a.addEventListener('click', function(e) {
                e.preventDefault();
                if (!disabled) {
                    displayPage(pageNum);
                }
            });
            li.appendChild(a);
            return li;
        };

        paginationContainer.appendChild(createPageItem('Previous', currentPage - 1, currentPage === 1));

        for (let i = 1; i <= totalPages; i++) {
            paginationContainer.appendChild(createPageItem(i, i, false, i === currentPage));
        }

        paginationContainer.appendChild(createPageItem('Next', currentPage + 1, currentPage === totalPages));
    }

    userFilter.addEventListener('change', () => {
        currentPage = 1;
        displayPage(currentPage);
    });

    perPageSelect.addEventListener('change', () => {
        currentPage = 1;
        displayPage(currentPage);
    });

    if (resetFilterBtn) {
        resetFilterBtn.addEventListener('click', () => {
            userFilter.value = '';
            currentPage = 1;
            displayPage(currentPage);
        });
    }

    // Tampilkan halaman pertama saat awal load
    displayPage(1);
});
</script>

@endsection
