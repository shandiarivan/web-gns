// public/js/beranda.js - VERSI EVENT DELEGATION

document.addEventListener('DOMContentLoaded', () => {

    // --- LOGIKA UNTUK FITUR KONTEN PROMO ---
    
    //  ambil elemennya untuk referensi, tapi listener utamanya diubah
    const imageUpload = document.getElementById('imageUpload');
    const previewImage = document.getElementById('previewImage');

    // Cek apakah elemen-elemen ini ada
    if (imageUpload && previewImage) {
        // Fungsi untuk menampilkan preview gambar (ini tidak berubah)
        imageUpload.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewImage.classList.remove('d-none');
            }
        });
    }

    // ======================================================
    // LOGIKA UNTUK MODAL DETAIL 
    // ======================================================

     const detailModal = document.getElementById('detailModal');

    // Cek jika modalnya ada di halaman ini
    if (detailModal) {
        // Dengarkan event 'show.bs.modal' yang dipicu oleh Bootstrap
        detailModal.addEventListener('show.bs.modal', function(event) {
            // 'event.relatedTarget' adalah tombol yang baru saja diklik
            const button = event.relatedTarget; 

            // Ambil data dari atribut data-* di tombol
            const imageUrl = button.dataset.image;
            const description = button.dataset.description;
            const status = button.dataset.status;
            const statusClass = button.dataset.statusClass;

            // Cari elemen di dalam modal yang akan diisi
            const modalImage = detailModal.querySelector('#detailImage');
            const modalDescription = detailModal.querySelector('#detailDescription');
            const modalStatus = detailModal.querySelector('#detailStatus');

            // Isi elemen modal dengan data yang diambil
            modalImage.src = imageUrl;
            modalDescription.textContent = description;
            modalStatus.textContent = status;

            // Reset class & tambahkan class status yang baru (misal: bg-success)
            modalStatus.className = 'badge'; 
            modalStatus.classList.add(statusClass);
        });
    }

    // ===================================================================
    //  Menggunakan Event Delegation untuk submit form
    // ===================================================================
    // document.body.addEventListener('submit', function(event) {
    //     // Cek apakah event-nya berasal dari form dengan id 'contentForm'
    //     if (event.target && event.target.id === 'contentForm') {
            
    //         console.log('Form #contentForm di-submit! Memeriksa file...');

    //         const fileInput = document.getElementById('imageUpload');
            
    //         if (fileInput && fileInput.files.length > 0) {
    //             const file = fileInput.files[0];
    //             const maxSizeInBytes = 10 * 1024 * 1024; // 10MB

    //             if (file.size > maxSizeInBytes) {
    //                 // Ambil div notifikasi dari HTML
    //                 const errorDiv = document.getElementById('image-upload-error');
                    
    //                 // Tampilkan pesan di dalam div tersebut
    //                 errorDiv.textContent = 'Ukuran file tidak boleh melebihi 10MB!';
    //                 errorDiv.style.display = 'block';
                    
    //                 // Tetap batalkan submit
    //                 event.preventDefault();
    //             } else {
    //                 console.log('Ukuran file OK. Form akan dikirim ke server.');
    //             }
    //         }
    //     }
    // });

});