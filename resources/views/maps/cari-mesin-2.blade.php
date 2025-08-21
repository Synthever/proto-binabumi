<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Mesin - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/maps/cari-mesin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="cari-mesin-container">
        <!-- Header Section -->
        <div class="header-wrapper">
            <button onclick="window.location.href='/beranda'" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h1 class="header-title">Cari Mesin</h1>
        </div>

        <!-- Location Badge -->
        <button onclick="searchAgain()">
        <div class="location-btn fade-in">
            <i class="fas fa-map-marker-alt location-icon"></i>
            <span>Lokasi Kamu</span>
        </div>
        </button>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Empty State -->
            <div class="empty-state fade-in">
                <!-- Illustration -->
                <div class="empty-illustration">
                   <img src="{{ asset('/assets/images/maps/rvm_notfound.png') }}" alt="AMIKOM Yogyakarta" />
                </div>
                
                <!-- Text Content -->
                <div class="empty-content">
                    <h2 class="empty-title">Mesin RVM belum tersedia di dekatmu</h2>
                    <p class="empty-description">
                        Coba cari di area lain atau aktifkan lokasi 
                        secara manual.
                    </p>
                </div>
                
                <!-- Search Again Button -->
                <button class="search-again-btn" onclick="searchAgain()">
                    <i class="fas fa-search"></i>
                    <span>Cari Lagi</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Maps JavaScript Functions -->
    <script src="{{ asset('assets/js/maps/cari-mesin.js') }}"></script>
</body>
</html>
