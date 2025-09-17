@extends('layouts.app')

@section('title', 'Edit Paket - GNS Admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Paket: {{ $package->name }}</h5>

            <form action="{{ route('packages.update', $package->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Method untuk update --}}

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Paket</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $package->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="tagline" class="form-label">Tagline Paket</label>
                    <input type="text" class="form-control" id="tagline" name="tagline" value="{{ old('tagline', $package->tagline) }}" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga (misal: 150K)</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $package->price) }}" required>
                </div>
                <div class="mb-3">
                    <label for="benefits" class="form-label">Benefits (pisahkan dengan koma)</label>
                    <input type="text" class="form-control" id="benefits" name="benefits" value="{{ old('benefits', $package->benefits) }}" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="publishCheck" name="is_published" value="1" {{ $package->is_published ? 'checked' : '' }}>
                    <label class="form-check-label" for="publishCheck">Publish sekarang</label>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                {{-- <a href="{{ route('ui-gnet') }}" class="btn btn-secondary">Batal</a> --}}
                <a href="{{ $package->type === 'gnet' ? route('ui-gnet') : route('ui-martabe') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection