@extends('petugas.layout')

@section('content')
<div class="container">
    <h2>Edit Galeri</h2>
    <form action="{{ route('galleries.update', $galleries->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $galleries->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description', $galleries->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $galleries->date) }}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipe</label>
            <select class="form-control" id="type" name="type" required onchange="toggleInputType()">
                <option value="link" {{ old('type', $galleries->type) == 'link' ? 'selected' : '' }}>Link</option>
                <option value="foto" {{ old('type', $galleries->type) == 'foto' ? 'selected' : '' }}>Foto</option>
                <option value="video" {{ old('type', $galleries->type) == 'video' ? 'selected' : '' }}>Video</option>
                <option value="comic" {{ old('type', $galleries->type) == 'comic' ? 'selected' : '' }}>Comic</option>
                <option value="podcast" {{ old('type', $galleries->type) == 'podcast' ? 'selected' : '' }}>Podcast</option>
            </select>
        </div>
        
        <div class="mb-3" id="linkInputDiv">
            <label for="link_url" class="form-label">Link URL</label>
            <input type="text" class="form-control" id="link_url" name="link" value="{{ old('link', $galleries->link) }}">
        </div>
        
        <div class="mb-3" id="fileInputDiv">
            <label for="file_path" class="form-label">File Upload</label>
            @if($galleries->link && in_array($galleries->type, ['foto', 'video', 'comic', 'podcast']))
                <div class="mb-2">
                    <a href="{{ asset('storage/'.$galleries->link) }}" target="_blank">Lihat File Saat Ini</a>
                </div>
            @endif
            <input type="file" class="form-control" id="file_path" name="link">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah file.</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    function toggleInputType() {
        var type = document.getElementById('type').value;
        var linkInputDiv = document.getElementById('linkInputDiv');
        var fileInputDiv = document.getElementById('fileInputDiv');
        
        if (type === 'link') {
            linkInputDiv.style.display = 'block';
            fileInputDiv.style.display = 'none';
        } else {
            linkInputDiv.style.display = 'none';
            fileInputDiv.style.display = 'block';
        }
    }
    
    // Execute on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleInputType();
    });
</script>
@endsection
