@extends('layouts.app')

@section('title', 'Beranda - GNS Admin')

@push('styles')
    {{-- PERBAIKAN: Menggunakan tag <link> untuk file CSS --}}
    <link rel="stylesheet" href="{{ asset('css/gnet.css') }}">
@endpush


@section('content')

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- CARD DATA STATISTIK -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stat-card-beranda">
                    <h5 class="card-title">Kota/Kabupaten</h5>
                    <p class="stat-number">{{ $settings['jumlah_kota'] ?? 0 }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-beranda">
                    <h5 class="card-title">Kelurahan</h5>
                    <p class="stat-number">{{ $settings['jumlah_kelurahan'] ?? 0 }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card-beranda">
                    <h5 class="card-title">Pelanggan</h5>
                    <p class="stat-number">{{ $settings['jumlah_pelanggan'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- KONTEN -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Konten Promo</h5>

                <!-- Pencarian -->
                <form action="{{ route('ui-beranda.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari promo berdasarkan deskripsi..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                <!-- Tambah Konten -->
                <button id="addContentBtn" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addContentModal">+ Tambah Konten</button>
                
                <div class="row" id="contentList">
                    @forelse ($promos as $promo)
                        <div class="col-lg-4 col-md-6 mb-4">
                            {{-- MODIFIKASI: Menggunakan class CSS baru --}}
                            <div class="promo-card-beranda">
                                <img src="{{ route('promo.image', ['filename' => basename($promo->image_path)]) }}" class="card-img-top" alt="Promo Image">
                                <div class="card-body">
                                    <p class="card-text">{{ Str::limit($promo->description, 100) }}</p>
                                    <div class="card-actions">
                                        <span class="badge bg-{{ $promo->is_published ? 'success' : 'warning text-dark' }} me-auto">{{ $promo->is_published ? 'Published' : 'Draft' }}</span>
                                        {{-- <a href="#" class="btn btn-sm btn-info" ...>Detail</a> --}}
                                        <a href="#" class="btn btn-sm btn-info" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detailModal"
                                            data-image="{{ route('promo.image', ['filename' => basename($promo->image_path)]) }}"
                                            data-description="{{ $promo->description }}"
                                            data-status="{{ $promo->is_published ? 'Published' : 'Draft' }}"
                                            data-status-class="bg-{{ $promo->is_published ? 'success' : 'warning text-dark' }}">
                                            Detail
                                        </a>
                                        <a href="{{ route('promos.edit', $promo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('promos.destroy', $promo->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-center text-muted">Belum ada konten promo.</p></div>
                    @endforelse
                </div>
                <div class="mt-4">
                  {{ $promos->links() }}
                </div>
            </div>
        </div>

        <!-- UBAH DATA STATISTIK -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Ubah Data Statistik</h5>
                <form action="{{ route('ui-beranda.statistics.update') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                      <label for="kotaInput" class="form-label">Jumlah Kota/Kabupaten</label>
                      <input type="number" class="form-control" id="kotaInput" name="jumlah_kota" value="{{ $settings['jumlah_kota'] ?? '' }}" required>
                  </div>
                  <div class="mb-3">
                      <label for="kelurahanInput" class="form-label">Jumlah Kelurahan</label>
                      <input type="number" class="form-control" id="kelurahanInput" name="jumlah_kelurahan" value="{{ $settings['jumlah_kelurahan'] ?? '' }}" required>
                  </div>
                  <div class="mb-3">
                      <label for="pelangganInput" class="form-label">Jumlah Pelanggan</label>
                      <input type="number" class="form-control" id="pelangganInput" name="jumlah_pelanggan" value="{{ $settings['jumlah_pelanggan'] ?? '' }}" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan Data</button>
              </form>
            </div>
        </div>


  <!-- Modal Tambah / Edit Konten -->
  <div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addContentModalLabel">Tambah Konten Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="contentForm" action="{{ route('promos.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                  <label for="imageUpload" class="form-label">Upload Gambar (Max: 10MB)</label>
                  <input type="file" class="form-control" id="imageUpload" name="image" accept="image/*" required>
              </div>

              <!-- Notifikasi Upload -->
              <div id="image-upload-error" class="alert alert-danger mt-2" style="display: none;"></div>
              
              <div class="mb-3">
                  <label for="contentDescription" class="form-label">Deskripsi Konten</label>
                  <textarea class="form-control" id="contentDescription" name="description" rows="4" required>{{ old('description') }}</textarea>
              </div>
              <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="publishCheck" name="is_published" value="1">
                  <label class="form-check-label" for="publishCheck">Publish sekarang</label>
              </div>
              <button type="submit" class="btn btn-primary w-100">Simpan Konten</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Detail Deskripsi -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Konten</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <img id="detailImage" class="img-fluid rounded mb-3" />
          <p id="detailDescription"></p>
          <span id="detailStatus" class="badge"></span>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')

{{-- <script src="{{ asset('js/beranda.js') }}"></script> --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ambil elemen-elemen penting dari modal tambah konten
    const addContentModal = document.getElementById('addContentModal');
    
    // Pastikan modal ada di halaman ini sebelum menjalankan script
    if (addContentModal) {
        const contentForm = addContentModal.querySelector('#contentForm');
        const imageInput = addContentModal.querySelector('#imageUpload');
        const errorDiv = addContentModal.querySelector('#image-upload-error');
        const submitButton = contentForm.querySelector('button[type="submit"]');
        const maxSizeInBytes = 10 * 1024 * 1024; // 10MB

        // === LOGIKA UTAMA VALIDASI ===
        // Tambahkan listener yang akan aktif setiap kali pengguna memilih file
        imageInput.addEventListener('change', function () {
            // Cek apakah ada file yang dipilih
            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];

                // Jika ukuran file melebihi batas maksimal
                if (file.size > maxSizeInBytes) {
                    // 1. Tampilkan pesan error
                    errorDiv.textContent = 'Ukuran file tidak boleh melebihi 10MB!';
                    errorDiv.style.display = 'block';
                    
                    // 2. Nonaktifkan tombol submit untuk mencegah pengiriman
                    submitButton.disabled = true;
                } else {
                    // Jika ukuran file valid, sembunyikan error dan aktifkan tombol
                    errorDiv.style.display = 'none';
                    submitButton.disabled = false;
                }
            }
        });

        // === LOGIKA RESET FORM SAAT MODAL DITUTUP ===
        // Ini penting agar notifikasi error hilang saat modal dibuka kembali
        addContentModal.addEventListener('hidden.bs.modal', function () {
            contentForm.reset(); // Mereset semua isian form, termasuk file input
            errorDiv.style.display = 'none'; // Sembunyikan pesan error
            submitButton.disabled = false; // Aktifkan kembali tombol submit
        });
    }

     // ==========================================================
    // BAGIAN 2: LOGIKA MODAL DETAIL (KODE YANG HILANG)
    // ==========================================================
    const detailModal = document.getElementById('detailModal');
    if (detailModal) {
        detailModal.addEventListener('show.bs.modal', function (event) {
            // Ambil data dari tombol yang di-klik
            const button = event.relatedTarget;
            const description = button.dataset.description;
            const status = button.dataset.status;
            const statusClass = button.dataset.statusClass;
            const imageUrl = button.dataset.image;

            // Ambil elemen di dalam modal
            const modalImage = detailModal.querySelector('#detailImage');
            const modalDescription = detailModal.querySelector('#detailDescription');
            const modalStatus = detailModal.querySelector('#detailStatus');
            
            // Masukkan data ke dalam elemen modal
            modalDescription.textContent = description;
            modalStatus.textContent = status;
            modalStatus.className = 'badge ' + statusClass; // Atur kelas untuk warna badge
            
            if (imageUrl) {
                modalImage.src = imageUrl;
                modalImage.style.display = 'block';
            } else {
                modalImage.style.display = 'none';
            }
        });
    }
});
</script>
@endpush


