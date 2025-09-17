@extends('layouts.app')

@section('title', 'Profil Saya - GNS Admin')

@section('content')
    <div class="row">
        {{-- Kolom untuk Informasi Profil --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Informasi Profil</h5>
                    <p class="mb-3">Perbarui informasi profil dan alamat email akun Anda.</p>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        {{-- Menampilkan pesan sukses setelah update --}}
                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success" role="alert">
                                Profil berhasil disimpan.
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                             @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Kolom untuk Ubah Password --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Ubah Password</h5>
                    <p class="mb-3">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        
                        {{-- Menampilkan pesan sukses setelah update --}}
                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success" role="alert">
                                Password berhasil diperbarui.
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                             @error('current_password', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                             @error('password', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection