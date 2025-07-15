@extends('public.navbar')

@section('content')
<div class="container" style="margin-top: 90px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Form Permohonan Informasi</h2>
        <p class="text-muted">Silakan isi data di bawah ini dengan lengkap dan benar</p>
    </div>

    <form action="{{ route('public-information-requests-create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('POST') is not strictly necessary here as the default method for forms is POST --}}
        <div class="row">
            {{-- === A. Data Pemohon === --}}
            <div class="col-md-6">
                <h5 class="mb-3">A. Data Pemohon</h5>

                <div class="mb-3">
                    <label for="request_category" class="form-label">Kategori Permohonan</label>
                    <select class="form-select" name="request_category" id="kategoriPermohonan">
                        <option value="individual">Perorangan</option>
                        <option value="organization">Lembaga / Organisasi</option>
                        <option value="group">Kelompok Orang</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nik" id="labelNik" class="form-label">NIK/No. Identitas Pribadi</label>
                    <input type="text" class="form-control" name="nik" id="inputNik" placeholder="Masukkan NIK/No. Identitas" maxlength="16" minlength="16" oninput="validateNIK(this)" onblur="validateNIK(this)" required>
                    <small class="d-block mb-1 text-danger">(Mohon pastikan NIK sesuai dengan KTP)</small>
                    <small id="nikInputError" class="text-danger" style="display: none;">NIK harus 16 digit</small>
                </div>
                <script>
                    function validateNIK(input) {
                        const nikInputError = document.getElementById('nikInputError');
                        const isAllDigits = /^\d+$/.test(input.value);
                        
                        if (input.value.length !== 16 || !isAllDigits) {
                            nikInputError.style.display = 'block';
                            nikInputError.textContent = "NIK harus 16 digit angka";
                        } else {
                            nikInputError.style.display = 'none';
                        }
                    }
                </script>

                <div class="mb-3">
                    <label for="nama_pemohon" id="labelName" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_pemohon" id="inputName" placeholder="Masukkan Nama Lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_hp" placeholder="Masukkan Nomor Telepon" required>
                </div>

                <div class="mb-3">
                    <label for="ktp" id="labelKtp" class="form-label">Upload KTP</label>
                    <div class="drag-area" id="dragAreaKtp">
                        <p>Upload atau drag & drop file KTP (Max 5MB)</p>
                    </div>
                    <input type="file" name="ktp" id="fileInputKTP" class="form-control d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                </div>

                {{-- Akta Notaris atau Surat Kuasa (Conditionally displayed) --}}
                <div class="mb-3" id="aktaNotarisSection" style="display: none;">
                    <label class="form-label" id="labelFile">Upload Akta Notaris / Surat Kuasa</label>
                    <div class="drag-area" id="dragAreaFile">
                        <p>Upload atau drag file Akta Notaris / Surat Kuasa (Max 5MB)</p>
                    </div>
                    {{-- The 'name' attribute is added here to match the 'akta_notaris_or_surat_kuasa' field in the model --}}
                    <input type="file" name="akta_notaris_or_surat_kuasa" id="inputFile" class="form-control d-none" accept=".jpg,.jpeg,.png,.pdf">
                </div>
            </div>

            {{-- === B. Pengguna Informasi === --}}
            <div class="col-md-6">
                <h5 class="mb-3">B. Pengguna Informasi</h5>

                <div class="mb-3">
                    <label for="nama_pengguna_informasi" class="form-label">Nama Pengguna Informasi</label>
                    <input type="text" name="nama_pengguna_informasi" class="form-control" placeholder="Masukkan nama pengguna informasi" required>
                </div>

                <div class="mb-3">
                    <label for="nik_pengguna_informasi" class="form-label">NIK Pengguna Informasi</label>
                    <input type="text" name="nik_pengguna_informasi" id="nik_pengguna_informasi" class="form-control" placeholder="Masukkan NIK pengguna informasi" maxlength="16" minlength="16" oninput="validateNIK(this)" onblur="validateNIK(this)" required>
                    <small class="d-block mb-1 text-danger">(Mohon pastikan NIK sesuai dengan KTP)</small>
                    <small id="nikPenggunaError" class="text-danger" style="display: none;">NIK harus 16 digit angka</small>
                </div>

                <div class="mb-3">
                    <label for="alamat_pengguna_informasi" class="form-label">Alamat Pengguna Informasi</label>
                    <input type="text" name="alamat_pengguna_informasi" class="form-control" placeholder="Masukkan alamat pengguna informasi" required>
                </div>

                <div class="mb-3">
                    <label for="no_hp_pengguna_informasi" class="form-label">Nomor Telepon Pengguna Informasi</label>
                    <input type="text" name="no_hp_pengguna_informasi" class="form-control" placeholder="Masukkan nomor telepon pengguna informasi">
                </div>

                <div class="mb-3">
                    <label for="email_pengguna_informasi" class="form-label">Email Pengguna Informasi</label>
                    <input type="email" name="email_pengguna_informasi" class="form-control" placeholder="Masukkan email pengguna informasi">
                </div>

                {{-- === C. Preferensi Informasi === --}}
                <h5 class="mt-4 mb-3">C. Preferensi Informasi</h5>

                <div class="mb-3">
                    <label for="cara_mendapatkan_informasi" class="form-label">Cara Memperoleh Informasi</label>
                    <select name="cara_mendapatkan_informasi" class="form-select" id="caraMendapatkanInformasi">
                        <option value="langsung">Langsung</option>
                        <option value="website">Website</option>
                        <option value="email">E-Mail</option>
                        <option value="fax">Fax</option>
                        <option value="lainnya">Yang lain:</option>
                    </select>
                    <input type="text" name="cara_mendapatkan_informasi_lainnya" class="form-control mt-2" id="caraMendapatkanInformasiLainnya" placeholder="Sebutkan cara lain..." style="display: none;">
                </div>

                <div class="mb-3">
                    <label for="formats" class="form-label">Format Bahan Informasi</label>
                    <select name="formats" class="form-select" id="formatBahanInformasi">
                        <option value="cetakan">Cetakan</option>
                        <option value="rekaman">Rekaman</option>
                        <option value="lainnya">Yang lain:</option>
                    </select>
                    <input type="text" name="format_lainnya" class="form-control mt-2" id="formatBahanInformasiLainnya" placeholder="Sebutkan format lain..." style="display: none;">
                </div>

                <div class="mb-3">
                    <label for="pengiriman_informasi" class="form-label">Cara Pengiriman Bahan Informasi</label>
                    <select name="pengiriman_informasi" class="form-select" id="caraPengirimanInformasi">
                        <option value="langsung">Langsung</option>
                        <option value="kurir_pos">Melalui Jasa Kurir / Pos</option>
                        <option value="email">E-Mail</option>
                        <option value="lainnya">Yang lain:</option>
                    </select>
                    <input type="text" name="pengiriman_informasi_lainnya" class="form-control mt-2" id="caraPengirimanInformasiLainnya" placeholder="Sebutkan cara pengiriman lain..." style="display: none;">
                </div>

                {{-- === Rincian Informasi === --}}
                <div class="mb-3">
                    <label for="informasi_terkait" class="form-label">Rincian Informasi yang Dibutuhkan</label>
                    <textarea name="informasi_terkait" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="alasan_informasi" class="form-label">Tujuan Penggunaan Informasi</label>
                    <textarea name="alasan_informasi" class="form-control" rows="3" required></textarea>
                </div>

                 <div class="mb-3">
                    <label for="alasan_pengguna_informasi" class="form-label">Alasan Pengguna Informasi</label>
                    <textarea name="alasan_pengguna_informasi" class="form-control" rows="3" placeholder="Masukkan alasan pengguna informasi"></textarea>
                </div>
            </div>
        </div>

        <div class="text-center mt-4 mb-5">
            <button type="submit" class="btn btn-primary btn-md">Ajukan Permohonan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const kategoriPermohonan = document.getElementById('kategoriPermohonan');
    const aktaNotarisSection = document.getElementById('aktaNotarisSection');
    const inputFile = document.getElementById('inputFile');
    const dragAreaKtp = document.getElementById('dragAreaKtp');
    const dragAreaFile = document.getElementById('dragAreaFile');
    const labelNik = document.getElementById('labelNik');
    const labelName = document.getElementById('labelName');
    const inputNik = document.getElementById('inputNik');
    const inputName = document.getElementById('inputName');
    const labelKtp = document.getElementById('labelKtp');
    const labelFile = document.getElementById('labelFile');

    const caraMendapatkanInformasi = document.getElementById('caraMendapatkanInformasi');
    const caraMendapatkanInformasiLainnya = document.getElementById('caraMendapatkanInformasiLainnya');
    const formatBahanInformasi = document.getElementById('formatBahanInformasi');
    const formatBahanInformasiLainnya = document.getElementById('formatBahanInformasiLainnya');
    const caraPengirimanInformasi = document.getElementById('caraPengirimanInformasi');
    const caraPengirimanInformasiLainnya = document.getElementById('caraPengirimanInformasiLainnya');


    kategoriPermohonan.addEventListener('change', () => {
        const value = kategoriPermohonan.value;

        if (value === 'individual') {
            aktaNotarisSection.style.display = 'none';
            inputFile.removeAttribute('name'); // Remove name to prevent sending when not needed
            inputFile.removeAttribute('required');
            labelNik.innerHTML = 'NIK/No. Identitas Pribadi';
            labelName.innerHTML = 'Nama Lengkap';
            labelKtp.innerHTML = 'Upload KTP Pribadi';
        } else if (value === 'organization') {
            aktaNotarisSection.style.display = 'block';
            inputFile.setAttribute('name', 'akta_notaris_or_surat_kuasa'); // Set name for upload
            inputFile.setAttribute('required', 'required');
            labelNik.innerHTML = 'NIK/No. Identitas Pimpinan';
            labelName.innerHTML = 'Nama Lembaga / Organisasi';
            labelKtp.innerHTML = 'Upload KTP Pimpinan';
            labelFile.innerHTML = 'Upload Akta Notaris';
        } else if (value === 'group') {
            aktaNotarisSection.style.display = 'block';
            inputFile.setAttribute('name', 'akta_notaris_or_surat_kuasa'); // Set name for upload
            inputFile.setAttribute('required', 'required');
            labelNik.innerHTML = 'NIK/No. Identitas Pemberi Kuasa';
            labelName.innerHTML = 'Nama Pemberi Kuasa';
            labelKtp.innerHTML = 'Upload KTP Pemberi Kuasa';
            labelFile.innerHTML = 'Upload Surat Kuasa';
        }
    });

    // Initial dispatch to set correct state on page load
    kategoriPermohonan.dispatchEvent(new Event('change'));

    // Handle "Lainnya" option for Cara Memperoleh Informasi
    caraMendapatkanInformasi.addEventListener('change', () => {
        if (caraMendapatkanInformasi.value === 'lainnya') {
            caraMendapatkanInformasiLainnya.style.display = 'block';
            caraMendapatkanInformasiLainnya.setAttribute('required', 'required');
        } else {
            caraMendapatkanInformasiLainnya.style.display = 'none';
            caraMendapatkanInformasiLainnya.removeAttribute('required');
            caraMendapatkanInformasiLainnya.value = ''; // Clear value when hidden
        }
    });

    // Handle "Lainnya" option for Format Bahan Informasi
    formatBahanInformasi.addEventListener('change', () => {
        if (formatBahanInformasi.value === 'lainnya') {
            formatBahanInformasiLainnya.style.display = 'block';
            formatBahanInformasiLainnya.setAttribute('required', 'required');
        } else {
            formatBahanInformasiLainnya.style.display = 'none';
            formatBahanInformasiLainnya.removeAttribute('required');
            formatBahanInformasiLainnya.value = ''; // Clear value when hidden
        }
    });

    // Handle "Lainnya" option for Cara Pengiriman Bahan Informasi
    caraPengirimanInformasi.addEventListener('change', () => {
        if (caraPengirimanInformasi.value === 'lainnya') {
            caraPengirimanInformasiLainnya.style.display = 'block';
            caraPengirimanInformasiLainnya.setAttribute('required', 'required');
        } else {
            caraPengirimanInformasiLainnya.style.display = 'none';
            caraPengirimanInformasiLainnya.removeAttribute('required');
            caraPengirimanInformasiLainnya.value = ''; // Clear value when hidden
        }
    });


    function setupDragAndDrop(dragAreaId, fileInputId) {
        const dragArea = document.getElementById(dragAreaId);
        const fileInput = document.getElementById(fileInputId);

        dragArea.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', () => showFileName(dragArea, fileInput.files[0]));
        dragArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dragArea.classList.add('drag-over');
        });
        dragArea.addEventListener('dragleave', () => dragArea.classList.remove('drag-over'));
        dragArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dragArea.classList.remove('drag-over');
            const file = e.dataTransfer.files[0];
            fileInput.files = e.dataTransfer.files;
            showFileName(dragArea, file);
        });
    }

    function showFileName(dragArea, file) {
        if (file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    dragArea.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width: 25%;"><p><strong>${file.name}</strong> berhasil diunggah!</p>`;
                };
                reader.readAsDataURL(file);
            } else {
                dragArea.innerHTML = `<p><strong>${file.name}</strong> berhasil diunggah!</p>`;
            }
        } else {
             dragArea.innerHTML = `<p>Upload atau drag & drop file (Max 5MB)</p>`; // Reset if no file
        }
    }

    setupDragAndDrop('dragAreaKtp', 'fileInputKTP');
    setupDragAndDrop('dragAreaFile', 'inputFile');
</script>
@endpush
