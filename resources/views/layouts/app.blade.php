<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GNS Admin')</title>
    
    {{-- Path Aset CSS --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/gnslogo.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    @stack('styles')
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        
        <aside class="left-sidebar">
            <div>
                {{-- PERBAIKAN: Path Logo dan Link --}}
                <a href="{{ url('/dashboard') }}" class="logo-container text-nowrap logo-img text-center d-block py-3 w-100">
                    <img src="{{ asset('images/logos/logogns.svg') }}" width="180" alt="Logo">
                </a>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap"><i class="ti ti-dots nav-small-cap-icon fs-6"></i><span class="hide-menu">Home</span></li>
                        <li class="sidebar-item">
                            {{-- PERBAIKAN: Link menggunakan url() atau route() --}}
                            {{-- <a class="sidebar-link active" href="{{ url('/dashboard') }}" aria-expanded="false"> --}}
                            <a class="sidebar-link active" href="{{ route('dashboard') }}" aria-expanded="false">
                                <span><iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon></span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap"><i class="ti ti-dots nav-small-cap-icon fs-6"></i><span class="hide-menu">EDIT KONTEN</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('ui-beranda') }}">
                                <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                                <span class="hide-menu ms-2">Beranda</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('product_summaries.index') }}">
                                <iconify-icon icon="solar:box-bold-duotone" class="fs-6"></iconify-icon>
                                <span class="hide-menu ms-2">Paket</span>
                            </a>
                        </li>
                         <li class="sidebar-item">
                          <a class="sidebar-link d-flex align-items-center justify-content-between"
                            href="javascript:void(0)"
                            data-bs-toggle="collapse"
                            data-bs-target="#produkMenu"
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                              <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                              <span class="hide-menu ms-2">Produk</span>
                            </div>
                            <iconify-icon icon="mdi:chevron-down" class="fs-6 rotate-icon"></iconify-icon>
                          </a>
                          <ul class="collapse first-level" id="produkMenu">
                            <li class="sidebar-item">
                              <a href="{{ url('/ui-gnet') }}" class="sidebar-link">
                                <span class="hide-menu">Gnet</span>
                              </a>
                            </li>
                            <li class="sidebar-item">
                              <a href="{{ url('/ui-martabe') }}" class="sidebar-link">
                                <span class="hide-menu">Martabe</span>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('posts.index') }}">
                                <iconify-icon icon="solar:file-text-bold-duotone" class="fs-6"></iconify-icon>
                                <span class="hide-menu ms-2">Blog</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('/ui-chatbot') }}">
                                <iconify-icon icon="solar:chat-round-like-bold-duotone" class="fs-6"></iconify-icon>
                                <span class="hide-menu ms-2">Custom Bot</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{-- PERBAIKAN: Path Gambar Profil --}}
                                    <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        {{-- PERBAIKAN: Link Profil --}}
                                        <a href="{{ route('profile.edit') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-outline-primary mx-3 mt-2 d-block">
                                                Logout
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="container-fluid">
                {{-- Di sinilah konten utama halaman (seperti dashboard) akan ditampilkan --}}
                @yield('content')

                <div class="py-6 px-6 text-center">
                    <p class="mb-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> PT Gerbang Nusantara Sakti. All Rights Reserved.</p>
                </div>
                </div>
        </div>
    </div>

    {{-- Path Script --}}
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    @stack('scripts')
</body>
</html>