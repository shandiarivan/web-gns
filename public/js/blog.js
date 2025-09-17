document.addEventListener('DOMContentLoaded', () => {
    const contentForm = document.getElementById('contentForm');
    const contentList = document.getElementById('contentList');
    const editIndexInput = document.getElementById('editIndex');
    const addContentBtn = document.getElementById('addContentBtn');

    // Referensi untuk 3 uploader
    const uploadBoxes = document.querySelectorAll('.upload-box');
    
    // PERUBAHAN: Referensi ke input judul
    const contentTitleInput = document.getElementById('contentTitle');

    let imageFiles = [null, null, null];
    let contents = []; 

    function resetModalForm() {
        contentForm.reset();
        editIndexInput.value = "";
        imageFiles = [null, null, null];
        uploadBoxes.forEach(box => {
            const img = box.querySelector('img');
            const removeBtn = box.querySelector('.btn-remove-image');
            img.src = "#";
            img.classList.add('d-none');
            removeBtn.classList.add('d-none');
        });
        document.getElementById("addContentModalLabel").textContent = "Tambah Konten Baru";
    }

    addContentBtn.addEventListener('click', resetModalForm);

    uploadBoxes.forEach((box, index) => {
        const input = box.querySelector('input[type="file"]');
        const img = box.querySelector('img');
        const removeBtn = box.querySelector('.btn-remove-image');

        input.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                imageFiles[index] = file;
                img.src = URL.createObjectURL(file);
                img.classList.remove('d-none');
                removeBtn.classList.remove('d-none');
            }
        });

        removeBtn.addEventListener('click', function() {
            input.value = ""; 
            img.src = "#";
            img.classList.add('d-none');
            removeBtn.classList.add('d-none');
            imageFiles[index] = null;
        });
    });


    function renderContents() {
        contentList.innerHTML = "";
        contents.forEach((c, index) => {
            let shortDesc = c.description.length > 50 ? c.description.substring(0, 50) + "..." : c.description;
            let mainImage = c.images[0] || 'https://placehold.co/600x400?text=No+Image';

            // PERUBAHAN: Menambahkan judul ke kartu
            let card = `
                <div class="col-md-4 mb-3">
                  <div class="card h-100 shadow-sm">
                    <img src="${mainImage}" class="card-img-top" alt="Konten">
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title fw-bold">${c.title}</h5>
                      <p class="card-text">${shortDesc}</p>
                      <span class="badge ${c.publish === "Published" ? "bg-success" : "bg-secondary"}">${c.publish}</span>
                      <div class="mt-auto pt-3 d-flex justify-content-between">
                        <button class="btn btn-sm btn-info" onclick="showDetail(${index})">Detail</button>
                        <button class="btn btn-sm btn-warning" onclick="editContent(${index})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteContent(${index})">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
            `;
            contentList.innerHTML += card;
        });
    }

    function readFileAsDataURL(file) {
        return new Promise((resolve, reject) => {
            if (!file) {
                resolve(null);
                return;
            }
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    contentForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // PERUBAHAN: Mengambil nilai judul
        const title = contentTitleInput.value;
        const description = document.getElementById('contentDescription').value;
        const publish = document.getElementById('publishCheck').checked ? "Published" : "Draft";
        const editIndex = editIndexInput.value;

        try {
            const imagePromises = imageFiles.map(file => readFileAsDataURL(file));
            const base64Images = await Promise.all(imagePromises);

            if (editIndex === "") { // Mode Tambah
                const finalImages = base64Images.filter(img => img);
                if (finalImages.length === 0) {
                    alert('Minimal unggah satu gambar.');
                    return;
                }
                // PERUBAHAN: Menambahkan 'title' ke objek
                contents.push({ title, images: finalImages, description, publish });
            } else { // Mode Edit
                const existingImages = [...contents[editIndex].images]; // Buat salinan
                const finalImages = [null, null, null];

                for (let i = 0; i < 3; i++) {
                    if (imageFiles[i] !== null) { // Jika ada file baru (termasuk yg null karena dihapus)
                        finalImages[i] = base64Images[i];
                    } else {
                        finalImages[i] = existingImages[i] || null;
                    }
                }
                
                // PERUBAHAN: Menambahkan 'title' saat mengedit
                contents[editIndex] = {
                    title,
                    images: finalImages.filter(img => img), // Hapus slot null
                    description,
                    publish
                };
            }

            renderContents();
            const modal = bootstrap.Modal.getInstance(document.getElementById('addContentModal'));
            modal.hide();
        } catch (error) {
            console.error("Gagal memproses gambar:", error);
            alert("Terjadi kesalahan saat mengupload gambar.");
        }
    });

    document.getElementById('addContentModal').addEventListener('hidden.bs.modal', resetModalForm);

    window.editContent = function(index) {
        resetModalForm();
        const c = contents[index];
        
        // PERUBAHAN: Mengisi input judul saat edit
        contentTitleInput.value = c.title;
        document.getElementById('contentDescription').value = c.description;
        document.getElementById('publishCheck').checked = c.publish === "Published";
        editIndexInput.value = index;
        document.getElementById("addContentModalLabel").textContent = "Edit Konten";

        c.images.forEach((imgSrc, i) => {
            const box = uploadBoxes[i];
            if (box) {
                const img = box.querySelector('img');
                const removeBtn = box.querySelector('.btn-remove-image');
                img.src = imgSrc;
                img.classList.remove('d-none');
                removeBtn.classList.remove('d-none');
            }
        });
        
        const modal = new bootstrap.Modal(document.getElementById('addContentModal'));
        modal.show();
    };

    window.deleteContent = function(index) {
        if (confirm("Yakin ingin menghapus konten ini?")) {
            contents.splice(index, 1);
            renderContents();
        }
    };

    window.showDetail = function(index) {
        const c = contents[index];
        const carouselInner = document.getElementById('detailCarouselInner');
        carouselInner.innerHTML = ''; 
        
        // PERUBAHAN: Mengatur judul modal detail
        document.getElementById('detailTitle').textContent = c.title;

        c.images.forEach((imgSrc, i) => {
            const itemClass = i === 0 ? 'carousel-item active' : 'carousel-item';
            carouselInner.innerHTML += `
                <div class="${itemClass}">
                    <img src="${imgSrc}" class="d-block w-100" alt="Gambar Konten ${i + 1}">
                </div>
            `;
        });
        
        document.getElementById('detailDescription').textContent = c.description;
        const statusBadge = document.getElementById('detailStatus');
        statusBadge.textContent = c.publish;
        statusBadge.className = "badge " + (c.publish === "Published" ? "bg-success" : "bg-secondary");

        const modal = new bootstrap.Modal(document.getElementById('detailModal'));
        modal.show();
    };
});

