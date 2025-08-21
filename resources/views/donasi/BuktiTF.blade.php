<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bukti Transfer - SIGMA</title>
  @vite(['resources/css/app.css'])
  <link rel="stylesheet" href="{{ asset('assets/css/donasi/buktiTF.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
  <div class="page-wrapper">
    {{-- Header --}}
    <div class="header">
      <button class="back-btn" onclick="location.href='/donasi'">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
      </button>
      <h1>Bukti Transfer</h1>
    </div>

    {{-- Box PT BINA BUMI --}}
    <div class="bank-box">
      <div class="bank-info">
        <div class="bank-icon">
          <i class="fas fa-user"></i>
        </div>
        <div>
          <p class="bank-name">PT BINA BUMI</p>
          <p class="bank-detail">BCA &nbsp;&nbsp;234-555-1223</p>
        </div>
      </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('donasi.upload-bukti') }}" method="post" enctype="multipart/form-data" class="form" id="donasiForm">
      @csrf
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ $nama_lengkap }}" readonly>
      </div>

      <div class="form-group">
        <label>Username / Email</label>
        <input type="text" name="username" value="{{ $username }}" readonly>
      </div>

      <div class="form-group">
        <label>Nominal</label>
        <input type="text" name="nominal" value="{{ $nominal }}" readonly>
      </div>

      <div class="form-group">
        <label>Input bukti transfer</label>
        <input type="file" name="bukti_tf" required />
      </div>

      <p class="note">⚠️ Pastikan Anda melakukan transfer hanya ke rekening resmi Bina Bumi.</p>

      <button type="submit" class="submit-btn">Kirim</button>
    </form>
  </div>

  <!-- Modal Pop-up -->
  <div id="successModal" class="modal">
    <div class="modal-content">
      <img src="{{ asset('assets/images/donasi/Group 21836.png') }}" alt="Success Icon">
      <h2>Terima Kasih<br>Pahlawan Bumi!</h2>
      <p>Donasimu sudah berhasil dan sangat berarti bagi masa depan yang lebih hijau.</p>
      <button class="close-btn" onclick="window.location.href='{{ route('donasi.index') }}'">Kembali</button>
    </div>
  </div>

  <script>
    const form = document.getElementById('donasiForm');
    const modal = document.getElementById('successModal');
    const modalContent = document.querySelector('.modal-content');

    document.addEventListener('DOMContentLoaded', () => {
            anime({
                targets: '.bank-box, .form',
                opacity: [0, 1],
                translateY: [30, 0],
                delay: anime.stagger(150),
                duration: 600,
                easing: 'easeOutQuart'
            });
        });

    form.addEventListener('submit', function(event) {
      event.preventDefault(); // mencegah reload halaman
      modal.style.display = 'flex';
      anime({
        targets: modalContent,
        scale: [0.9, 1],
        opacity: [0, 1],
        easing: 'easeOutElastic(1, .6)',
        duration: 800
      });
    });

    function closeModal() {
      anime({
        targets: modalContent,
        scale: [1, 0.9],
        opacity: [1, 0],
        easing: 'easeInBack',
        duration: 400,
        complete: () => {
          modal.style.display = 'none';
        }
      });
    }
  </script>
</body>
</html>
