    document.addEventListener('DOMContentLoaded', function() {
      // --- DATA SOURCE ---
      const messages = [
        { name: 'Andi Setiawan', initials: 'AS', email: 'andi.s@example.com', subject: 'Permintaan Pemasangan Baru', timestamp: 'Baru Saja', body: `<p>Selamat siang Tim GNS, saya ingin mengajukan permintaan pemasangan internet baru untuk lokasi di Perumahan Graha Asri blok C-12. Mohon informasinya mengenai prosedur dan biaya yang diperlukan. Terima kasih.</p>` },
        { name: 'Budi Darmawan', initials: 'BD', email: 'budi.d@example.com', subject: 'Keluhan Jaringan Lambat', timestamp: '15m lalu', body: `<p>Halo, saya pelanggan dengan nomor ID 12345. Sejak kemarin sore, koneksi internet saya terasa sangat lambat dan sering terputus. Mohon untuk segera diperiksa. Terima kasih.</p>` },
        { name: 'Citra Lestari', initials: 'CT', email: 'citra.l@example.com', subject: 'Pertanyaan Mengenai Paket Bisnis', timestamp: '1j lalu', body: `<p>Dear GNS, saya tertarik dengan paket Bisnis yang ditawarkan. Apakah ada brosur atau detail lebih lanjut mengenai kecepatan, FUP, dan layanan purna jualnya? Kantor kami bergerak di bidang desain grafis dan membutuhkan koneksi yang stabil. Terima kasih atas perhatiannya.</p>` },
        { name: 'Dewi Anggraini', initials: 'DA', email: 'dewi.a@example.com', subject: 'Konfirmasi Pembayaran', timestamp: '3j lalu', body: `<p>Saya sudah melakukan pembayaran untuk tagihan bulan ini melalui transfer bank ke rekening BCA atas nama PT GNS. Mohon konfirmasinya apakah pembayaran sudah diterima. Berikut saya lampirkan bukti transfernya. Terima kasih.</p>` },
        { name: 'Eko Prasetyo', initials: 'EP', email: 'eko.p@example.com', subject: 'Upgrade Paket Internet', timestamp: '1h lalu', body: `<p>Apakah saya bisa melakukan upgrade paket dari Individu ke Gamer? Apa saja syaratnya dan apakah ada biaya tambahan? Mohon penjelasannya.</p>` },
        { name: 'Fitriani', initials: 'F', email: 'fitri@example.com', subject: 'Gangguan Koneksi Total', timestamp: 'Kemarin', body: `<p>Mohon bantuannya, internet di rumah saya mati total sejak pagi ini. Lampu indikator LOS pada modem berkedip merah. Lokasi di Jalan Mawar nomor 5. Mohon segera ditindaklanjuti. Terima kasih banyak.</p>` },
        { name: 'Gilang Ramadhan', initials: 'GR', email: 'gilang.r@example.com', subject: 'Info Jangkauan Area', timestamp: 'Kemarin', body: `<p>Selamat siang, saya ingin bertanya. Apakah daerah Candi, Sidoarjo, khususnya di sekitar Desa Kalipecabean, sudah tercover oleh jaringan GNS? Saya berencana untuk pindah ke sana dan ingin melanjutkan langganan.</p>` },
        { name: 'Hesti Wulandari', initials: 'HW', email: 'hesti.w@example.com', subject: 'Re: Penawaran Kerjasama', timestamp: '2 hari lalu', body: `<p>Terima kasih atas penawaran kerjasama yang telah dikirimkan. Kami dari tim marketing akan mempelajarinya terlebih dahulu dan akan segera menghubungi Anda kembali jika tertarik. Terima kasih.</p>` }
      ];

      // --- DOM ELEMENT REFERENCES ---
      const messageListEl = document.getElementById('messageList');
      const detailViewEl = document.getElementById('messageDetailView');
      // const emptyViewEl = document.getElementById('emptyView'); // Dihapus
      const detailAvatarEl = document.getElementById('detailAvatar');
      const detailNameEl = document.getElementById('detailName');
      const detailEmailEl = document.getElementById('detailEmail');
      const detailSubjectEl = document.getElementById('detailSubject');
      const detailBodyEl = document.getElementById('detailBody');
      const replyButtonEl = document.getElementById('replyButton');

      /**
       * Menampilkan detail pesan yang dipilih
       */
      window.displayMessageDetail = (index) => {
        const msg = messages[index];
        if (!msg) return;

        // Isi detail pesan
        detailAvatarEl.textContent = msg.initials;
        detailNameEl.textContent = msg.name;
        detailEmailEl.textContent = msg.email;
        detailSubjectEl.textContent = `Subjek: ${msg.subject}`;
        detailBodyEl.innerHTML = msg.body;
        replyButtonEl.href = `mailto:${msg.email}?subject=Re: ${encodeURIComponent(msg.subject)}`;
        
        // Atur item mana yang aktif di daftar
        document.querySelectorAll('.message-list-item').forEach((item, i) => {
          item.classList.toggle('active', i === index);
        });

        // Tampilkan panel detail
        detailViewEl.style.display = 'flex';
        // emptyViewEl.style.display = 'none'; // Dihapus
      };

      /**
       * Mengisi daftar pesan di panel kiri
       */
      function populateMessageList() {
        messageListEl.innerHTML = ''; 
        messages.forEach((msg, index) => {
          const listItem = document.createElement('li');
          listItem.className = 'message-list-item';
          listItem.addEventListener('click', () => displayMessageDetail(index));

          listItem.innerHTML = `
              <a href="javascript:void(0)" class="d-flex align-items-center text-decoration-none p-3">
                  <div class="user-avatar rounded-circle flex-shrink-0">${msg.initials}</div>
                  <div class="ms-3 flex-grow-1">
                      <h6 class="mb-1 fs-4 fw-semibold">${msg.name}</h6>
                      <p class="mb-0 fs-2 text-dark message-subject">${msg.subject}</p>
                  </div>
                  <span class="fs-2 text-muted flex-shrink-0 ms-auto">${msg.timestamp}</span>
              </a>
          `;
          messageListEl.appendChild(listItem);
        });
      }

      // --- INISIALISASI SAAT HALAMAN DIBUKA ---
      if (messages.length > 0) {
        populateMessageList();
        // Secara default, tampilkan pesan pertama
        displayMessageDetail(0); 
      } else {
        // Jika tidak ada pesan, sembunyikan panel detail
        detailViewEl.style.display = 'none';
        // emptyViewEl.style.display = 'flex'; // Dihapus
      }
    });