@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 90px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Cek Status Permohonan Keberatan Informasi Publik</h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Cari Status Permohonan</h5>
                    <form id="searchForm">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" id="nik" name="nik" class="form-control" placeholder="Masukkan NIK" required>
                        </div>
                        <div class="mb-3">
                            <label for="objection_code" class="form-label">Kode Keberatan</label>
                            <input type="text" id="objection_code" name="objection_code" class="form-control" placeholder="Masukkan Kode Keberatan" required>
                        </div>
                        <div class="d-grid">
                            <button type="button" id="searchButton" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4 d-none" id="resultSection">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Hasil Pencarian</h5>
                    <div id="resultContent">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
     document.getElementById('searchButton').addEventListener('click', function() {
        const nik = document.getElementById('nik').value.trim();
        const objectionCode = document.getElementById('objection_code').value.trim();

        if (!nik || !objectionCode) {
            alert('Harap isi NIK dan Kode Keberatan');
            return;
        }

        const resultSection = document.getElementById('resultSection');
        const resultContent = document.getElementById('resultContent');

        resultContent.innerHTML = `<p class="text-center">Sedang mencari...</p>`;
        resultSection.classList.remove('d-none');

        fetch(`{{ route('objection.status') }}?nik=${nik}&objection_code=${objectionCode}`, {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let statusClass = '';
                let statusText = '';

                if (data.status === 'Checking') {
                    statusClass = 'text-warning';
                    statusText = 'Permohonan sedang diproses. Harap bersabar menunggu.';
                } else if (data.status === 'Approved') {
                    statusClass = 'text-success';
                    statusText = 'Permohonan Anda diterima. Pemberitahuan lebih lanjut akan diteruskan ke email Anda. Mohon cek secara berkala.';
                } else if (data.status === 'Rejected') {
                    statusClass = 'text-danger';
                    statusText = `Permohonan Anda ditolak. Alasan: ${data.reason}`;
                }

                resultContent.innerHTML = `
                    <p class="${statusClass}">${statusText}</p>
                `;
            } else {
                resultContent.innerHTML = `
                    <p class="text-danger">${data.message}</p>
                `;
            }
        })
        .catch(error => {
            resultContent.innerHTML = `
                <p class="text-danger">Terjadi kesalahan saat memproses permintaan.</p>
            `;
        });
    });
</script>
@endpush