  const form = document.getElementById("botForm");
  const list = document.getElementById("listData");

  let itemToDelete = null; // simpan elemen yang mau dihapus

  form.addEventListener("submit", function(e) {
    e.preventDefault();

    const keyword = document.getElementById("keyword").value;
    const response = document.getElementById("response").value;

    // buat elemen <li>
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";
    li.innerHTML = `
      <span><strong>${keyword}</strong> → ${response}</span>
      <button class="btn btn-sm btn-danger">Hapus</button>
    `;

    // event hapus → buka modal
    li.querySelector("button").addEventListener("click", function() {
      itemToDelete = li; // simpan item yang dipilih
      document.getElementById("deleteItemText").textContent = `"${keyword}"`;
      const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
      deleteModal.show();
    });

    // tambahkan ke list
    list.appendChild(li);

    // reset form
    form.reset();
  });

  // tombol konfirmasi hapus
  document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
    if (itemToDelete) {
      itemToDelete.remove();
      itemToDelete = null;
      const deleteModal = bootstrap.Modal.getInstance(document.getElementById("deleteModal"));
      deleteModal.hide();
    }
  });