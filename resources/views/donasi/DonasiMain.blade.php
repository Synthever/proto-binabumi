<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi - SIGMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/donasi/donasiMain.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <button class="back-btn" onclick="location.href='/beranda'">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <h1>Donasi</h1>
        </div>

        <section class="card">
            <img src="{{ asset('assets/images/donasi/image64.png') }}" alt="Ilustrasi Donasi">
            <h2>Langkah Kecil untuk Perubahan Besar</h2>
            <p class="progress-text">Rp. 25.000.000 <span>dari Rp. 100.000.000 terkumpul</span></p>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
            <p class="progress-percent">25%</p>
        </section>

        <section class="content">
            <h3>Deskripsi</h3>
            <p class="highlight"><i class="fas fa-globe-asia"></i> <strong>Kurangi Sampah Plastik, Mulai dari Sekarang!</strong></p>
            <p>Hai Sahabat Bumi,</p>
            <p>
                Tahukah kamu? Indonesia termasuk salah satu penyumbang sampah plastik terbesar di dunia. Bina Bumi hadir dengan solusi inovatif: mengubah botol plastik menjadi saldo e-wallet.
            </p>

            <p class="highlight"><i class="fas fa-recycle"></i> <strong>Cara Kerja Kami:</strong></p>
            <ol>
                <li>Masukkan botol plastik ke mesin Bina Bumi.</li>
                <li>Botol akan diproses dan dikonversi menjadi saldo digital.</li>
                <li>Saldo bisa langsung ditarik ke e-wallet atau m-banking kamu!</li>
            </ol>

            <p>Tapi kami tak bisa berjalan sendiri. Dengan donasimu, kamu ikut:</p>
            <ul>
                <li>✨ Menyebarkan lebih banyak mesin daur ulang ke berbagai daerah terpencil.</li>
                <li>✨ Mengedukasi masyarakat luas soal pentingnya daur ulang plastik.</li>
                <li>✨ Mewujudkan Indonesia yang bersih, hijau, dan bebas sampah plastik.</li>
            </ul>

            <p class="closing">
                <strong>Sekecil apapun donasimu, berdampak besar untuk bumi. Yuk, jadi bagian dari perubahan. 🌱🤍</strong>
            </p>

            <div class="cta-button">
                <a href="{{ route('donasi.biodata') }}" class="cta-link">Donasi Sekarang</a>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Staggered animation for card and content (header tetap statis)
            anime({
                targets: '.card, .content',
                opacity: [0, 1],
                translateY: [30, 0],
                delay: anime.stagger(150),
                duration: 600,
                easing: 'easeOutQuart'
            });

            // Progress bar animation
            anime({
                targets: '.progress-fill',
                width: ['0%', '25%'],
                delay: 500,
                duration: 1000,
                easing: 'easeOutCubic'
            });

            // Click animation for CTA button
            document.querySelector('.cta-link').addEventListener('click', function() {
                anime({
                    targets: this,
                    scale: [1, 0.95, 1],
                    duration: 200,
                    easing: 'easeOutQuart'
                });
            });
        });
    </script>
</body>
</html>
