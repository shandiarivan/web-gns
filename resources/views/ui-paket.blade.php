@extends('layouts.app')

@section('title', 'Kelola Paket Unggulan - GNS Admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h5 class="card-title fw-semibold mb-4">Kelola Konten Paket Unggulan</h5>
    <p class="mb-3">Ubah konten yang akan tampil pada kartu produk di halaman "Paket Internet" website publik.</p>

    <div class="row">
        {{-- FORM UNTUK G-NET --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Paket G-Net</h5>
                    <form action="{{ route('product_summaries.update', $gnet->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="gnet_title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="gnet_title" name="title" value="{{ old('title', $gnet->title) }}">
                        </div>
                        <div class="mb-3">
                            <label for="gnet_tagline" class="form-label">Tagline</label>
                            <input type="text" class="form-control" id="gnet_tagline" name="tagline" value="{{ old('tagline', $gnet->tagline) }}">
                        </div>
                         <div class="mb-3">
                            <label for="gnet_price" class="form-label">Harga (Contoh: 250.000)</label>
                            <input type="text" class="form-control" id="gnet_price" name="price" value="{{ old('price', $gnet->price) }}">
                        </div>
                        <div class="mb-3">
                            <label for="gnet_features" class="form-label">Fitur (Satu fitur per baris)</label>
                            <textarea name="features" id="gnet_features" class="form-control" rows="4">{{ old('features', $gnet->features) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan G-Net</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- FORM UNTUK MARTABE --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Paket Martabe</h5>
                     <form action="{{ route('product_summaries.update', $martabe->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="martabe_title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="martabe_title" name="title" value="{{ old('title', $martabe->title) }}">
                        </div>
                        <div class="mb-3">
                            <label for="martabe_tagline" class="form-label">Tagline</label>
                            <input type="text" class="form-control" id="martabe_tagline" name="tagline" value="{{ old('tagline', $martabe->tagline) }}">
                        </div>
                         <div class="mb-3">
                            <label for="martabe_price" class="form-label">Harga (Contoh: 450.000)</label>
                            <input type="text" class="form-control" id="martabe_price" name="price" value="{{ old('price', $martabe->price) }}">
                        </div>
                        <div class="mb-3">
                            <label for="martabe_features" class="form-label">Fitur (Satu fitur per baris)</label>
                            <textarea name="features" id="martabe_features" class="form-control" rows="4">{{ old('features', $martabe->features) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan Martabe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection