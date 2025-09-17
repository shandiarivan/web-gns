
@extends('layouts.app')

@section('title', 'Dashboard - GNS Admin')

@push('styles')
    {{-- Memanggil file CSS khusus untuk halaman ini --}}
    <script src="{{ asset('css/dashboard.css') }}"></script>
@endpush

@section('content')
        <!-- ====================================================== -->
        <!-- BAGIAN KONTEN -->
        <!-- ====================================================== -->

        <!-- Welcome Banner -->
        <div class="card welcome-card shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="card-title">Selamat Datang, Admin!</h4>
                        <p class="card-subtitle" id="current-date">Senang melihat Anda kembali.</p>
                    </div>
                    <div class="col-4 text-end">
                        <img src="{{ asset('images/logos/gnslogo.png') }}" alt="Welcome illustration" height="60">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Kolom Utama (Kiri) -->
            <div class="col-lg-8">
                <!-- Statistik Pengunjung -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Statistik Pengunjung (7 Hari Terakhir)</h5>
                        <div id="visitor-stats-chart"></div>
                    </div>
                </div>

                <!-- Aktivitas Blog Terbaru -->
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title fw-semibold mb-4">Aktivitas Blog Terbaru</h5>
                      <div class="d-flex align-items-center pb-3 border-bottom activity-item">
                        <img src="../assets/images/blog/blog-img1.jpg" class="rounded-3" alt="img">
                        <div class="ms-3">
                          <h6 class="mb-1 fw-semibold fs-4">Promo Internet Merdeka</h6>
                          <p class="fs-2 mb-0 text-muted">Dipublikasikan 2 hari lalu</p>
                        </div>
                        <a href="#" class="btn btn-sm btn-light-primary text-primary ms-auto">Lihat</a>
                      </div>
                       <div class="d-flex align-items-center py-3 border-bottom activity-item">
                        <img src="../assets/images/blog/blog-img2.jpg" class="rounded-3" alt="img">
                        <div class="ms-3">
                          <h6 class="mb-1 fw-semibold fs-4">Tips Memilih Router</h6>
                          <p class="fs-2 mb-0 text-muted">Status: Draft</p>
                        </div>
                        <a href="#" class="btn btn-sm btn-light-primary text-primary ms-auto">Edit</a>
                      </div>
                      <div class="d-flex align-items-center pt-3 activity-item">
                        <img src="../assets/images/blog/blog-img3.jpg" class="rounded-3" alt="img">
                        <div class="ms-3">
                          <h6 class="mb-1 fw-semibold fs-4">Jangkauan Area Baru!</h6>
                          <p class="fs-2 mb-0 text-muted">Dipublikasikan 1 minggu lalu</p>
                        </div>
                        <a href="#" class="btn btn-sm btn-light-primary text-primary ms-auto">Lihat</a>
                      </div>
                    </div>
                  </div>
            </div>

            <!-- Kolom Samping (Kanan) -->
            <div class="col-lg-4">
                <!-- Pesan Terbaru dari Pengguna -->
                 <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-3">Pesan Terbaru</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="py-3 border-bottom message-item">
                                <a href="#" class="d-flex align-items-center text-decoration-none">
                                    <div class="user-avatar rounded-circle flex-shrink-0"> AS </div>
                                    <div class="ms-3 flex-grow-1">
                                        <h6 class="mb-1 fs-4 fw-semibold">Andi Setiawan</h6>
                                        <p class="mb-0 fs-2 text-dark message-subject">Permintaan Pemasangan Baru</p>
                                    </div>
                                    <span class="fs-2 text-muted flex-shrink-0">Baru Saja</span>
                                </a>
                            </li>
                             <li class="py-3 border-bottom message-item">
                                <a href="#" class="d-flex align-items-center text-decoration-none">
                                    <div class="user-avatar rounded-circle flex-shrink-0"> BD </div>
                                    <div class="ms-3 flex-grow-1">
                                        <h6 class="mb-1 fs-4 fw-semibold">Budi Darmawan</h6>
                                        <p class="mb-0 fs-2 text-dark message-subject">Keluhan Jaringan Lambat</p>
                                    </div>
                                    <span class="fs-2 text-muted flex-shrink-0">15m lalu</span>
                                </a>
                            </li>
                             <li class="py-3 message-item">
                                <a href="#" class="d-flex align-items-center text-decoration-none">
                                    <div class="user-avatar rounded-circle flex-shrink-0"> CT </div>
                                    <div class="ms-3 flex-grow-1">
                                        <h6 class="mb-1 fs-4 fw-semibold">Citra Lestari</h6>
                                        <p class="mb-0 fs-2 text-dark message-subject">Pertanyaan Mengenai Paket Bisnis</p>
                                    </div>
                                    <span class="fs-2 text-muted flex-shrink-0">1j lalu</span>
                                </a>
                            </li>
                        </ul>
                         <a href="{{ url('/ui-message') }}" class="btn btn-outline-primary w-100 mt-3">Lihat Semua Pesan</a>
                    </div>
                </div>

                <!-- Akses Cepat -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Akses Cepat</h5>
                        <div class="d-grid gap-3">
                            <a href="./ui-Blog.html" class="btn btn-light-info text-info py-3 fs-4 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:file-text-bold-duotone" class="me-2 fs-6"></iconify-icon> Kelola Blog
                            </a>
                            <a href="./ui-chatbot.html" class="btn btn-light-warning text-warning py-3 fs-4 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:chat-round-like-bold-duotone" class="me-2 fs-6"></iconify-icon> Kustomisasi Bot
                            </a>
                            <a href="https://gnsss.netlify.app" target="_blank" class="btn btn-light-success text-success py-3 fs-4 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:link-round-bold-duotone" class="me-2 fs-6"></iconify-icon> Lihat Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@push('scripts')
    {{-- Memanggil file JS khusus untuk halaman ini --}}
    <script src="{{ asset('js/dashboard2.js') }}"></script>
@endpush


