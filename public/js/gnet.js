        const contentForm = document.getElementById('contentForm');
        const contentList = document.getElementById('contentList');
        const imageUpload = document.getElementById('imageUpload');
        const previewImage = document.getElementById('previewImage');
        const editIndexInput = document.getElementById('editIndex');

        let imageFile = null;
        let contents = [];

        // Preview gambar sebelum upload
        imageUpload.addEventListener('change', function (event) {
          imageFile = event.target.files[0];
          if (imageFile) {
            previewImage.src = URL.createObjectURL(imageFile);
            previewImage.classList.remove('d-none');
          } else {
            previewImage.classList.add('d-none');
          }
        });

        // Render konten ke layar
        function renderContents() {
          contentList.innerHTML = "";
          contents.forEach((c, index) => {
            let shortDesc = c.description.length > 80 ? c.description.substring(0, 80) + "..." : c.description;

            let card = `
              <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                  <img src="${c.image}" class="card-img-top" alt="Konten">
                  <div class="card-body d-flex flex-column">
                    <p class="card-text">${shortDesc}</p>
                    <span class="badge ${c.publish === "Published" ? "bg-success" : "bg-secondary"}">${c.publish}</span>
                    <div class="mt-3 d-flex justify-content-between">
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

        // Tambah / Edit konten
        contentForm.addEventListener('submit', function (e) {
          e.preventDefault();

          let description = document.getElementById('contentDescription').value;
          let publish = document.getElementById('publishCheck').checked ? "Published" : "Draft";
          let editIndex = editIndexInput.value;

          function saveContent(imgData) {
            if (editIndex === "") {
              contents.push({ image: imgData, description, publish });
            } else {
              contents[editIndex] = { 
                image: imgData || contents[editIndex].image, 
                description, 
                publish 
              };
            }

            renderContents();
            contentForm.reset();
            previewImage.classList.add('d-none');
            imageFile = null;
            editIndexInput.value = "";

            document.getElementById("addContentModalLabel").textContent = "Tambah Konten Baru";
            var modal = bootstrap.Modal.getInstance(document.getElementById('addContentModal'));
            modal.hide();
          }

          if (imageFile) {
            let reader = new FileReader();
            reader.onload = function (e) {
              saveContent(e.target.result);
            };
            reader.readAsDataURL(imageFile);
          } else {
            saveContent(null);
          }
        });

        // Fungsi edit
        window.editContent = function (index) {
          let c = contents[index];
          document.getElementById('contentDescription').value = c.description;
          document.getElementById('publishCheck').checked = c.publish === "Published";
          editIndexInput.value = index;
          document.getElementById("addContentModalLabel").textContent = "Edit Konten";

          previewImage.src = c.image;
          previewImage.classList.remove('d-none');

          var modal = new bootstrap.Modal(document.getElementById('addContentModal'));
          modal.show();
        };

        // Fungsi delete
        window.deleteContent = function (index) {
          if (confirm("Yakin ingin menghapus konten ini?")) {
            contents.splice(index, 1);
            renderContents();
          }
        };

        // Fungsi detail
        window.showDetail = function (index) {
          let c = contents[index];
          document.getElementById('detailImage').src = c.image;
          document.getElementById('detailDescription').textContent = c.description;
          document.getElementById('detailStatus').textContent = c.publish;
          document.getElementById('detailStatus').className = "badge " + (c.publish === "Published" ? "bg-success" : "bg-secondary");

          var modal = new bootstrap.Modal(document.getElementById('detailModal'));
          modal.show();
        };

// script paket
// ===========================================================================
// SCRIPT UNTUK MANAJEMEN PAKET INTERNET (CRUD)
// ===========================================================================

document.addEventListener('DOMContentLoaded', () => {
    // Mendapatkan elemen-elemen dari DOM
    const packageForm = document.getElementById('packageForm');
    const packageList = document.getElementById('packageList');
    const packageNameInput = document.getElementById('packageName');
    const packageTaglineInput = document.getElementById('packageTagline');
    const packagePriceInput = document.getElementById('packagePrice');
    const packageBenefitsInput = document.getElementById('packageBenefits');
    const editIndexInput = document.getElementById('editIndex');

    // Data dummy untuk demo
    const dummyPackages = [
        {
            name: "Home Internet",
            tagline: "Untuk Kebutuhan Harian",
            price: "150K",
            benefits: ["Streaming & Browsing", "Kuota Tanpa Batas", "Sosial Media Lancar"]
        },
        {
            name: "Gaming Internet",
            tagline: "Andalan Para Gamer",
            price: "250K",
            benefits: ["Koneksi Simetris", "Ping Rendah", "Jaminan Stabilitas"]
        },
        {
            name: "Business Internet",
            tagline: "Andalan Para Profesional",
            price: "300K",
            benefits: ["Dedicated Line", "Uptime Stabil", "Bandwidth Lebih Besar"]
        }
    ];

    // Cek apakah ada data di localStorage. Jika tidak ada, gunakan data dummy.
    let packages = JSON.parse(localStorage.getItem('internetPackages'));
    if (!packages || packages.length === 0) {
        packages = dummyPackages;
        localStorage.setItem('internetPackages', JSON.stringify(packages));
    }

    // Fungsi untuk merender daftar paket ke layar
    function renderPackages() {
        packageList.innerHTML = '';
        packages.forEach((p, index) => {
            // Memastikan hanya 3 benefit yang ditampilkan
            const displayBenefits = p.benefits.slice(0, 3);
            const benefitsHtml = displayBenefits.map(b => `<li class="d-flex align-items-center mb-2"><iconify-icon icon="solar:check-circle-bold-duotone" class="text-primary me-2"></iconify-icon>${b}</li>`).join('');

            const cardHtml = `
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div>
                                <div class="text-center mb-3">
                                    <h5 class="fw-bold mb-0">${p.name}</h5>
                                    <small class="text-muted">${p.tagline}</small>
                                </div>
                                <div class="price-container text-center mb-4">
                                    <h1 class="display-5 text-primary fw-bold mb-0">
                                        <small class="align-top fs-6 me-1">Mulai</small>
                                        <div class="d-flex flex-column align-items-center price-circle">
                                            <span class="display-3 fw-bold">${p.price}</span>
                                            <span class="fs-6 text-muted">/bulan</span>
                                        </div>
                                    </h1>
                                </div>
                                <ul class="list-unstyled">
                                    ${benefitsHtml}
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-warning btn-sm" onclick="editPackage(${index})">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deletePackage(${index})">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            packageList.innerHTML += cardHtml;
        });
    }

    // Event listener saat formulir disubmit
    packageForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = packageNameInput.value;
        const tagline = packageTaglineInput.value;
        const price = packagePriceInput.value;
        const benefits = packageBenefitsInput.value.split(',').map(f => f.trim()).slice(0, 3);
        const editIndex = editIndexInput.value;

        const newPackage = { name, tagline, price, benefits };

        if (editIndex === "") {
            packages.push(newPackage);
        } else {
            packages[editIndex] = newPackage;
        }

        localStorage.setItem('internetPackages', JSON.stringify(packages));
        renderPackages();
        packageForm.reset();
        editIndexInput.value = "";
        
        const packageModal = bootstrap.Modal.getInstance(document.getElementById('packageModal'));
        packageModal.hide();
    });

    // Fungsi untuk mengedit paket
    window.editPackage = (index) => {
        const p = packages[index];
        packageNameInput.value = p.name;
        packageTaglineInput.value = p.tagline;
        packagePriceInput.value = p.price;
        packageBenefitsInput.value = p.benefits.join(', ');
        editIndexInput.value = index;

        const packageModal = new bootstrap.Modal(document.getElementById('packageModal'));
        packageModal.show();
    };

    // Fungsi untuk menghapus paket
    window.deletePackage = (index) => {
        if (confirm("Yakin ingin menghapus paket ini?")) {
            packages.splice(index, 1);
            localStorage.setItem('internetPackages', JSON.stringify(packages));
            renderPackages();
        }
    };

        // Panggil render saat halaman dimuat
        renderPackages();
    });