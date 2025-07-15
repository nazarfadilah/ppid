<!DOCTYPE html>
<html>
<body>
    <p>{!! nl2br(e($pesan)) !!}</p>
    <p>Alasan: {{ $reason }}</p>
    @if($fileLampiran)
        <p>File lampiran: <a href="{{ $fileLampiran }}">Download</a></p>
    @endif
    <p>{!! nl2br(e("Terima kasih atas perhatian Anda.")) !!}</p>
</body>
</html>
