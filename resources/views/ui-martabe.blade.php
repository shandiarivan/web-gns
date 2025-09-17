@extends('layouts.app')

@section('title', 'Paket Martabe - GNS Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gnet.css') }}">
@endpush

@section('content')

    {{-- Notifikasi akan muncul di sini --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- HANYA ADA SATU CARD MANAJEMEN PAKET --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Manajemen Paket Internet Martabe</h5>

            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#packageModal">
                + Tambah Paket Martabe
            </button>

            <div class="row" id="packageList">
                @forelse ($packages as $package)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="pricing-card">
                            <div class="card-header">
                                <h5 class="package-name">{{ $package->name }}</h5>
                                <p class="package-tagline">{{ $package->tagline }}</p>
                            </div>
                            <div class="card-price">
                                <p class="price-label">Mulai</p>
                                <h1 class="price-amount">{{ $package->price }}</h1>
                                <p class="price-period">/bulan</p>
                            </div>
                            <div class="card-benefits">
                                <ul>
                                    @foreach(explode(',', $package->benefits) as $benefit)
                                        <li>{{ trim($benefit) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="text-center mb-3">
                                <span class="badge {{ $package->is_published ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $package->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('packages.destroy', $package->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada paket Martabe yang ditambahkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="modal fade" id="packageModal" tabindex="-1" aria-labelledby="packageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="packageModalLabel">Tambah Paket Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('packages.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="martabe">
                        <div class="mb-3">
                            <label for="packageName" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control" id="packageName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="packageTagline" class="form-label">Tagline Paket</label>
                            <input type="text" class="form-control" id="packageTagline" name="tagline" required>
                        </div>
                        <div class="mb-3">
                            <label for="packagePrice" class="form-label">Harga (misal: 150K)</label>
                            <input type="text" class="form-control" id="packagePrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="packageBenefits" class="form-label">Benefits (pisahkan dengan koma)</label>
                            <input type="text" class="form-control" id="packageBenefits" name="benefits" required>
                        </div>
                         <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="publishCheck" name="is_published" value="1">
                            <label class="form-check-label" for="publishCheck">Publish sekarang</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Paket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection