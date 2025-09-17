@extends('layouts.app')

@section('title', 'Dashboard - GNS Admin')

@push('styles')
    {{-- Memanggil file CSS khusus untuk halaman ini (jika ada) --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        /* Styling tambahan untuk item pesan dan blog agar rapi */
        .user-avatar {
            height: 40px; width: 40px; background-color: #5d87ff; color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: 0.9rem;
        }
        .activity-item:not(:last-child) {
            border-bottom: 1px solid #eff2f7;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
        .message-item:not(:last-child) {
             border-bottom: 1px solid #eff2f7;
        }
    </style>
@endpush

@section('content')
    {{-- Card Selamat Datang --}}
    <div class="card welcome-card shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8 col-sm-12">
                    <h4 class="card-title">Selamat Datang, {{ Auth::user()->name }}!</h4>
                    <p class="card-subtitle text-muted" id="current-date">Senang melihat Anda kembali.</p>
                </div>
                <div class="col-md-4 col-sm-12 text-md-end text-center mt-3 mt-md-0">
                    <img src="{{ asset('images/logos/gnslogo.png') }}" alt="Welcome illustration" height="60">
                </div>
            </div>
        </div>
    </div>

    {{-- Baris Utama untuk Konten Dashboard --}}
    <div class="row">
        
        {{-- KOLOM KIRI (LEBAR 8 DARI 12) --}}
        <div class="col-lg-8 d-flex flex-column">
            
            <div class="card flex-grow-1">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Aktivitas Blog Terbaru</h5>
                    <div id="latest-posts-container">
                        <p class="text-center text-muted">Memuat aktivitas blog...</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Akses Cepat</h5>
                    <div class="d-grid gap-3">
                        <a href="{{ route('posts.index') }}" class="btn btn-light-info text-info py-3 fs-4 d-flex align-items-center justify-content-center">
                             <i class="ti ti-article me-2 fs-6"></i> Kelola Blog
                        </a>
                        <a href="{{ url('/ui-chatbot') }}" class="btn btn-light-warning text-warning py-3 fs-4 d-flex align-items-center justify-content-center">
                            <i class="ti ti-message-chatbot me-2 fs-6"></i> Kustomisasi Bot
                        </a>
                        <a href="https://gnsss.netlify.app" target="_blank" class="btn btn-light-success text-success py-3 fs-4 d-flex align-items-center justify-content-center">
                            <i class="ti ti-world-www me-2 fs-6"></i> Lihat Website
                        </a>
                    </div>
                </div>
            </div>
            
        </div>

        {{-- KOLOM KANAN (LEBAR 4 DARI 12) --}}
        <div class="col-lg-4 d-flex flex-column">

            <div class="card flex-grow-1">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-semibold mb-3">Pesan Terbaru</h5>
                    <ul class="list-unstyled mb-0 flex-grow-1" id="latest-messages-list">
                        <li class="p-3 text-center text-muted">Memuat pesan terbaru...</li>
                    </ul>
                    <a href="{{ route('ui-message.index') }}" class="btn btn-outline-primary w-100 mt-3">Lihat Semua Pesan</a>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // --- FUNGSI UNTUK TAMPILAN ---

            // Template URL untuk gambar post. "PLACEHOLDER" akan kita ganti dengan nama file.
            const postImageUrlTemplate = '{{ route("posts.image", ["filename" => "PLACEHOLDER"]) }}';

            function updateMessagesList(messages) {
                const container = document.getElementById('latest-messages-list');
                if (!container) return;
                
                container.innerHTML = ''; 
                if (messages.length === 0) {
                    container.innerHTML = '<li class="p-3 text-center text-muted">Tidak ada pesan baru.</li>';
                    return;
                }

                messages.forEach(msg => {
                    const avatar = msg.name.substring(0, 2).toUpperCase();
                    const messageHtml = `
                        <li class="py-3 message-item">
                            <a href="{{ route('ui-message.index') }}" class="d-flex align-items-center text-decoration-none">
                                <div class="user-avatar rounded-circle flex-shrink-0">${avatar}</div>
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-1 fs-4 fw-semibold">${msg.name}</h6>
                                    <p class="mb-0 fs-2 text-dark text-truncate" style="max-width: 200px;">${msg.subject}</p>
                                </div>
                            </a>
                        </li>
                    `;
                    container.innerHTML += messageHtml;
                });
            }

            // === FUNGSI INI YANG KITA PERBARUI ===
            function updatePostsList(posts) {
                const container = document.getElementById('latest-posts-container');
                if (!container) return;
                
                container.innerHTML = '';
                if (posts.length === 0) {
                    container.innerHTML = '<p class="text-center text-muted">Tidak ada aktivitas blog.</p>';
                    return;
                }

                posts.forEach(post => {
                    const statusText = post.is_published ? 'Published' : 'Draft';
                    const editUrl = '{{ url("posts") }}/' + post.id + '/edit';

                    // 1. Cek apakah ada gambar. Jika tidak, gunakan placeholder.
                    const filename = post.image1 ? post.image1.split('/').pop() : null;
                    const imageUrl = filename 
                        ? postImageUrlTemplate.replace('PLACEHOLDER', filename) 
                        : 'https://via.placeholder.com/80x60'; // URL Placeholder

                    const postHtml = `
                        <div class="activity-item">
                            <div class="d-flex align-items-center">
                                <img src="${imageUrl}" width="80" class="rounded-3 flex-shrink-0" alt="Blog Image">
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-semibold fs-4">${post.title}</h6>
                                    <p class="fs-2 mb-0 text-muted">Status: ${statusText}</p>
                                </div>
                                <a href="${editUrl}" class="btn btn-sm btn-light-primary text-primary ms-auto">Lihat</a>
                            </div>
                        </div>
                    `;
                    container.innerHTML += postHtml;
                });
            }

            // --- FUNGSI UTAMA UNTUK MENGAMBIL DATA ---
            async function fetchDashboardData() {
                try {
                    const response = await fetch('{{ route("api.dashboard.data") }}');
                    if (!response.ok) {
                         console.error('Gagal fetch: ' + response.statusText);
                         return;
                    }
                    
                    const data = await response.json();

                    updateMessagesList(data.latestMessages);
                    updatePostsList(data.latestPosts);

                } catch (error) {
                    console.error('Gagal mengambil data dashboard:', error);
                }
            }
            
            // --- INISIALISASI ---
            const dateElement = document.getElementById('current-date');
            if (dateElement) {
                const today = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                dateElement.textContent = today.toLocaleDateString('id-ID', options);
            }

            fetchDashboardData();
            setInterval(fetchDashboardData, 15000);
        });
    </script>
@endpush