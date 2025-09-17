@extends('layouts.app')
@section('title', 'Pesan - GNS Admin')

@push('styles')
    <style>
        /* Mengatur tinggi panel kanan dan kiri agar sama */
        .inbox-row > .inbox-panel {
            display: flex;
            flex-direction: column;
        }

        /* KUNCI UNTUK SCROLLBAR */
        .message-list-container, .message-detail-body {
            /* Tentukan tinggi maksimal area scroll. 
               calc(80vh - 200px) berarti 80% tinggi layar dikurangi ~200px untuk header/footer.
               Anda bisa menyesuaikan angka 200px ini jika kurang pas. */
            max-height: calc(80vh - 200px);
            overflow-y: auto; /* Tampilkan scrollbar jika konten meluap */
        }
        
        /* Styling item pesan */
        .message-item-link{display:block;color:inherit;text-decoration:none;padding:1rem 1.25rem;border-bottom:1px solid #eff2f7;transition:background-color .2s ease-in-out}.message-item-link:hover{background-color:#f8f9fa;cursor:pointer}.message-item-link.active{background-color:#e9ecef;border-left:3px solid #5d87ff;padding-left:calc(1.25rem - 3px)}.user-avatar{height:40px;width:40px;background-color:#5d87ff;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:.9rem}
        
        /* Media Query untuk Mobile */
        @media (max-width: 991.98px) {
            .inbox-row .col-lg-8 { display: none; }
            .inbox-row.show-detail-mobile .col-lg-4 { display: none; }
            .inbox-row.show-detail-mobile .col-lg-8 { display: block !important; width: 100%;}
            .message-list-container, .message-detail-body {
                max-height: 70vh; /* Sesuaikan tinggi scroll di mobile */
            }
        }
    </style>
@endpush

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="row inbox-row g-0">
                {{-- Kolom Daftar Pesan --}}
                <div class="col-lg-4 border-end inbox-panel">
                    <div class="p-3 border-bottom">
                        <h4 class="fw-semibold mb-3">Kotak Masuk</h4>
                        <form action="{{ route('ui-message.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="ti ti-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <ul class="list-unstyled mb-0 message-list-container">
                        @forelse ($messages as $message)
                            <a href="#" class="message-item-link" data-id="{{ $message->id }}" data-name="{{ $message->name }}" data-email="{{ $message->email }}" data-subject="{{ $message->subject }}" data-body="{{ $message->message }}" data-avatar="{{ strtoupper(substr($message->name, 0, 2)) }}" data-delete-url="{{ route('messages.destroy', $message->id) }}">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar rounded-circle flex-shrink-0">{{ strtoupper(substr($message->name, 0, 2)) }}</div>
                                        <div class="ms-3">
                                            <h6 class="fw-semibold mb-0">{{ $message->name }}</h6>
                                            <p class="fs-2 mb-0 text-muted text-truncate" style="max-width: 200px;">{{ $message->subject }}</p>
                                        </div>
                                        <small class="ms-auto text-muted fs-2">{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                </li>
                            </a>
                        @empty
                            <li class="p-3 text-center text-muted">Tidak ada pesan masuk.</li>
                        @endforelse
                    </ul>
                    <div class="p-3 pagination-container">
                        {{ $messages->links() }}
                    </div>
                </div>

                {{-- Kolom Detail Pesan --}}
                <div class="col-lg-8 inbox-panel">
                    <div class="p-4 d-none" id="messageDetailView">
                        <div class="d-flex align-items-center mb-3">
                            <button id="backToListBtn" class="btn btn-outline-secondary d-lg-none me-3 align-items-center d-inline-flex">
                                <i class="ti ti-arrow-left me-1"></i>
                                <span>Kembali</span>
                            </button>
                            <div class="d-flex align-items-center">
                                <div id="detailAvatar" class="user-avatar rounded-circle flex-shrink-0 fs-5"></div>
                                <div class="ms-3">
                                    <h5 id="detailName" class="fw-semibold mb-0"></h5>
                                    <p id="detailEmail" class="mb-0 fs-2 text-muted"></p>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <a id="replyButton" href="#" class="btn btn-outline-primary btn-sm">Balas</a>
                                <form id="deleteForm" action="" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ms-2" onclick="return confirm('Yakin ingin hapus pesan ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="message-detail-body">
                            <h5 id="detailSubject" class="fw-semibold mb-3"></h5>
                            <div id="detailBody" style="white-space: pre-wrap;"></div>
                        </div>
                    </div>
                    <div class="p-4 d-flex align-items-center justify-content-center h-100" id="selectMessagePrompt">
                        <p class="text-muted">Pilih pesan untuk dibaca</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inboxRow = document.querySelector('.inbox-row');
            const messageLinks = document.querySelectorAll('.message-item-link');
            const detailView = document.getElementById('messageDetailView');
            const selectPrompt = document.getElementById('selectMessagePrompt');
            const backToListBtn = document.getElementById('backToListBtn');
            const detailAvatar = document.getElementById('detailAvatar');
            const detailName = document.getElementById('detailName');
            const detailEmail = document.getElementById('detailEmail');
            const replyButton = document.getElementById('replyButton');
            const deleteForm = document.getElementById('deleteForm');
            const detailSubject = document.getElementById('detailSubject');
            const detailBody = document.getElementById('detailBody');

            messageLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    messageLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    const data = this.dataset;
                    detailAvatar.textContent = data.avatar;
                    detailName.textContent = data.name;
                    detailEmail.textContent = data.email;
                    replyButton.href = `mailto:${data.email}`;
                    deleteForm.action = data.deleteUrl;
                    detailSubject.textContent = data.subject;
                    detailBody.textContent = data.body;
                    selectPrompt.classList.add('d-none');
                    detailView.classList.remove('d-none');
                    if (inboxRow) {
                        inboxRow.classList.add('show-detail-mobile');
                    }
                });
            });

            if (backToListBtn && inboxRow) {
                backToListBtn.addEventListener('click', function() {
                    inboxRow.classList.remove('show-detail-mobile');
                    messageLinks.forEach(l => l.classList.remove('active'));
                    selectPrompt.classList.remove('d-none');
                    detailView.classList.add('d-none');
                });
            }
        });
    </script>
@endpush