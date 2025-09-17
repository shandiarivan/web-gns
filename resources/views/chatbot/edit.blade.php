@extends('layouts.app')
@section('title', 'Edit Kata Kunci - GNS Admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit Kata Kunci & Balasan</h5>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('chatbot.update', $chatbot->id) }}" method="POST">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="keywords" class="form-label">Kata Kunci</label>
                        <input type="text" class="form-control" id="keywords" name="keywords" value="{{ old('keywords', $chatbot->keywords) }}" required>
                        <div class="form-text">Masukkan kata kunci yang akan memicu balasan dari bot. Pisahkan dengan koma.</div>
                    </div>
                    <div class="mb-3">
                        <label for="response" class="form-label">Balasan</label>
                        <textarea class="form-control" id="response" name="response" rows="3" required>{{ old('response', $chatbot->response) }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('chatbot.index') }}" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection