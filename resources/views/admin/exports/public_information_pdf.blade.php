<!DOCTYPE html>
<html>
<head>
    <title>Export PDF - Permohonan Informasi</title>
    <style>
        table {
            width: 100%; border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000; padding: 6px; font-size: 12px;
        }
    </style>
</head>
<body>
    <h3>Data Permohonan Informasi Tahun {{ $year }}</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->request_category }}</td>
                <td>{{ $item->nama_pemohon }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
