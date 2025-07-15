@extends('public.navbar')

@section('content')
<div class="container" style="margin-top: 90px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Form Pengajuan Keberatan Informasi Publik</h2>
        <p class="text-muted">Silakan isi data di bawah ini dengan lengkap dan benar</p>
    </div>
    <form action="{{ route('objections-create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama_pemohon" class="form-label">Nama Pemohon</label>
                    <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" placeholder="Masukkan Nama Pemohon" required>
                </div>
                <div class="mb-3">
                    <label for="alamat_pemohon" class="form-label">Alamat Pemohon</label>
                    <input type="text" class="form-control" name="alamat_pemohon" id="alamat_pemohon" placeholder="Masukkan Alamat Pemohon" required>
                </div>
                <div class="mb-3">
                    <label for="pekerjaan_pemohon" class="form-label">Pekerjaan Pemohon</label>
                    <input type="text" class="form-control" name="pekerjaan_pemohon" id="pekerjaan_pemohon" placeholder="Masukkan Pekerjaan Pemohon" required>
                </div>
                <div class="mb-3">
                    <label for="no_hp_pemohon" class="form-label">No. HP Pemohon</label>
                    <input type="text" class="form-control" name="no_hp_pemohon" id="no_hp_pemohon" placeholder="Masukkan Nomor HP Pemohon" required>
                </div>
                <div class="mb-3">
                    <label for="email_pemohon" class="form-label">Email Pemohon</label>
                    <input type="email" class="form-control" name="email_pemohon" id="email_pemohon" placeholder="Masukkan Email Pemohon" required>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="nama_kuasa_pemohon" class="form-label">Nama Kuasa Pemohon</label>
                    <input type="text" class="form-control" name="nama_kuasa_pemohon" id="nama_kuasa_pemohon" placeholder="Masukkan Nama Kuasa Pemohon (jika ada)">
                </div>
                <div class="mb-3">
                    <label for="alamat_kuasa_pemohon" class="form-label">Alamat Kuasa Pemohon</label>
                    <input type="text" class="form-control" name="alamat_kuasa_pemohon" id="alamat_kuasa_pemohon" placeholder="Masukkan Alamat Kuasa Pemohon (jika ada)">
                </div>
                <div class="mb-3">
                    <label for="no_hp_kuasa_pemohon" class="form-label">No. HP Kuasa Pemohon</label>
                    <input type="text" class="form-control" name="no_hp_kuasa_pemohon" id="no_hp_kuasa_pemohon" placeholder="Masukkan Nomor HP Kuasa Pemohon (jika ada)">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="alasan_pengajuan" class="form-label">Alasan Pengajuan Keberatan*</label>
                    <select class="form-control" name="alasan_pengajuan" id="alasan_pengajuan" required>
                        <option value="">-- Pilih Alasan --</option>
                        <option value="Permohonan informasi ditolak">Permohonan informasi ditolak</option>
                        <option value="Informasi berkala tidak disediakan">Informasi berkala tidak disediakan</option>
                        <option value="Permintaan informasi tidak ditanggapi">Permintaan informasi tidak ditanggapi</option>
                        <option value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta">Permintaan informasi ditanggapi tidak sebagaimana yang diminta</option>
                        <option value="Permintaan informasi tidak dipenuhi">Permintaan informasi tidak dipenuhi</option>
                        <option value="Biaya yang dikenakan tidak wajar">Biaya yang dikenakan tidak wajar</option>
                        <option value="Informasi disampaikan melebihi jangka waktu yang ditentukan">Informasi disampaikan melebihi jangka waktu yang ditentukan</option>
                        <option value="lainnya">Lainnya</option> {{-- Changed from 'other' to 'lainnya' to match the typical Indonesian translation --}}
                    </select>
                    {{-- This input's name should be "alasan_lainnya" as per your model --}}
                    <input type="text" class="form-control mt-2 d-none" name="alasan_lainnya" id="alasan_lainnya" placeholder="Sebutkan alasan lainnya">
                </div>
                <div class="mb-3">
                    <label for="kasus_posisi" class="form-label">Kasus Posisi (Ringkasan Kasus)*</label>
                    <textarea class="form-control" name="kasus_posisi" id="kasus_posisi" rows="3" required></textarea>
                </div>
                <div class="mb-3" id="ktpPemohonSection">
                    <label class="form-label" id="labelKtp">Upload KTP Pemohon (jpg/png/pdf, max 5MB)*</label>
                    <div class="drag-area" id="dragAreaFile">
                        <p style="font-size: 90%;">Upload KTP Pemohon atau</p>
                        <p style="font-size: 90%;">Drag File KTP Pemohon</p>
                        <p style="font-size: 90%;">Max Upload 5 Mb</p>
                    </div>
                    {{-- Ensure the name attribute matches the model's fillable property 'ktp_pemohon' --}}
                    <input type="file" name="ktp_pemohon" id="inputFile" class="form-control d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                </div>
            </div>
        </div>
        <div class="text-center mt-4 mb-5">
            <button type="submit" class="btn btn-primary btn-md">Ajukan Keberatan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function setupDragAndDrop(dragAreaId, fileInputId) {
        const dragArea = document.getElementById(dragAreaId);
        const fileInput = document.getElementById(fileInputId);

        // Click event to trigger file input
        dragArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Change event to show file name on selection
        fileInput.addEventListener('change', () => {
            showFileName(dragArea, fileInput.files[0]);
        });

        // Drag and drop events
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
            fileInput.files = event.dataTransfer.files; // Assign dropped file to input
            showFileName(dragArea, file);
        });
    }

    function showFileName(dragArea, file) {
        if (file) { // Check if a file exists
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    dragArea.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 25%; height: auto;">
                        <p><strong>${file.name}</strong> berhasil diunggah!</p>
                    `;
                };
                reader.readAsDataURL(file);
            } else {
                dragArea.innerHTML = `<p><strong>${file.name}</strong> berhasil diunggah!</p>`;
            }
        } else {
            // If no file is selected (e.g., user cancels file dialog), reset the drag area
            dragArea.innerHTML = `
                <p style="font-size: 90%;">Upload KTP Pemohon atau</p>
                <p style="font-size: 90%;">Drag File KTP Pemohon</p>
                <p style="font-size: 90%;">Max Upload 5 Mb</p>
            `;
        }
    }

    // Initialize drag and drop for the KTP upload
    setupDragAndDrop('dragAreaFile', 'inputFile');

    // Handle "Lainnya" option for objection reason
    document.getElementById('alasan_pengajuan').addEventListener('change', function() {
        const alasanLainInput = document.getElementById('alasan_lainnya');
        if (this.value === 'lainnya') { // Match the option value 'lainnya'
            alasanLainInput.classList.remove('d-none');
            alasanLainInput.required = true;
        } else {
            alasanLainInput.classList.add('d-none');
            alasanLainInput.required = false;
            alasanLainInput.value = ''; // Clear the input if "Lainnya" is not selected
        }
    });
</script>
@endpush