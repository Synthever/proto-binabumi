<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/assets/css/history/detail-transaksi-2.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { 
            overflow-x: hidden; 
        }
        .content-wrapper {
            opacity: 0;
            transform: translateY(20px);
            min-height: calc(100vh - 70px);
            padding-bottom: 100px;
        }
        .status-section,
        .transaction-card {
            opacity: 0;
            transform: translateY(20px);
        }
    </style>
</head>
<body>
    <!-- Header tidak ikut animasi -->
    <div class="header">
            <button class="back-btn" onclick="location.href='/history'">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
            </button>
            <h1>Detail Transaksi</h1>
        </div>

        <!-- Konten dengan animasi -->
        <div class="content-wrapper">
            <!-- Status Section -->
            <div class="status-section">
            <div class="status-icon">
                <i class="fas fa-clock fa-2x" style="color: #920807;"></i>
            </div>

            <h2 class="status-title">Penarikan Ditolak</h2>
            <p class="status-description">Penarikan koin kamu tidak dapat diproses saat ini. Coba lagi beberapa saat lagi.</p>
            <div class="amount">Rp 5.000</div>
        </div>

        <!-- Transaction Information -->
        <div class="transaction-card">
            <div class="transaction-detail">
                <h3>Tujuan Penarikan :</h3>
                <div class="bank-info">
                    <div class="bank-icon">S</div>
                    <div class="bank-details">
                        <div class="bank-name">Shopeepay - 0857****1234</div>
                        <div class="account-name">Sukmawati</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Transaction Details -->
        <div class="transaction-card">
            <div class="transaction-detail">
                <h3>Tanggal Penarikan :</h3>
                <p>3 Januari 2025</p>
            </div>

            <div class="transaction-detail">
                <h3>Jumlah Koin :</h3>
                <p>500 Koin</p>
            </div>

            <div class="transaction-detail">
                <h3>Waktu Transaksi :</h3>
                <p>17:00 WIB</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi konten masuk menggunakan timeline
            anime.timeline({
                easing: 'easeOutExpo'
            })
            .add({
                targets: '.content-wrapper',
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 600
            })
            .add({
                targets: '.status-section, .transaction-card',
                opacity: [0, 1],
                translateY: [30, 0],
                duration: 800,
                delay: anime.stagger(150),
                easing: 'easeOutQuart'
            }, '-=200');

            // Menggunakan CSS transitions untuk hover effects
            const cards = document.querySelectorAll('.transaction-card');
            cards.forEach(card => {
                card.style.transition = 'transform 0.2s ease, box-shadow 0.2s ease';
                
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-2px)';
                    card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.08)';
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = '0 1px 4px rgba(0, 0, 0, 0.05)';
                });
            });
        });
    </script>
</body>
</html>