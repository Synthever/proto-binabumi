<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tukar Koin | SIGMA</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets/css/tukar-koin/tukar-koin.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Container ala detail profil -->
  <div style="max-width:1024px; margin:0 auto; width:100%; box-shadow: 0 0 20px rgba(0,0,0,0.10); background: #fff; padding: 20px;">
    <!-- Header tidak ikut animasi -->
        <div class="header">
            <x-back-button href="/beranda" />
            <h1>Tukar Koin</h1>
        </div>

    <!-- Content Area -->
    <div class="content-area">
      <!-- ATM Card Balance -->
      <div class="atm-card">
        <div class="card-background">
          <img src="{{ asset('assets/images/tukar-koin/card-atm.png') }}" alt="Card ATM" class="card-image">
          <div class="card-overlay">
            <div class="card-header">
              <p class="card-bank">Nama</p>
              <p class="card-owner">PAMELA TRI ANJANI</p>
            </div>
            <div class="card-balance">
              <p class="balance-label">Saldo Anda</p>
              <p class="balance-amount">Rp 10.000,00</p>
            </div>
          </div>
        </div>
      </div>

      <!-- User Info Section -->
      <div class="user-info">
        <div class="user-avatar-section">
          <div class="pr-iqon">
            <i class="fas fa-user fa-2x"></i>
          </div>
          <div class="user-details">
            <p class="user-name">PAMELA TRI ANJANI</p>
            <div class="detail-atm">
              <div class="akun-bank">
                <p>BCA</p>
              </div>
              <p class="user-id">768-453-6564</p>
            </div>
          </div>
        </div>
        <div class="qr-icon">
          <i class="fas fa-pen"></i>
        </div>
      </div>

      <!-- Exchange Options Grid -->
      <div class="exchange-options">
        <div class="options-grid">
          <div class="option-card">
            <span class="option-amount">Rp 10.000</span>
          </div>
          <div class="option-card">
            <span class="option-amount">Rp 20.000</span>
          </div>
          <div class="option-card">
            <span class="option-amount">Rp 30.000</span>
          </div>
          <div class="option-card">
            <span class="option-amount">Rp 50.000</span>
          </div>
        </div>
      </div>

      <!-- Custom Amount Input -->
      <div class="custom-input">
        <input type="text" placeholder="Koin lainnya" class="amount-input">
      </div>

      <!-- Process Button -->
      <div class="process-section">
        <button class="process-btn">Proses</button>
      </div>
    </div>
  </div>

  <script>
    // Simple interaction for option cards
    document.querySelectorAll('.option-card').forEach(card => {
      card.addEventListener('click', function() {
        // Remove active class from all cards
        document.querySelectorAll('.option-card').forEach(c => c.classList.remove('active'));
        // Add active class to clicked card
        this.classList.add('active');
        
        // Update custom input with selected amount
        const amount = this.querySelector('.option-amount').textContent;
        document.querySelector('.amount-input').value = amount;
      });
    });

    // Process button functionality
    document.querySelector('.process-btn').addEventListener('click', function() {
      const selectedAmount = document.querySelector('.amount-input').value || 
                           document.querySelector('.option-card.active .option-amount')?.textContent || '';
      
      if (selectedAmount) {
        alert(`Memproses tukar koin untuk ${selectedAmount}`);
        // Here you would typically submit to the server
        // window.location.href = '{{ route("tukar-koin.exchange") }}?amount=' + selectedAmount;
      } else {
        alert('Silakan pilih jumlah atau masukkan koin terlebih dahulu');
      }
    });

    // Animation on page load
    anime({
      targets: '.option-card',
      translateY: [30, 0],
      opacity: [0, 1],
      delay: anime.stagger(100),
      duration: 600,
      easing: 'easeOutQuart'
    });
  </script>
</body>
</html>