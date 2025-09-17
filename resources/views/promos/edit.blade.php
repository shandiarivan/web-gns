@extends('layouts.app')
@section('title', 'Edit Promo')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Konten Promo</h5>
            <form action="{{ route('promos.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    {{-- <img src="{{ Storage::url($promo->image_path) }}" alt="Current Image" width="200"> --}}
                    <img src="{{ route('promo.image', ['filename' => basename($promo->image_path)]) }}" ... width="200" >
                </div>

                <div class="mb-3">
                    <label for="imageUpload" class="form-label">Upload Gambar Baru (Opsional)</label>
                    <input type="file" class="form-control" id="imageUpload" name="image" accept="image/*">
                </div>
                {{-- Notifikasi Upload Gambar --}}
                <div id="image-upload-error" class="alert alert-danger mt-2" style="display: none;"></div>
                <div class="mb-3">
                    <label for="contentDescription" class="form-label">Deskripsi Konten</label>
                    <textarea class="form-control" id="contentDescription" name="description" rows="4" required>{{ old('description', $promo->description) }}</textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="publishCheck" name="is_published" value="1" {{ $promo->is_published ? 'checked' : '' }}>
                    <label class="form-check-label" for="publishCheck">Publish sekarang</label>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('ui-beranda.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ambil elemen-elemen yang dibutuhkan dari halaman
    const imageInput = document.getElementById('imageUpload');
    const errorDiv = document.getElementById('image-upload-error');
    const form = imageInput.closest('form');
    const submitButton = form.querySelector('button[type="submit"]');

    // Pastikan semua elemen ada sebelum menjalankan script
    if (imageInput && errorDiv && submitButton) {
        const maxSizeInBytes = 10 * 1024 * 1024; // 10MB

        // Tambahkan listener yang aktif saat pengguna memilih file
        imageInput.addEventListener('change', function () {
            // Cek jika ada file yang dipilih
            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];

                // Jika ukuran file melebihi batas
                if (file.size > maxSizeInBytes) {
                    // Tampilkan notifikasi error
                    errorDiv.textContent = 'Ukuran file tidak boleh melebihi 10MB!';
                    errorDiv.style.display = 'block';
                    
                    // Nonaktifkan tombol submit
                    submitButton.disabled = true;
                } else {
                    // Jika file valid, sembunyikan notifikasi dan aktifkan tombol
                    errorDiv.style.display = 'none';
                    submitButton.disabled = false;
                }
            } else {
                // Jika tidak ada file dipilih (misal: user klik cancel), pastikan tombol aktif
                submitButton.disabled = false;
            }
        });
    }
});
</script>
@endpush