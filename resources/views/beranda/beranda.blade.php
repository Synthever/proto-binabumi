<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda | SIGMA</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets/css/beranda/beranda.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="mobile-container">
    <!-- Header -->
    <div class="header">
      <div class="header-content">
        <div class="user-info">
          <p class="greeting">Selamat Datang! 👋</p>
          <h2 class="user-name">{{ $userData['name'] }}</h2>
          <div class="location">
            <i class="fas fa-map-marker-alt"></i>
            <span>{{ $userData['location'] }}</span>
          </div>
        </div>
        <div class="user-avatar">
          {{ strtoupper(substr($userData['name'], 0, 1)) }}
        </div>
      </div>
    </div>

    <div class="stats-card">
        <div class="stats-top">
            <div class="stats-item">
                <div class="icon-wrapper">
                    <img src="{{ asset('assets/images/beranda/money.png') }}" alt="Saldo">
                </div>
                <div class="stats-top-values">
                    <div class="label">Saldo</div>
                    <div class="value">0</div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="stats-item">
                <div class="icon-wrapper">
                    <img src="{{ asset('assets/images/beranda/koin.png') }}" alt="Koin">
                </div>
                <div class="stats-top-values">
                    <div class="label">Koin</div>
                    <div class="value">0</div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="stats-item">
                <div class="icon-wrapper">
                    <img src="{{ asset('assets/images/beranda/botol.png') }}" alt="Botol">
                </div>
                <div class="stats-top-values">
                    <div class="label">Botol</div>
                    <div class="value">0</div>
                </div>
            </div>
        </div>

        <div class="stats-bottom">
            <div class="stats-box">
            <div class="box-value">0</div>
            <div class="box-label">Pengumpulan</div>
            </div>
            <div class="vertical-line"></div>
            <div class="stats-box">
            <div class="box-value">0</div>
            <div class="box-label">Berhasil</div>
            </div>
            <div class="vertical-line"></div>
            <div class="stats-box">
            <div class="box-value">0</div>
            <div class="box-label">Pending</div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
      <h3 class="features-title">Jelajahi Fitur</h3>
      <div class="features-grid">
        <!-- Cari Mesin -->
        <div class="feature-card">
          <div class="feature-icon search">
            <i class="fas fa-search-location"></i>
          </div>
          <h4 class="feature-title">Cari Mesin</h4>
          <p class="feature-desc">Temukan mesin terdekat</p>
        </div>

        <!-- Tukar Koin -->
        <div class="feature-card">
          <div class="feature-icon exchange">
            <i class="fas fa-exchange-alt"></i>
          </div>
          <h4 class="feature-title">Tukar Koin</h4>
          <p class="feature-desc">Ubah koinmu menjadi e-money</p>
        </div>

        <!-- Donasi -->
        <div class="feature-card">
          <div class="feature-icon donate">
            <i class="fas fa-heart"></i>
          </div>
          <h4 class="feature-title">Donasi</h4>
          <p class="feature-desc">Lakukan aksi baik hari ini</p>
        </div>

        <!-- Permainan -->
        <div class="feature-card">
          <div class="feature-icon game">
            <i class="fas fa-gamepad"></i>
          </div>
          <h4 class="feature-title">Permainan</h4>
          <p class="feature-desc">Mainkan permainan serunya sekarang</p>
        </div>
      </div>
    </div>

    <!-- Bottom Navigation Component -->
    @include('components.bottom-nav', ['active' => 'beranda'])
  </div>

  <script>
    // Page load animations
    document.addEventListener('DOMContentLoaded', function() {
      // Animate mobile container
      anime({
        targets: '.mobile-container',
        opacity: [0, 1],
        translateY: [20, 0],
        duration: 700,
        easing: 'easeOutQuad'
      });

      // Animate cards with staggered effect
      anime({
        targets: '.stats-card, .feature-card',
        opacity: [0, 1],
        translateY: [30, 0],
        delay: anime.stagger(100),
        duration: 600,
        easing: 'easeOutQuart'
      });

      // Add click animations to feature cards
      document.querySelectorAll('.feature-card').forEach(card => {
        card.addEventListener('click', function() {
          anime({
            targets: this,
            scale: [1, 0.95, 1],
            duration: 200,
            easing: 'easeOutQuart'
          });
        });
      });

      // Add click animation to QR button
      const qrButton = document.querySelector('.qr-button');
      if (qrButton) {
        qrButton.addEventListener('click', function() {
          anime({
            targets: this,
            scale: [1, 1.1, 1],
            duration: 300,
            easing: 'easeOutQuart'
          });
        });
      }
    });
  </script>
</body>
</html>
