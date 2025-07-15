<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keberatan Tahun {{ $year }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3>Laporan Pengajuan Keberatan Tahun {{ $year }}</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Pemohon</th>
                <th>NIK</th>
                <th>Alasan Keberatan</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($objections as $obj)
            <tr>
                <td>{{ $obj->nama_pemohon }}</td>
                <td>{{ $obj->nik }}</td>
                <td>{{ $obj->alasan_keberatan }}</td>
                <td>{{ $obj->created_at->format('Y-m-d') }}</td>
                <td>{{ $obj->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
