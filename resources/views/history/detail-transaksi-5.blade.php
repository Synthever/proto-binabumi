<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/assets/css/history/detail-transaksi-5.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Header (tidak ikut animasi) -->
        <div class="header">
            <a href="{{ route('history.index') }}" class="back-button" id="backBtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
            <h1>Detail Transaksi</h1>
        </div>

        <!-- Semua isi halaman dalam wrapper animasi -->
        <div class="page-wrapper">
            <!-- Status Section -->
            <div class="status-section">
                <div class="status-icon">
                    <i class="fas fa-check fa-2x" style="color: #193D29;"></i>
                </div>
                <h2 class="status-title">Penarikan Berhasil</h2>
                <p class="status-description">Penarikan koin kamu telah diproses dan berhasil dikirim ke e-money tujuan.</p>
                <div class="amount">Rp 8.000</div>
            </div>

            <!-- Transaction Information -->
            <div class="transaction-card">
                <div class="transaction-detail">
                    <h3>Tujuan Penarikan :</h3>
                    <div class="bank-info">
                        <div class="bank-icon">P</div>
                        <div class="bank-details">
                            <div class="bank-name">DANA - 0857****1234</div>
                            <div class="account-name">Pamela Tri Anjani</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="transaction-card">
                <div class="transaction-detail">
                    <h3>Tanggal Penarikan :</h3>
                    <p>7 Desember 2024</p>
                </div>
                <div class="transaction-detail">
                    <h3>Jumlah Koin :</h3>
                    <p>900 Koin</p>
                </div>
                <div class="transaction-detail">
                    <h3>Waktu Transaksi :</h3>
                    <p>12:15 WIB</p>
                </div>
            </div>

            <!-- Download Button -->
            <button class="download-button" id="downloadButton">Unduh Bukti Transfer</button>
            <div id="warningMessage" class="warning-message fade-in">
                Bukti transfer bisa diunduh setelah transaksi berhasil.
            </div>

            <!-- Popup Modal -->
            <div class="popup" id="downloadModal">
                <div class="popup-content">
                    <div class="popup-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="popup-text">
                        <h3>Unduh Berhasil!</h3>
                        <p>Bukti transfer telah disimpan</p>
                        <span>Kamu bisa cek file di folder unduhan perangkatmu</span>
                    </div>
                    <button class="popup-button" id="closeModal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const downloadButton = document.getElementById('downloadButton');
            const modal = document.getElementById('downloadModal');
            const closeModal = document.getElementById('closeModal');

            downloadButton.addEventListener('click', function() {
                setTimeout(() => {
                    modal.classList.add('show');
                }, 300);
            });

            closeModal.addEventListener('click', function() {
                modal.classList.remove('show');
            });

            // Optional: Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
