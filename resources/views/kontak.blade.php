<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Form Kontak</title>
  <style>
    :root{--bg:#f4f6f8;--card:#ffffff;--accent:#2563eb;--muted:#6b7280}
    *{box-sizing:border-box}
    body{font-family:Inter,system-ui,Segoe UI,Roboto,"Helvetica Neue",Arial;line-height:1.4;margin:0;background:var(--bg);color:#111}
    .container{max-width:760px;margin:48px auto;padding:20px}
    .card{background:var(--card);border-radius:12px;box-shadow:0 6px 20px rgba(17,24,39,0.06);padding:28px}
    h1{margin:0 0 6px;font-size:20px}
    p.lead{margin:0 0 18px;color:var(--muted)}
    form{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    label{display:block;font-size:13px;margin-bottom:6px}
    input[type="text"],input[type="email"],input[type="tel"],textarea,select{width:100%;padding:10px;border:1px solid #e6e9ee;border-radius:8px;font-size:14px}
    textarea{min-height:120px;resize:vertical}
    .full{grid-column:1/-1}
    .actions{display:flex;gap:10px;align-items:center}
    button{background:var(--accent);color:white;padding:10px 14px;border-radius:8px;border:0;font-weight:600;cursor:pointer}
    button[disabled]{opacity:.6;cursor:not-allowed}
    .secondary{background:transparent;color:var(--accent);border:1px solid #dbeafe}
    .note{font-size:13px;color:var(--muted);margin-top:8px}
    .success{background:#ecfdf5;border:1px solid #bbf7d0;color:#065f46;padding:12px;border-radius:8px;margin-bottom:12px}
    .error{background:#fff1f2;border:1px solid #fecaca;color:#9f1239;padding:12px;border-radius:8px;margin-bottom:12px}
    @media (max-width:640px){form{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <div class="container">
    <div class="card" role="region" aria-labelledby="contact-title">
      <h1 id="contact-title">Form Kontak</h1>
      <p class="lead">Isi form di bawah jika ingin menghubungi kami. Semua field yang bertanda * wajib diisi.</p>

      <div id="form-messages" aria-live="polite"></div>

      <form id="contactForm" novalidate>
        <div class="full">
          <label for="name">Nama Lengkap *</label>
          <input id="name" name="name" type="text" autocomplete="name" required placeholder="Contoh: Budi Santoso">
        </div>

        <div>
          <label for="email">Email *</label>
          <input id="email" name="email" type="email" autocomplete="email" required placeholder="nama@contoh.com">
        </div>

        <div>
          <label for="phone">No. Telepon</label>
          <input id="phone" name="phone" type="tel" inputmode="tel" pattern="^[0-9+\-()\s]{6,20}$" placeholder="0812xxxx" aria-describedby="phoneHelp">
          <div id="phoneHelp" class="note">Boleh dikosongkan — gunakan angka dan tanda + jika perlu.</div>
        </div>

        <div class="full">
          <label for="subject">Subjek *</label>
          <input id="subject" name="subject" type="text" required placeholder="Contoh: Pertanyaan mengenai produk">
        </div>

        <div class="full">
          <label for="message">Pesan *</label>
          <textarea id="message" name="message" required placeholder="Tulis pesan Anda di sini..."></textarea>
        </div>

        <div class="full">
          <label for="reason">Kategori</label>
          <select id="reason" name="reason">
            <option value="general">Umum</option>
            <option value="support">Dukungan Teknis</option>
            <option value="sales">Penjualan</option>
            <option value="feedback">Masukan</option>
          </select>
        </div>

        <div class="full">
          <label>
            <input type="checkbox" id="consent" name="consent" required> Saya menyetujui penyimpanan data untuk keperluan balasan. *
          </label>
        </div>

        <div class="full actions">
          <button type="submit" id="submitBtn">Kirim Pesan</button>
          <button type="button" id="resetBtn" class="secondary">Reset</button>
          <div class="note">Kami akan menanggapi dalam 1-3 hari kerja (simulasi).</div>
        </div>
      </form>
    </div>
  </div>

  <script>
    const form = document.getElementById('contactForm');
    const messages = document.getElementById('form-messages');
    const submitBtn = document.getElementById('submitBtn');
    const resetBtn = document.getElementById('resetBtn');

    function showMessage(type, text){
      messages.innerHTML = `<div class="${type=== 'ok' ? 'success' : 'error'}" role="status">${text}</div>`;
      // remove after 6s
      setTimeout(()=>{ if(messages.firstChild) messages.removeChild(messages.firstChild); },6000);
    }

    // HTML5 validation helper
    function validateForm(){
      if(!form.checkValidity()){
        form.reportValidity();
        return false;
      }
      return true;
    }

    form.addEventListener('submit', function(e){
      e.preventDefault();
      if(!validateForm()) return;

      // Disable submit while "sending"
      submitBtn.disabled = true;
      submitBtn.textContent = 'Mengirim...';

      // Simulasi pengiriman. Jika Anda punya endpoint backend, ganti bagian ini dengan fetch()/XMLHttpRequest.
      setTimeout(()=>{
        // optionally, collect data
        // const data = new FormData(form);
        showMessage('ok', 'Pesan berhasil dikirim. Terima kasih!');
        form.reset();
        submitBtn.disabled = false;
        submitBtn.textContent = 'Kirim Pesan';
      },1200);
    });

    resetBtn.addEventListener('click', ()=>{
      form.reset();
      messages.innerHTML = '';
    });
  </script>
  <a href="/">Kembali ke Halaman Utama</a>
</body>
</html>
