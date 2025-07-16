@extends('public.layout.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <h3 class="page-title">Tambah Permohonan Informasi Publik</h3>
    </div>

    <div class="container-fluid">
        <form action="{{ route('public-information-requests-create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- ambil user id yang login saat ini dan formnya ngak usah ditampilkan --}}
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <div class="mb-3">
                <label>Kategori Permohonan</label>
                <select name="request_category" class="form-control" required>
                    <option value="individual">Individu</option>
                    <option value="organization">Organisasi</option>
                    <option value="group">Kelompok</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Nama Pemohon</label>
                <input type="text" name="nama_pemohon" class="form-control" maxlength="64" required>
            </div>

            <div class="mb-3">
                <label>NIK</label>
                <input type="text" id="nik" name="nik" class="form-control" maxlength="16" minlength="16" required>
            </div>
            <script>
                document.getElementById('nik').addEventListener('input', function (e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    // Limit to 16 digits
                    if (this.value.length > 16) {
                        this.value = this.value.slice(0, 16);
                    }
                });

                document.getElementById('nik').addEventListener('blur', function (e) {
                    if (this.value.length !== 16) {
                        this.setCustomValidity('NIK harus 16 digit angka');
                        this.reportValidity();
                    } else {
                        this.setCustomValidity('');
                    }
                });
            </script>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control" maxlength="15" minlength="10" required>
            </div>
            <script>
                document.getElementById('no_hp').addEventListener('input', function (e) {
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // Limit to 15 digits
                    if (this.value.length > 15) {
                        this.value = this.value.slice(0, 15);
                    }
                });

                document.getElementById('no_hp').addEventListener('blur', function (e) {
                    if (this.value.length < 10) {
                        this.setCustomValidity('No HP harus antara 10-15 digit');
                        this.reportValidity();
                    } else {
                        this.setCustomValidity('');
                    }
                });
            </script>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Informasi Terkait</label>
                <textarea name="informasi_terkait" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Alasan Permohonan Informasi</label>
                <textarea name="alasan_informasi" class="form-control" required></textarea>
            </div>

            <hr>
            <h5>Pengguna Informasi</h5>
            <div class="mb-3">
                <label>Nama Pengguna Informasi</label>
                <input type="text" name="nama_pengguna_informasi" class="form-control" maxlength="64" required>
            </div>
            <div class="mb-3">
                <label>NIK Pengguna Informasi</label>
                <input type="text" id="nik_pengguna_informasi" name="nik_pengguna_informasi" class="form-control" maxlength="16" minlength="16"required>
            </div>
            <script>
                document.getElementById('nik_pengguna_informasi').addEventListener('input', function (e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    // Limit to 16 digits
                    if (this.value.length > 16) {
                        this.value = this.value.slice(0, 16);
                    }
                });

                document.getElementById('nik_pengguna_informasi').addEventListener('blur', function (e) {
                    if (this.value.length !== 16) {
                        this.setCustomValidity('NIK harus 16 digit angka');
                        this.reportValidity();
                    } else {
                        this.setCustomValidity('');
                    }
                });

                document.getElementById('nik_pengguna_informasi').addEventListener('blur', function (e) {
                    if (this.value.length !== 16) {
                        this.setCustomValidity('NIK harus 16 digit angka');
                        this.reportValidity();
                    } else {
                        this.setCustomValidity('');
                    }
                });
            </script>
            <div class="mb-3">
                <label>Alamat Pengguna Informasi</label>
                <textarea name="alamat_pengguna_informasi" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>No HP Pengguna Informasi</label>
                <input type="text" id="no_hp_pengguna_informasi" name="no_hp_pengguna_informasi" class="form-control" maxlength="15" minlength="10" required>
            </div>
            <script>
                document.getElementById('no_hp_pengguna_informasi').addEventListener('input', function (e) {
                    this.value = this.value.replace(/[^0-9]/g, '');

                    // Limit to 15 digits
                    if (this.value.length > 15) {
                        this.value = this.value.slice(0, 15);
                    }
                });

                document.getElementById('no_hp_pengguna_informasi').addEventListener('blur', function (e) {
                    if (this.value.length < 10) {
                        this.setCustomValidity('No HP harus antara 10-15 digit');
                        this.reportValidity();
                    } else {
                        this.setCustomValidity('');
                    }
                });
            </script>
            <div class="mb-3">
                <label>Email Pengguna Informasi</label>
                <input type="email" name="email_pengguna_informasi" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Alasan Pengguna Informasi</label>
                <textarea name="alasan_pengguna_informasi" class="form-control" required></textarea>
            </div>

            <hr>
            <h5>Informasi Tambahan</h5>
            <div class="mb-3">
                <label>Cara Mendapatkan Informasi</label>
                <select name="cara_mendapatkan_informasi" id="cara_mendapatkan_informasi" class="form-control">
                    <option value="Melihat/Membaca/Mendengarkan/Mencatat">Melihat/Membaca/Mendengarkan/Mencatat</option>
                    <option value="Mendapatkan salinan informasi">Mendapatkan salinan informasi</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="mb-3" id="cara_mendapatkan_informasi_lainnya_div" style="display: none;">
                <label>Cara Mendapatkan Informasi Lainnya</label>
                <input type="text" name="cara_mendapatkan_informasi_lainnya" class="form-control">
            </div>
            
            <div class="mb-3">
                <label>Format</label>
                <select name="formats" id="formats" class="form-control">
                    <option value="Hard copy">Hard copy</option>
                    <option value="Soft copy">Soft copy</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="mb-3" id="format_lainnya_div" style="display: none;">
                <label>Format Lainnya</label>
                <input type="text" name="format_lainnya" class="form-control">
            </div>
            
            <div class="mb-3">
                <label>Pengiriman Informasi</label>
                <select name="pengiriman_informasi" id="pengiriman_informasi" class="form-control">
                    <option value="Mengambil langsung">Mengambil langsung</option>
                    <option value="Email">Email</option>
                    <option value="Pos">Pos</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="mb-3" id="pengiriman_informasi_lainnya_div" style="display: none;">
                <label>Pengiriman Informasi Lainnya</label>
                <input type="text" name="pengiriman_informasi_lainnya" class="form-control">
            </div>
            
            <script>
                document.getElementById('cara_mendapatkan_informasi').addEventListener('change', function() {
                    if (this.value === 'Lainnya') {
                        document.getElementById('cara_mendapatkan_informasi_lainnya_div').style.display = 'block';
                    } else {
                        document.getElementById('cara_mendapatkan_informasi_lainnya_div').style.display = 'none';
                    }
                });
                
                document.getElementById('formats').addEventListener('change', function() {
                    if (this.value === 'Lainnya') {
                        document.getElementById('format_lainnya_div').style.display = 'block';
                    } else {
                        document.getElementById('format_lainnya_div').style.display = 'none';
                    }
                });
                
                document.getElementById('pengiriman_informasi').addEventListener('change', function() {
                    if (this.value === 'Lainnya') {
                        document.getElementById('pengiriman_informasi_lainnya_div').style.display = 'block';
                    } else {
                        document.getElementById('pengiriman_informasi_lainnya_div').style.display = 'none';
                    }
                });
            </script>

            <div class="mb-3">
                <label>Unggah KTP</label>
                <input type="file" name="ktp" class="form-control" accept="image/*" required>
                <small class="text-muted">Format: JPG, PNG, atau PDF</small>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('public.information-requests') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
