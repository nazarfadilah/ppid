@extends('admin.layout')

@section('content')
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Galeri</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGalleryModal">Tambah</button>
            
            <div class="table-responsive mt-3">
                <table class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>File</th>
                        <th>Foto</th>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($reports as $key => $report)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $report->id }}</td>
                            <td>
                                <a href="{{ $report->file }}" target="_blank">{{ $report->file }}</a>
                            </td>
                            <td>
                                <img src="{{ asset($report->photo) }}" alt="Gambar Laporan" style="width: 100px; height: auto;" />
                            </td>

                            <td>{{ $report->type }}</td>
                            <td>{{ $report->year }}</td> 
                            <td>{{ $report->status }}</td> 
                            <td>
                                <!-- Tombol Ubah -->
                                <button class="btn btn-success editReportBtn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editreportModal"
                                    data-id="{{ $report->id }}" 
                                    data-name="{{ $report->name }}" 
                                    data-photo="{{ asset($report->photo) }}" 
                                    data-type="{{ $report->type }}" 
                                    data-year="{{ $report->year }}" 
                                    data-status="{{ $report->status }}">
                                Ubah
                            </button>


                                <!-- Form Hapus -->
                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Tambah -->
            <div class="modal fade" id="addGalleryModal" tabindex="-1" aria-labelledby="addGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGalleryModalLabel">Tambah Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('reports.store') }}" method="POST" id="addGalleryForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Upload File -->
                    <div class="mb-3">
                        <label for="reportFile" class="form-label">File Laporan</label>
                        <input type="file" 
                               class="form-control @error('file') is-invalid @enderror" 
                               id="reportFile" 
                               name="file" 
                               accept=".pdf,.doc,.docx" 
                               required>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Foto -->
                    <div class="mb-3">
                        <label for="reportPhoto" class="form-label">Foto</label>
                        <input type="file" 
                               class="form-control @error('photo') is-invalid @enderror" 
                               id="reportPhoto" 
                               name="photo" 
                               accept=".jpg,.jpeg,.png" 
                               required>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropdown Tipe -->
                    <div class="mb-3">
                        <label for="reportType" class="form-label">Tipe Laporan</label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                                id="reportType" 
                                name="type" 
                                required>
                            <option value="">Pilih Tipe</option>
                            <option value="ppid" {{ old('type') == 'ppid' ? 'selected' : '' }}>PPID</option>
                            <option value="finance" {{ old('type') == 'finance' ? 'selected' : '' }}>Keuangan</option>
                            <option value="performance" {{ old('type') == 'performance' ? 'selected' : '' }}>Kinerja</option>
                            <option value="administration" {{ old('type') == 'administration' ? 'selected' : '' }}>Administrasi</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dropdown Status -->
                    <div class="mb-3">
                        <label for="reportStatus" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="reportStatus" 
                                name="status" 
                                required>
                            <option value="">Pilih Status</option>
                            <option value="private" {{ old('status') == 'private' ? 'selected' : '' }}>Private</option>
                            <option value="public" {{ old('status') == 'public' ? 'selected' : '' }}>Public</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Tahun -->
                    <div class="mb-3">
                        <label for="reportYear" class="form-label">Tahun</label>
                        <input type="number" 
                               class="form-control @error('year') is-invalid @enderror" 
                               id="reportYear" 
                               name="year" 
                               min="1900" 
                               max="{{ now()->year }}" 
                               value="{{ old('year') }}" 
                               required>
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="addGalleryForm" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editreportModal" tabindex="-1" aria-labelledby="editreportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editreportModalLabel">Ubah Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editReportForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- ID Laporan (Readonly) -->
                    <div class="mb-3">
                        <label for="reportId" class="form-label">ID Laporan</label>
                        <input type="text" class="form-control" id="reportId" name="id" readonly>
                    </div>

                    <!-- Nama Laporan -->
                    <div class="mb-3">
                        <label for="reportName" class="form-label">Nama Laporan</label>
                        <input type="text" class="form-control" id="reportName" name="name" required>
                    </div>

                    <!-- Foto Laporan -->
                    <div class="mb-3">
                        <label for="reportPhotoPreview" class="form-label">Foto Sebelumnya</label>
                        <img id="reportPhotoPreview" src="" alt="Foto Laporan" class="img-thumbnail mb-2" style="max-width: 100%; height: auto;">
                        <input type="file" class="form-control" id="reportPhoto" name="photo" accept=".jpg,.jpeg,.png">
                    </div>

                    <!-- Dropdown Tipe -->
                    <div class="mb-3">
                        <label for="reportType" class="form-label">Tipe Laporan</label>
                        <select class="form-select" id="reportType" name="type" required>
                            <option value="ppid">PPID</option>
                            <option value="finance">Keuangan</option>
                            <option value="performance">Kinerja</option>
                            <option value="administration">Administrasi</option>
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div class="mb-3">
                        <label for="reportYear" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="reportYear" name="year" min="1900" max="{{ date('Y') }}" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="reportStatus" class="form-label">Status</label>
                        <select class="form-select" id="reportStatus" name="status" required>
                            <option value="private">Private</option>
                            <option value="public">Public</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="editReportForm" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

    </div>
    <script>
        document.querySelectorAll('.editReportBtn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const photo = this.getAttribute('data-photo');
        const type = this.getAttribute('data-type');
        const year = this.getAttribute('data-year');
        const status = this.getAttribute('data-status');

        // Set nilai field form
        document.getElementById('reportId').value = id;
        document.getElementById('reportName').value = name;
        document.getElementById('reportPhotoPreview').src = photo;
        document.getElementById('reportType').value = type;
        document.getElementById('reportYear').value = year;
        document.getElementById('reportStatus').value = status;

        // Set action form
        document.getElementById('editReportForm').action = `/reports/${id}`;
    });
});

    </script>
@endsection
