<!-- Bottom Navigation Component -->
<nav class="bottom-nav">
  <div class="nav-content">
    <!-- Beranda -->
    <div class="nav-item {{ $active === 'beranda' ? 'active' : '' }}">
      <a href="{{ route('beranda') }}" class="nav-link">
        <i class="fas fa-home"></i>
        <span>Beranda</span>
      </a>
    </div>

    <!-- Edukasi -->
    <div class="nav-item {{ $active === 'edukasi' ? 'active' : '' }}">
      <a href="#" class="nav-link">
        <i class="fas fa-book-open"></i>
        <span>Edukasi</span>
      </a>
    </div>

    <!-- QR Code (Center) - dalam flow normal -->
    <div class="qr-nav-item">
      <div class="qr-button" onclick="handleQRClick()">
        <i class="fas fa-qrcode"></i>
      </div>
    </div>

    <!-- Riwayat -->
    <div class="nav-item {{ $active === 'riwayat' ? 'active' : '' }}">
      <a href="#" class="nav-link">
        <i class="fas fa-history"></i>
        <span>Riwayat</span>
      </a>
    </div>

    <!-- Profil -->
    <div class="nav-item {{ $active === 'profil' ? 'active' : '' }}">
      <a href="#" class="nav-link">
        <i class="fas fa-user"></i>
        <span>Profil</span>
      </a>
    </div>
  </div>
</nav>

<!-- Bottom Navigation JavaScript -->
<script src="{{ asset('assets/js/components/bottom-nav.js') }}"></script>
