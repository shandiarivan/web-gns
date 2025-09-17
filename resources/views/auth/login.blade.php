<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Web Admin - GNS</title>
  {{-- PERBAIKAN: Menggunakan helper asset() untuk path --}}
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/gnslogo.png') }}" />
  <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />

  <style>
    .success-message {
    padding: 1rem;
    margin-bottom: 1rem;
    background-color: #d1fae5; /* Hijau muda */
    color: #065f46; /* Hijau tua */
    border-radius: 0.5rem;
    text-align: center;
  }

      .notification-message {
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 0.5rem;
        text-align: center;
        border: 1px solid transparent;
    }

      .error-message {
        background-color: #fee2e2;
        color: #b91c1c;
        border-color: #fecaca;
    }
  </style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  {{-- PERBAIKAN: Menggunakan helper asset() untuk path gambar --}}
                  <img src="{{ asset('images/logos/logogns.svg') }}" width="180" alt="Logo">
                </a>
                {{-- <p class="text-center">Your Social Campaigns</p> --}}

                    {{-- ====================================================== --}}
                    {{-- Notifikasi --}}
                    {{-- ====================================================== --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="notification-message error-message" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- ====================================================== --}}

                {{--  Menyesuaikan form untuk Laravel --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Input Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        {{-- Menambahkan 'name', 'value', dan error handling --}}
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div class="mb-4">
                        <label for="password" class="form-label">Kata Sandi</label>
                         {{--  Menambahkan 'name' dan error handling --}}
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                         @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{--  Menambahkan 'name' untuk remember me --}}
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check">
                            
                            <input class="form-check-input primary" type="checkbox" name="remember" id="flexCheckChecked">
                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                Ingat Saya
                            </label>
                        </div>
                        
                        {{-- <a class="text-primary fw-bold" href="{{ route('password.request') }}">Forgot Password ?</a> --}}
                    </div>
                    
                    {{--  Mengubah <a> menjadi <button type="submit"> --}}
                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Masuk</button>
                    
                    {{-- <div class="d-flex align-items-center justify-content-center">
                        <p class="fs-4 mb-0 fw-bold">New to SeoDash?</p>
                        Menggunakan route() untuk link dinamis
                        <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Create an account</a>
                    </div> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Menggunakan helper asset() untuk path --}}
  <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>