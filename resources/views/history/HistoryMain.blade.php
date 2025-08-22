<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Anda - SIGMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/assets/css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/history/historyMain.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/history/historyMain-fix.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <x-header title="Riwayat" :sticky="true" />

    <!-- Search -->
    <div class="search-box">
        <input 
            type="text" 
            placeholder="Cari riwayat transaksi" 
            class="search-input">
    </div>

    <!-- List Riwayat -->
    <div class="history-list">
        <!-- Item -->
        <div class="history-entry">
            <a href="{{ route('history_detail-transaksi', ['id' => 1]) }}" class="history-item">
                <div>
                    <p class="item-date">10/01/2025</p>
                    <p class="item-title">Transfer ke ATM BCA</p>
                    <p class="item-name">PAMELA TRI ANJANI</p>
                </div>
                <div class="item-right">
                    <span class="status status-proses">Proses</span>
                    <p class="item-amount">Rp 20.000</p>
                </div>
            </a>
        </div>

        <div class="history-entry">
            <a href="{{ route('history_detail-transaksi-2', ['id' => 2]) }}" class="history-item">
                <div>
                    <p class="item-date">03/01/2025</p>
                    <p class="item-title">Transfer ke Shopeepay</p>
                    <p class="item-name">SUKMAWATI</p>
                </div>
                <div class="item-right">
                    <span class="status status-ditolak">Di Tolak</span>
                    <p class="item-amount">Rp 5.000</p>
                </div>
            </a>
        </div>

        <div class="history-entry">
            <a href="{{ route('history_detail-transaksi-3', ['id' => 3]) }}" class="history-item">
                <div>
                    <p class="item-date">23/12/2024</p>
                    <p class="item-title">Transfer ke DANA</p>
                    <p class="item-name">ANISA RAHMAWATI</p>
                </div>
                <div class="item-right">
                    <span class="status status-selesai">Selesai</span>
                    <p class="item-amount">Rp 10.000</p>
                </div>
            </a>
        </div>

        <div class="history-entry">
            <a href="{{ route('history_detail-transaksi-4', ['id' => 4]) }}" class="history-item">
                <div>
                    <p class="item-date">15/12/2024</p>
                    <p class="item-title">Transfer ke ATM BCA</p>
                    <p class="item-name">PAMELA TRI ANJANI</p>
                </div>
                <div class="item-right">
                    <span class="status status-selesai">Selesai</span>
                    <p class="item-amount">Rp 8.000</p>
                </div>
            </a>
        </div>

        <div class="history-entry">
            <a href="{{ route('history_detail-transaksi-5', ['id' => 5]) }}" class="history-item">
                <div>
                    <p class="item-date">7/12/2024</p>
                    <p class="item-title">Transfer ke DANA</p>
                    <p class="item-name">PAMELA TRI ANJANI</p>
                </div>
                <div class="item-right">
                    <span class="status status-selesai">Selesai</span>
                    <p class="item-amount">Rp 9.000</p>
                </div>
            </a>
        </div>

        <div class="history-entry">
            <a href="{{ route('history_detail-transaksi-6', ['id' => 6]) }}" class="history-item">
                <div>
                    <p class="item-date">29/11/2024</p>
                    <p class="item-title">Transfer ke DANA</p>
                    <p class="item-name">PAMELA TRI ANJANI</p>
                </div>
                <div class="item-right">
                    <span class="status status-selesai">Selesai</span>
                    <p class="item-amount">Rp 13.000</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Bottom Navigation Component -->
    @include('components.bottom-nav', ['active' => 'riwayat'])

    <!-- Animasi anime.js -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        anime({
            targets: '.history-entry',
            opacity: [0, 1],
            translateY: [30, 0],
            easing: 'easeOutExpo',
            duration: 700,
            delay: anime.stagger(150) // muncul satu-satu
        });
    });
    </script>
</body>
</html>
