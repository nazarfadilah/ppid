<!DOCTYPE html>
<html>
<head>
    <title>Update Status Permohonan</title>
</head>
<body>
    <h1>Status Permohonan Anda Diperbarui</h1>
    <p>Status terbaru: <strong>{{ $status }}</strong></p>
    @if($rejectReason)
        <p>Alasan Penolakan: {{ $rejectReason }}</p>
    @endif
    <p>Terima kasih telah menggunakan layanan kami.</p>
</body>
</html>
