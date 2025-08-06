<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edukasi | SIGMA</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('assets/css/edukasi/edukasi.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="mobile-container">
    <!-- Header Section -->
    <div class="header">
      <div class="header-content">
        <div class="page-info">
          <h1>Edukasi</h1>
          <p>Pelajari cara mengelola sampah dengan benar</p>
        </div>
        <div class="header-icon">
          <i class="fas fa-graduation-cap"></i>
        </div>
      </div>
    </div>

    <!-- Content Section -->
    <div class="content-section">
      <!-- Hero Card -->
      <div class="hero-card">
        <div class="hero-content">
          <div class="hero-text">
            <h2>Kamu Bisa Jadi<br>Pahlawan Bumi, Mulai<br>Dari Satu Botol Plastik!</h2>
            <p>Yuk, jadi bagian dari perubahan</p>
          </div>
          <div class="hero-illustration">
            <i class="fas fa-recycle"></i>
          </div>
        </div>
      </div>

      <!-- Content Card -->
      <div class="content-card">
        <h3>Tahukah Anda?</h3>
        <p>Botol plastik sekali pakai adalah salah satu penyumbang terbesar pencemaran lingkungan di Indonesia. Setiap tahunnya, Indonesia menghasilkan sekitar 12,6 juta ton sampah plastik, dan 1–2 juta ton di antaranya berasal dari botol plastik. Sayangnya, sebagian besar limbah ini tidak dikelola dengan baik dan justru mencemari saluran air, sungai, hingga laut.</p>

        <p>Dampak dari pencemaran plastik sangat serius. Tidak hanya merusak keindahan alam dan menyebabkan banjir, tetapi juga mengancam kelangsungan hidup makhluk hidup di sekitarnya. Banyak hewan laut yang menelan plastik karena disangka makanan, dan mikroplastik yang terurai dari limbah ini juga bisa masuk ke dalam rantai makanan kita.</p>

        <p>Melalui inovasi teknologi, kini hadir BINA BUMI—sebuah platform yang menggabungkan teknologi pintar dan aksi nyata. Dengan menghadirkan mesin cerdas SIGMA, masyarakat dapat menyetorkan botol plastik dalam jumlah besar. Mesin ini dilengkapi sensor berat dan volume serta sistem deteksi AI yang akurat dan efisien.</p>

        <p>SIGMA terintegrasi dengan aplikasi digital yang memberikan insentif Rp4.000/kg, serta fitur gamifikasi dan kanal donasi lingkungan. Setiap botol yang Anda setor bukan hanya mengurangi sampah, tapi menjadi langkah kecil menuju perubahan besar.</p>
      </div>

      <!-- Call to Action Card -->
      <div class="cta-card">
        <span class="cta-emoji">🌱</span>
        <p class="cta-text">
          Tukarkan botol plastik Anda, kumpulkan poin, dan jadilah bagian dari generasi penyelamat bumi. Karena dari aksi sederhana, kita bisa menciptakan perubahan luar biasa.
        </p>
        <div class="dots-nav">
          <span class="dot active"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
      </div>
    </div>

    <!-- Bottom Navigation Component -->
    @include('components.bottom-nav', ['active' => 'edukasi'])

  </div>
</body>
</html>
