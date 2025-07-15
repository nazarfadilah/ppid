@extends('public.navbar')

@section('content')

<div class="container" style="margin-top: 90px;">
    <div class="text-center mb-5">
        <h2 class="mb-1">Daftar Informasi Publik</h2>
        <p class="text-muted">Informasi Publik PPID Perangkat Daerah</p>
    </div>

    <div class="table-responsive-sm mt-3 mb-5">
        <table id="informationPublicTable" class="table table-striped table-xm" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama PD/OKPD</th>
                    <th>Nama Dokumen</th>
                    <th>Tahun Pembuatan</th>
                    <th>Tipe File</th>
                    <th>Ukuran</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const requestTable = $('#informationPublicTable').DataTable({
            processing: true,
            serverSide: true,
            // scrollX: true,
            responsive: true,
            ajax: {
                url: "{{ route('public.data') }}",
                type: 'GET',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name_pd_okpd', name: 'name_pd_okpd' },
                { data: 'document_name', name: 'document_name' },
                { data: 'creation_year', name: 'creation_year' },
                { data: 'file_type', name: 'file_type' },
                { data: 'file_size', name: 'file_size' },
                { data: 'download', name: 'download', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush