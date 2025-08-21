<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/assets/css/history/detail-transaksi.css') }}">
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
            min-height: calc(100vh - 70px); /* tinggi viewport dikurangi header */
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
        <x-back-button href="/history" />
        <h1>Detail Transaksi</h1>
    </div>

    <!-- Konten dengan animasi -->
    <div class="content-wrapper">
            <!-- Status Section -->
            <div class="status-section">
                <div class="status-icon">
                    <i class="fas fa-clock fa-2x" style="color: #92400e;"></i>
                </div>
                <h2 class="status-title">Sedang Diproses</h2>
                <p class="status-description">
                    Penarikan koin kamu sedang diproses dan menunggu konfirmasi dari sistem.
                </p>
                <div class="amount">Rp 20.000</div>
            </div>

            <!-- Transaction Information -->
            <div class="transaction-card">
                <div class="transaction-detail">
                    <h3>Tujuan Penarikan :</h3>
                    <div class="bank-info">
                        <div class="bank-icon">P</div>
                        <div class="bank-details">
                            <div class="bank-name">Bank BCA - 365 - 111 - 5657</div>
                            <div class="account-name">Pamela Tri Anjani</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="transaction-card">
                <div class="transaction-detail">
                    <h3>Tanggal Penarikan :</h3>
                    <p>10 Januari 2025</p>
                </div>
                <div class="transaction-detail">
                    <h3>Jumlah Koin :</h3>
                    <p>2000 Koin</p>
                </div>
                <div class="transaction-detail">
                    <h3>Waktu Transaksi :</h3>
                    <p>15:30 WIB</p>
                </div>
            </div>

            <!-- Download Button -->
            <button class="download-button" id="downloadButton">Unduh Bukti Transfer</button>
            <div id="warningMessage" class="warning-message fade-in">
                Bukti transfer bisa diunduh setelah transaksi berhasil.
            </div>
        </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Animasi konten masuk
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
            delay: anime.stagger(150, {start: 650}),
            duration: 600,
            easing: 'easeOutQuart'
        });

        // Animasi hover tetap seperti sebelumnya
        const cards = document.querySelectorAll('.transaction-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-2px)';
                card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.08)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '0 1px 4px rgba(0, 0, 0, 0.05)';
            });
        });

        // Animasi untuk warning message jika ada
        if (document.getElementById('downloadButton')) {
            document.getElementById('downloadButton').addEventListener('click', function() {
                const warning = document.getElementById('warningMessage');
                if (warning) {
                    warning.style.display = 'block';
                    anime({
                        targets: '#warningMessage',
                        opacity: [0, 1],
                        translateY: [10, 0],
                        duration: 500,
                        easing: 'easeOutQuad'
                    });
                }
            }); 
        }
      });
    </script>
</body>
</html>
