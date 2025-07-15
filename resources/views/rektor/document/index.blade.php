@extends('admin.layout')

@section('content')
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Laporan Permohonan Informasi Publik</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Dokumen
            </button>
        </div>
        
        <div class="table-responsive-sm mt-3">
            <table id="documentTable" class="table table-striped table-sm" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Nama Dokumen</th>
                        <th>Tahun Pembuatan</th>
                        <th>Tipe File</th>
                        <th>Size File</th>
                        <th>File</th>
                     
                
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Menampilkan name_pd_okpd -->
                        <p><strong>Nama PD OKPD:</strong> <span id="detailNamePdOkpd"></span></p>
                        <!-- Menampilkan document_name -->
                        <p><strong>Nama Dokumen:</strong> <span id="detailDocumentName"></span></p>
                        <!-- Menampilkan creation_year -->
                        <p><strong>Tahun:</strong> <span id="detailCreationYear"></span></p>
                        <!-- Menampilkan file_type -->
                        <p><strong>Jenis File:</strong> <span id="detailFileType"></span></p>
                        <!-- Menampilkan file_size -->
                        <p><strong>Ukuran File:</strong> <span id="detailFileSize"></span></p>
                        <!-- Menampilkan file untuk diunduh -->
                        <p><strong>File:</strong> <a id="detailFile" href="#" target="_blank">Unduh File</a></p>
                      
                        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('document.update') }}" method="POST" id="editReportForm" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Dokumen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <!-- ID Dokumen -->
                            <div class="mb-3">
                                <label for="documentId" class="form-label">ID Dokumen</label>
                                <input type="text" class="form-control" id="documentId" name="id" readonly>
                            </div>

                            <!-- Nama PD OKPD -->
                            <div class="mb-3">
                                <label for="documentNamePdOkpd" class="form-label">Nama PD OKPD</label>
                                <input type="text" class="form-control" id="documentNamePdOkpd" name="name_pd_okpd" required>
                            </div>

                            <!-- Nama Dokumen -->
                            <div class="mb-3">
                                <label for="documentDocumentName" class="form-label">Nama Dokumen</label>
                                <input type="text" class="form-control" id="documentDocumentName" name="document_name" required>
                            </div>

                            <!-- Tahun Pembuatan -->
                            <div class="mb-3">
                                <label for="documentCreationYear" class="form-label">Tahun Pembuatan</label>
                                <input type="number" class="form-control" id="documentCreationYear" name="creation_year" required>
                            </div>

                            <!-- Tipe File -->
                            <div class="mb-3">
                                <label for="documentFileType" class="form-label">Tipe File</label>
                                <input type="text" class="form-control" id="documentFileType" name="file_type" required>
                            </div>

                            <!-- Ukuran File -->
                            <div class="mb-3">
                                <label for="documentFileSize" class="form-label">Ukuran File (KB)</label>
                                <input type="number" class="form-control" id="documentFileSize" name="file_size" required>
                            </div>

                            <!-- File -->
                            <div class="mb-3">
                                <label for="documentFilePreview" class="form-label">File Sebelumnya</label>
                                <a id="documentFilePreview" href="#" target="_blank" class="d-block mb-2">Unduh File</a>
                                <input type="file" class="form-control" id="documentFile" name="file" accept=".pdf,.doc,.xlx,.xlsx">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('document.store') }}" method="POST" id="addReportForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Tambah Laporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Nama PD OKPD -->
                            <div class="mb-3">
                                <label for="addNamePdOkpd" class="form-label">Nama PD OKPD</label>
                                <input type="text" class="form-control" id="addNamePdOkpd" name="name_pd_okpd" required>
                            </div>

                            <!-- Nama Dokumen -->
                            <div class="mb-3">
                                <label for="addDocumentName" class="form-label">Nama Dokumen</label>
                                <input type="text" class="form-control" id="addDocumentName" name="document_name" required>
                            </div>

                            <!-- Tahun Pembuatan -->
                            <div class="mb-3">
                                <label for="addCreationYear" class="form-label">Tahun Pembuatan</label>
                                <input type="number" class="form-control" id="addCreationYear" name="creation_year" required>
                            </div>

                            <!-- Tipe File -->
                            <div class="mb-3">
                                <label for="addFileType" class="form-label">Tipe File</label>
                                <input type="text" class="form-control" id="addFileType" name="file_type" required>
                            </div>

                            <!-- Ukuran File -->
                            <div class="mb-3">
                                <label for="addFileSize" class="form-label">Ukuran File (KB)</label>
                                <input type="number" class="form-control" id="addFileSize" name="file_size" required>
                            </div>

                            <!-- File -->
                            <div class="mb-3">
                                <label for="addFile" class="form-label">Unggah File</label>
                                <input type="file" class="form-control" id="addFile" name="file" accept=".pdf,.doc,.xlx,.xlsx" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</div>

        
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const reportTable = $('#documentTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            responsive: true,
            ajax: {
                url: "{{ route('document.show') }}",  // URL endpoint untuk ambil data laporan
                type: 'GET',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name_pd_okpd', name: 'name_pd_okpd' },
                { data: 'document_name', name: 'document_name' },
                { data: 'creation_year', name: 'creation_year' },
                { data: 'file_type', name: 'file_type' },
                { data: 'file_size', name: 'file_size' },
                { data: 'file', name: 'file' },
                { data: 'actions', name: 'actions' },
                
            ]
        });
        $(document).on('click', '.edit-button', function () {
    const id = $(this).data('id');
    const namePdOkpd = $(this).data('name_pd_okpd');
    const documentName = $(this).data('document_name');
    const creationYear = $(this).data('creation_year');
    const fileType = $(this).data('file_type');
    const fileSize = $(this).data('file_size');
    const file = $(this).data('file');

    console.log({ id, namePdOkpd, documentName, creationYear, fileType, fileSize, file }); // Debugging
    // Isi data ke modal
    $('#documentId').val(id);
    $('#documentNamePdOkpd').val(namePdOkpd);
    $('#documentDocumentName').val(documentName);
    $('#documentCreationYear').val(creationYear);
    $('#documentFileType').val(fileType);
    $('#documentFileSize').val(fileSize);
    $('#documentFile').val(null); // Kosongkan input file
    if (file) {
        $('#documentFilePreview').attr('href', `/assets/file/${file}`).text("Unduh File");
    } else {
        $('#documentFilePreview').attr('href', '#').text('File tidak tersedia');
    }

    $('#editModal').modal('show');
});





        // Submit data edit menggunakan AJAX
        $('#editForm').on('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url: '{{ route("report.update") }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#editModal').modal('hide');
                    alert(response.message);
                    reportTable.ajax.reload(); // Refresh tabel
                },
                error: function (error) {
                    alert('Gagal memperbarui data!');
                }
            });
        });



        $(document).on('click', '.detail-button', function () {
            const id = $(this).data('id'); // Ambil ID
            const namePdOkpd = $(this).data('name_pd_okpd'); // Ambil name_pd_okpd
            const documentName = $(this).data('document_name'); // Ambil document_name
            const creationYear = $(this).data('creation_year'); // Ambil creation_year
            const fileType = $(this).data('file_type'); // Ambil file_type
            const fileSize = $(this).data('file_size'); // Ambil file_size
            const file = $(this).data('file'); // Ambil file

            // Isi data detail ke modal
            $('#detailNamePdOkpd').text(namePdOkpd); // Menampilkan name_pd_okpd
            $('#detailDocumentName').text(documentName); // Menampilkan document_name
            $('#detailCreationYear').text(creationYear); // Menampilkan creation_year
            $('#detailFileType').text(fileType); // Menampilkan file_type
            $('#detailFileSize').text(fileSize); // Menampilkan file_size

            // Menampilkan file di modal
            if (file) {
                $('#detailFile').attr('href', `/assets/file/${file}`); // Atur link file
                $('#detailFile').text('Unduh File'); // Menampilkan teks unduh file
                $('#detailFile').show(); // Menampilkan link file
            } else {
                $('#detailFile').hide(); // Menyembunyikan link file jika tidak ada file
            }

            // Tampilkan modal
            $('#detailModal').modal('show');
        });



        // Update status laporan
        $(document).on('change', '.status-dropdown', function () {
            const id = $(this).data('id');
            const status = $(this).val();
            $.ajax({
                url: '{{ route("report.updateStatus") }}',
                method: 'POST',
                data: {
                    id: id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert(response.message);
                },
            });
        });
    });
</script>
@endpush
