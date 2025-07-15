<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Whistle Blowing</title>
    <style>
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #333; padding:5px; font-size:12px; }
        th { background:#eee; }
    </style>
</head>
<body>
    <h2>Data Whistle Blowing</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Nama</th><th>No HP</th><th>Email</th>
                <th>Tindakan</th><th>Terlapor</th><th>Status</th><th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($all as $w)
            <tr>
                <td>{{ $w->id }}</td>
                <td>{{ $w->nama }}</td>
                <td>{{ $w->no_hp }}</td>
                <td>{{ $w->email }}</td>
                <td>{{ $w->tindakan }}</td>
                <td>{{ $w->nama_terlapor }}</td>
                <td>{{ $w->status }}</td>
                <td>{{ $w->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
