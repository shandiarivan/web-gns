@extends('layouts.app')
@section('title', 'Blog - GNS Admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h5 class="card-title fw-semibold mb-4">Konten Blog</h5>

            <!-- Pencarian -->
            <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul atau deskripsi..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>

            <!-- Tambah Konten -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addContentModal">+ Tambah Konten</button>
            
            <div class="row" id="contentList">
                @forelse ($posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="blog-card">
                        {{-- <img src="{{ $post->image1 ? route('posts.image', ['filename' => basename($post->image1)]) : 'https://via.placeholder.com/400x250' }}" class="card-img-top" alt="Blog Image"> --}}
                        <img src="{{ $post->image1 ? route('posts.image', ['filename' => basename($post->image1)]) : 'https://via.placeholder.com/400x250' }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Blog Image">
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->description, 90) }}</p>
                            
                            <div class="card-actions">
                                <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-warning text-dark' }} me-auto">{{ $post->is_published ? 'Published' : 'Draft' }}</span>
                                
                                <a href="#" class="btn btn-sm btn-info" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#detailModal"
                                    data-title="{{ $post->title }}"
                                    data-description="{{ $post->description }}"
                                    data-status="{{ $post->is_published ? 'Published' : 'Draft' }}"
                                    data-status-class="{{ $post->is_published ? 'bg-success' : 'bg-warning text-dark' }}"
                                    data-date="{{ \Carbon\Carbon::parse($post->published_at)->format('d F Y') }}"
                                    data-image1="{{ $post->image1 ? route('posts.image', ['filename' => basename($post->image1)]) : '' }}"
                                    data-image2="{{ $post->image2 ? route('posts.image', ['filename' => basename($post->image2)]) : '' }}"
                                    data-image3="{{ $post->image3 ? route('posts.image', ['filename' => basename($post->image3)]) : '' }}">
                                    Detail
                                </a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada postingan blog.</p>
                </div>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Tambah Konten -->
    <div class="modal fade" id="addContentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Konten Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3"><label class="form-label">Judul Konten</label><input type="text" class="form-control" name="title" required></div>
                        <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description" rows="4" required></textarea></div>
                        <div class="mb-3">
                            <label for="published_at" class="form-label">Tanggal Publikasi</label>
                            <input type="date" class="form-control" name="published_at" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4"><label class="form-label">Gambar Utama</label><input type="file" class="form-control" name="image1" accept="image/*"></div>
                            <div class="col-md-4"><label class="form-label">Gambar 2 (Opsional)</label><input type="file" class="form-control" name="image2" accept="image/*"></div>
                            <div class="col-md-4"><label class="form-label">Gambar 3 (Opsional)</label><input type="file" class="form-control" name="image3" accept="image/*"></div>
                        </div>
                        <!-- Notifikasi Ukuran Maks gambar -->
                        <div id="image-upload-error" class="error-js-message"></div>

                        <div class="mb-3 form-check"><input type="checkbox" class="form-check-input" id="publishCheck" name="is_published" value="1"><label class="form-check-label" for="publishCheck">Publish sekarang</label></div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Konten</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Konten -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                      <h5 class="modal-title" id="detailTitle">Detail Konten</h5>
                    <h6 id="detailDate" class="text-muted"></h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="detailImageCarousel" class="carousel slide carousel-dark mb-3" data-bs-ride="carousel">
                        <div class="carousel-inner" id="detailCarouselInner">
                            {{-- Gambar-gambar akan dimasukkan di sini oleh JS --}}
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#detailImageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#detailImageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p id="detailDescription"></p>
                    <span id="detailStatus" class="badge"></span>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    
    // ===================================================================
    // KODE VALIDASI FILE
    // ===================================================================
    const addContentModal = document.getElementById('addContentModal');
    if (addContentModal) {
        const form = addContentModal.querySelector('form');
        const fileInputs = form.querySelectorAll('input[type="file"]');
        const errorDiv = form.querySelector('#image-upload-error');
        const submitButton = form.querySelector('button[type="submit"]'); 
        const maxSizeInBytes = 10 * 1024 * 1024; // 10MB

        const validateFiles = () => {
            let isFileTooLarge = false;
            for (const input of fileInputs) {
                if (input.files.length > 0 && input.files[0].size > maxSizeInBytes) {
                    isFileTooLarge = true;
                    break; 
                }
            }

            if (isFileTooLarge) {
                errorDiv.textContent = 'Ukuran salah satu file tidak boleh melebihi 10MB!';
                errorDiv.style.display = 'block';
                submitButton.disabled = true; // Nonaktifkan tombol submit
            } else {
                errorDiv.style.display = 'none';
                submitButton.disabled = false; // Aktifkan kembali tombol submit
            }
        };

        fileInputs.forEach(input => {
            input.addEventListener('change', validateFiles);
        });

        // Reset notifikasi dan tombol saat modal dibuka/ditutup
        addContentModal.addEventListener('hidden.bs.modal', function () {
            form.reset();
            errorDiv.style.display = 'none';
            submitButton.disabled = false;
        });
    }

    // ===================================================================
    // Kode untuk detail Modal 
    // ===================================================================
    const detailModal = document.getElementById('detailModal');
    if (detailModal) {
        detailModal.addEventListener('show.bs.modal', function (event) {
            // ... (kode modal detail Anda tetap sama, tidak perlu diubah) ...
            const button = event.relatedTarget;
            const title = button.dataset.title;
            const description = button.dataset.description;
            const status = button.dataset.status;
            const statusClass = button.dataset.statusClass;
            const date = button.dataset.date; // <-- AMBIL DATA TANGGAL
            const image1 = button.dataset.image1;
            const image2 = button.dataset.image2;
            const image3 = button.dataset.image3;

            const modalTitle = detailModal.querySelector('#detailTitle');
            const carouselInner = detailModal.querySelector('#detailCarouselInner');
            const modalDescription = detailModal.querySelector('#detailDescription');
            const modalStatus = detailModal.querySelector('#detailStatus');
            const modalDate = detailModal.querySelector('#detailDate'); // <-- AMBIL WADAH TANGGAL
            
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modalStatus.textContent = status;
            modalStatus.className = 'badge ' + statusClass;
            modalDate.textContent = 'Dipublikasikan pada: ' + date; // <-- TAMPILKAN TANGGAL

            carouselInner.innerHTML = '';
            let images = [image1, image2, image3].filter(img => img);
            
            const carousel = detailModal.querySelector('#detailImageCarousel');

            if (images.length === 0) {
                if(carousel) carousel.style.display = 'none';
                return;
            }

            if(carousel) carousel.style.display = 'block';

            images.forEach((imgSrc, index) => {
                let activeClass = (index === 0) ? 'active' : '';
                carouselInner.innerHTML += `
                    <div class="carousel-item ${activeClass}">
                        <img src="${imgSrc}" class="d-block w-100" style="height: 300px; object-fit: contain;" alt="Blog Image">
                    </div>
                `;
            });
        });
    }
});
</script>
@endpush