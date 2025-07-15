@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 90px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Form Pengaduan Whistleblowing</h2>
        <p class="text-muted">Silakan isi data di bawah ini dengan lengkap dan benar</p>
    </div>

    {{-- Adjusted form action to point to the 'store' method, common in Laravel resource routing --}}
    <form action="{{ route('whistles-create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('POST') is implicit and not strictly needed when the form's method is POST --}}
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Pelapor <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Pelapor" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Telepon/HP/WA Pelapor <span class="text-danger">*</span></label>
                    <input type="text" name="no_hp" class="form-control" placeholder="Masukkan Nomor Telepon atau WhatsApp" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat E-mail <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Alamat Email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tindakan / Perbuatan yang Dilaporkan <span class="text-danger">*</span></label>
                    <select name="tindakan" class="form-select" required>
                        <option value="">-- Pilih Tindakan --</option>
                        <option value="Penyalahgunaan Wewenang">Penyalahgunaan Wewenang</option>
                        <option value="Pelanggaran Kode Etik">Pelanggaran Kode Etik</option>
                        <option value="Pelanggaran Benturan Kepentingan">Pelanggaran Benturan Kepentingan</option>
                        <option value="Pelanggaran Hukum">Pelanggaran Hukum</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Terlapor</label>
                    <input type="text" name="nama_terlapor" class="form-control" placeholder="Masukkan Nama Terlapor">
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan Terlapor</label>
                    <input type="text" name="jabatan_terlapor" class="form-control" placeholder="Masukkan Jabatan Terlapor">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal dan Waktu Kejadian <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="tanggal_waktu" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi Kejadian <span class="text-danger">*</span></label>
                    <input type="text" name="lokasi_kejadian" class="form-control" placeholder="Masukkan Lokasi Kejadian" required>
                </div>

            </div>
            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Kronologis Kejadian <span class="text-danger">*</span></label>
                    <textarea name="kronologis" class="form-control" rows="4" placeholder="Masukkan Kronologis Kejadian secara lengkap" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nominal / Sesuatu yang Diberikan (Jika Terkait Korupsi/Suap)</label>
                    <input type="number" name="nominal_korupsi" class="form-control" placeholder="Masukkan jumlah atau bentuk suap (e.g., 1000000)" step="0.01">
                    <small class="form-text text-muted">Isi hanya angka, contoh: 1500000 untuk Rp 1.500.000</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bukti Tambahan (PDF, Gambar, Video, Audio)</label>
                    <div class="drag-area" id="dragAreaBukti">
                        <p style="font-size: 90%;">Upload Bukti Tambahan atau</p>
                        <p style="font-size: 90%;">Drag & Drop file di sini</p>
                        <p style="font-size: 90%;">Format: PDF, DOC, Gambar, Video, Audio. Maks 10 MB</p>
                    </div>
                    {{-- Added more comprehensive accept attribute for various file types --}}
                    <input type="file" name="foto_bukti" id="fileInputBukti" class="form-control d-none"
                        accept=".pdf,.doc,.docx,.xlsx,.xls,.png,.jpg,.jpeg,.gif,.mp4,.mov,.avi,.wmv,.flv,.mp3,.wav,.ogg">
                </div>
            </div>
        </div>

        <div class="text-center mt-4 mb-5">
            <button type="submit" class="btn btn-primary btn-md">Kirim Laporan</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    // Drag-and-drop handler
    const dragArea = document.getElementById('dragAreaBukti');
    const fileInput = document.getElementById('fileInputBukti');
    const initialDragAreaContent = dragArea.innerHTML; // Store initial content

    dragArea.addEventListener('click', () => {
        fileInput.click();
    });

    dragArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dragArea.classList.add('drag-over');
    });

    dragArea.addEventListener('dragleave', () => {
        dragArea.classList.remove('drag-over');
    });

    dragArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dragArea.classList.remove('drag-over');
        const file = event.dataTransfer.files[0];
        if (file) { // Ensure a file was dropped
            fileInput.files = event.dataTransfer.files; // Assign dropped file to the input
            showFileName(file);
        }
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            showFileName(fileInput.files[0]);
        } else {
            // Reset drag area if no file is selected (e.g., user opens dialog and cancels)
            dragArea.innerHTML = initialDragAreaContent;
        }
    });

    function showFileName(file) {
        let fileDisplay = '';
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                dragArea.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="img-thumbnail mt-2 mb-2" style="max-width: 25%; height: auto;">
                    <p><strong>${file.name}</strong> berhasil diunggah!</p>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            dragArea.innerHTML = `<p><strong>${file.name}</strong> berhasil diunggah!</p>`;
        }
    }
</script>
@endpush