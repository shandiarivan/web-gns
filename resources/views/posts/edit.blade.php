@extends('layouts.app')
@section('title', 'Edit Postingan Blog')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Postingan: {{ $post->title }}</h5>
            <form id="editPostForm" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3"><label class="form-label">Judul Konten</label><input type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}" required></div>
                <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description" rows="4" required>{{ old('description', $post->description) }}</textarea></div>
                <div class="mb-3">
                    <label for="published_at" class="form-label">Tanggal Publikasi</label>
                    {{-- Menggunakan Carbon untuk memformat tanggal dengan benar --}}
                    <input type="date" class="form-control" name="published_at" value="{{ old('published_at', \Carbon\Carbon::parse($post->published_at)->format('Y-m-d')) }}" required>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Gambar Utama</label>
                        @if($post->image1) <img src="{{ route('posts.image', ['filename' => basename($post->image1)]) }}" class="img-fluid rounded mb-2 d-block" width="150"> @endif
                        <input type="file" class="form-control" name="image1" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gambar 2 (Opsional)</label>
                         @if($post->image2) <img src="{{ route('posts.image', ['filename' => basename($post->image2)]) }}" class="img-fluid rounded mb-2 d-block" width="150"> @endif
                        <input type="file" class="form-control" name="image2" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gambar 3 (Opsional)</label>
                         @if($post->image3) <img src="{{ route('posts.image', ['filename' => basename($post->image3)]) }}" class="img-fluid rounded mb-2 d-block" width="150"> @endif
                        <input type="file" class="form-control" name="image3" accept="image/*">
                    </div>
                    {{-- Notifikasi Upload Gambar --}}
                    <div id="image-upload-error" class="alert alert-danger mt-2" style="display: none;"></div>
                </div>
                <div class="mb-3 form-check"><input type="checkbox" class="form-check-input" id="publishCheck" name="is_published" value="1" {{ $post->is_published ? 'checked' : '' }}><label class="form-check-label" for="publishCheck">Publish sekarang</label></div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Mencari form spesifik menggunakan ID yang baru ditambahkan
    const form = document.getElementById('editPostForm');

    // Hentikan script jika form-nya tidak ada
    if (!form) {
        return; 
    }

    // Ambil semua elemen di dalam form tersebut
    const fileInputs = form.querySelectorAll('input[type="file"]');
    const errorDiv = form.querySelector('#image-upload-error');
    const submitButton = form.querySelector('button[type="submit"]');
    
    // Pastikan semua elemen yang dibutuhkan ada di dalam form
    if (fileInputs.length > 0 && errorDiv && submitButton) {
        const maxSizeInBytes = 10 * 1024 * 1024; // 10MB

        const validateAllFiles = () => {
            let isAnyFileTooLarge = false;

            for (const input of fileInputs) {
                if (input.files.length > 0) {
                    const file = input.files[0];
                    if (file.size > maxSizeInBytes) {
                        isAnyFileTooLarge = true;
                        break;
                    }
                }
            }

            if (isAnyFileTooLarge) {
                errorDiv.textContent = 'Ukuran salah satu file tidak boleh melebihi 10MB!';
                errorDiv.style.display = 'block';
                submitButton.disabled = true;
            } else {
                errorDiv.style.display = 'none';
                submitButton.disabled = false;
            }
        };

        fileInputs.forEach(input => {
            input.addEventListener('change', validateAllFiles);
        });
    }
});
</script>
@endpush