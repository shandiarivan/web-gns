@extends('layouts.app')
@section('title', 'Kustom Chatbot - GNS Admin')

@section('content')
    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h5 class="card-title fw-semibold mb-4">Tambah Kata Kunci & Balasan</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('chatbot.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="keywords" class="form-label">Kata Kunci</label>
                            <input type="text" class="form-control" id="keywords" name="keywords" required>
                            <div class="form-text">Masukkan kata kunci yang akan memicu balasan dari bot. Pisahkan dengan koma.</div>
                        </div>
                        <div class="mb-3">
                            <label for="response" class="form-label">Balasan</label>
                            <textarea class="form-control" id="response" name="response" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="fw-semibold">Daftar Kata Kunci & Balasan</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kata Kunci</th>
                                <th>Balasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($responses as $response)
                                <tr>
                                    <td>{{ $response->keywords }}</td>
                                    <td>{{ Str::limit($response->response, 100) }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('chatbot.edit', $response->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            
                                            <form action="{{ route('chatbot.destroy', $response->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada kata kunci yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection