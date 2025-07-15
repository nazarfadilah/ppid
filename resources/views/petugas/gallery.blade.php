@extends('petugas.layout')

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
                        <th>Link</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($galleries as $key => $gallery)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $gallery->id }}</td>
                            <td>
                                <a href="{{ $gallery->link }}" target="_blank">{{ $gallery->link }}</a>
                            </td>
                            <td>{{ $gallery->title }}</td>
                            <td>{{ $gallery->description }}</td>
                            <td>{{ $gallery->date }}</td> <!-- Format sudah disesuaikan di accessor -->
                            <td>
                                <!-- Tombol Ubah -->
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editGalleryModal"
                                        data-id="{{ $gallery->id }}" data-name="{{ $gallery->name }}">
                                    Ubah
                                </button>

                                <!-- Form Hapus -->
                                <form action="{{ route('api/g', $gallery->id) }}" method="POST" style="display:inline;">
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
                        <h5 class="modal-title" id="addGalleryModalLabel">Tambah Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('galleries.store') }}" method="POST" id="addGalleryForm">
                            @csrf
                            <!-- Form untuk menambah galeri baru -->
                            <div class="mb-3">
                                <label for="galleryTitle" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="galleryTitle" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="galleryDescription" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="galleryDescription" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="galleryLink" class="form-label">Link</label>
                                <input type="url" class="form-control" id="galleryLink" name="link" required>
                            </div>
                            <div class="mb-3">
                                <label for="galleryDate" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="galleryDate" name="date" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="addGalleryForm" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editTypeModal" tabindex="-1" aria-labelledby="editTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTypeModalLabel">Ubah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="editTypeForm">
                            <!-- @csrf
                            @method('PUT') -->
                            <div class="mb-3">
                                <label for="typeId" class="form-label">ID Tipe</label>
                                <input type="text" class="form-control" id="typeId" name="typeId" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tipeName" class="form-label">Nama Tipe</label>
                                <input type="text" class="form-control" id="tipeName" name="types_name" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="editTypeForm" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
