@extends('petugas.layout')

@section('content')
<div class="container">
    <h2>Tambah Gallery</h2>
    <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipe</label>
            <select class="form-control" id="type" name="type" required onchange="toggleInputType()">
                <option value="foto">Foto</option>
                <option value="video">Video</option>
                <option value="comic">Comic</option>
                <option value="podcast">Podcast</option>
                <option value="link">Link</option>
            </select>
        </div>
        <div class="mb-3" id="file_input_div">
            <label for="file_path" class="form-label">Upload File</label>
            <input type="file" class="form-control" id="file_path" name="file_path">
        </div>
        <div class="mb-3" id="link_input_div" style="display: none;">
            <label for="link" class="form-label">Link</label>
            <input type="text" class="form-control" id="link" name="link">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <script>
        function toggleInputType() {
            const type = document.getElementById('type').value;
            const fileInputDiv = document.getElementById('file_input_div');
            const linkInputDiv = document.getElementById('link_input_div');
            const fileInput = document.getElementById('file_path');
            const linkInput = document.getElementById('link');
            
            if (type === 'link') {
                fileInputDiv.style.display = 'none';
                linkInputDiv.style.display = 'block';
                fileInput.removeAttribute('required');
                linkInput.setAttribute('required', '');
            } else {
                fileInputDiv.style.display = 'block';
                linkInputDiv.style.display = 'none';
                fileInput.setAttribute('required', '');
                linkInput.removeAttribute('required');
            }
        }
        
        // Run on page load
        document.addEventListener('DOMContentLoaded', toggleInputType);
    </script>
</div>
@endsection
