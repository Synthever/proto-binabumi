<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Mesin - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/maps/cari-mesin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="cari-mesin-container">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-content">
                <button class="back-btn" onclick="location.href='/beranda'">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <h1 class="header-title">Cari Mesin</h1>
            </div>
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
            <!-- AMIKOM Yogyakarta -->
            <div class="machine-card fade-in" onclick="selectMachine(this, 'amikom')">
                <div class="card-content">
                    <img src="{{ asset('assets/images/maps/amikom.png') }}" 
                         alt="AMIKOM Yogyakarta" 
                         class="machine-image"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjgwIiBoZWlnaHQ9IjgwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik00MCAyMEM0Ni42Mjc0IDIwIDUyIDI1LjM3MjYgNTIgMzJWNDhDNTIgNTQuNjI3NCA0Ni42Mjc0IDYwIDQwIDYwQzMzLjM3MjYgNjAgMjggNTQuNjI3NCAyOCA0OFYzMkMyOCAyNS4zNzI2IDMzLjM3MjYgMjAgNDAgMjBaIiBmaWxsPSIjOTM5OUI4Ii8+CjxwYXRoIGQ9Ik0yNCAzNkgyMlYzOEgyNFYzNloiIGZpbGw9IiM2MzY1N0YiLz4KPHA+dGggZD0iTTU4IDM2SDU2VjM4SDU4VjM2WiIgZmlsbD0iIzYzNjU3RiIvPgo8cGF0aCBkPSJNMzggMjJIMzZWMjRIMzhWMjJaIiBmaWxsPSIjNjM2NTdGIi8+CjxwYXRoIGQ9Ik00NCAyMkg0MlYyNEg0NFYyMloiIGZpbGw9IiM2MzY1N0YiLz4KPC9zdmc+'">
                    
                    <div class="machine-info">
                        <h3 class="machine-name">AMIKOM Yogyakarta</h3>
                        <p class="machine-description">
                            Jl. Ring Road Utara, Ngringin, Condongcatur, 
                            Sleman, Daerah Istimewa Yogyakarta
                        </p>
                        
                        <div class="machine-details">
                            <div class="distance-badge">
                               <i class="fa-solid fa-location-dot"></i>
                                <span>1.5 KM</span>
                            </div>
                            
                            <div class="status-badge">
                              
                                <span>Status</span>
                            </div>
                            
                            <button class="route-button" onclick="openRoute('amikom')">
                                <span>Lihat Rute</span>
                                <i class="fas fa-external-link-alt route-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teras Malioboro 1 -->
            <div class="machine-card fade-in selected" onclick="selectMachine(this, 'teras-malioboro')" style="animation-delay: 0.1s">
                <div class="card-content">
                    <img src="{{ asset('assets/images/maps/teras_malioboro.png') }}" 
                         alt="Teras Malioboro 1" 
                         class="machine-image"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjgwIiBoZWlnaHQ9IjgwIiBmaWxsPSIjRUZGNkZGIi8+CjxwYXRoIGQ9Ik0yMCA0MEgyNFY0NEgyMFY0MFoiIGZpbGw9IiMzQjgyRjYiLz4KPHA+dGggZD0iTTI4IDQwSDMyVjQ0SDI4VjQwWiIgZmlsbD0iIzNCODJGNiIvPgo8cGF0aCBkPSJNMzYgNDBINDBWNDRIMzZWNDBaIiBmaWxsPSIjM0I4MkY2Ii8+CjxwYXRoIGQ9Ik00NCA0MEg0OFY0NEg0NFY0MFoiIGZpbGw9IiMzQjgyRjYiLz4KPHA+dGggZD0iTTUyIDQwSDU2VjQ0SDUyVjQwWiIgZmlsbD0iIzNCODJGNiIvPgo8cGF0aCBkPSJNNjAgNDBINjRWNDRINjBWNDBaIiBmaWxsPSIjM0I4MkY2Ii8+CjxwYXRoIGQ9Ik0yMCAzMkgyNFYzNkgyMFYzMloiIGZpbGw9IiM2MzY2RjEiLz4KPHA+dGggZD0iTTI4IDMySDMyVjM2SDI4VjMyWiIgZmlsbD0iIzYzNjZGMSIvPgo8cGF0aCBkPSJNMzYgMzJINDBWMzZIMzZWMzJaIiBmaWxsPSIjNjM2NkYxIi8+CjxwYXRoIGQ9Ik00NCAzMkg0OFYzNkg0NFYzMloiIGZpbGw9IiM2MzY2RjEiLz4KPHA+dGggZD0iTTUyIDMySDU2VjM2SDUyVjMyWiIgZmlsbD0iIzYzNjZGMSIvPgo8cGF0aCBkPSJNNjAgMzJINjRWMzZINjBWMzJaIiBmaWxsPSIjNjM2NkYxIi8+CjxwYXRoIGQ9Ik0yMCA0OEgyNFY1MkgyMFY0OFoiIGZpbGw9IiMxRDRFRDgiLz4KPHA+dGggZD0iTTI4IDQ4SDMyVjUySDI4VjQ4WiIgZmlsbD0iIzFENEVEOCIvPgo8cGF0aCBkPSJNMzYgNDhINDBWNTJIMzZWNDhaIiBmaWxsPSIjMUQ0RUQ4Ii8+CjxwYXRoIGQ9Ik00NCA0OEg0OFY1Mkg0NFY0OFoiIGZpbGw9IiMxRDRFRDgiLz4KPHA+dGggZD0iTTUyIDQ4SDU2VjUySDUyVjQ4WiIgZmlsbD0iIzFENEVEOCIvPgo8cGF0aCBkPSJNNjAgNDhINjRWNTJINjBWNDhaIiBmaWxsPSIjMUQ0RUQ4Ii8+CjwvcnN2Zz4='">
                    
                    <div class="machine-info">
                        <h3 class="machine-name">Teras Malioboro 1</h3>
                        <p class="machine-description">
                            Jl. Malioboro No.55-59, Gk.Gunung Condong, 
                            Sosromenduran, Kota Yogyakarta, Daerah Istimewa Yogyakarta
                        </p>
                        
                        <div class="machine-details">
                            <div class="distance-badge">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>0.9 KM</span>
                            </div>
                            
                            <div class="status-badge">
                               
                                <span>Status</span>
                            </div>
                            
                            <button class="route-button" onclick="openRoute('teras-malioboro')">
                                <span>Lihat Rute</span>
                                <i class="fas fa-external-link-alt route-icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Cards for demonstration -->
            <div class="loading-card" style="animation-delay: 0.2s">
                <div class="card-content">
                    <div class="w-20 h-20 bg-gray-300 rounded-xl animate-pulse"></div>
                    <div class="flex-1">
                        <div class="h-5 bg-gray-300 rounded mb-2 animate-pulse"></div>
                        <div class="h-4 bg-gray-200 rounded mb-3 animate-pulse"></div>
                        <div class="flex gap-3">
                            <div class="h-6 w-16 bg-gray-200 rounded-full animate-pulse"></div>
                            <div class="h-6 w-8 bg-gray-200 rounded-full animate-pulse"></div>
                            <div class="h-6 w-20 bg-gray-200 rounded-full animate-pulse ml-auto"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="loading-card" style="animation-delay: 0.3s">
                <div class="card-content">
                    <div class="w-20 h-20 bg-gray-300 rounded-xl animate-pulse"></div>
                    <div class="flex-1">
                        <div class="h-5 bg-gray-300 rounded mb-2 animate-pulse"></div>
                        <div class="h-4 bg-gray-200 rounded mb-3 animate-pulse"></div>
                        <div class="flex gap-3">
                            <div class="h-6 w-16 bg-gray-200 rounded-full animate-pulse"></div>
                            <div class="h-6 w-8 bg-gray-200 rounded-full animate-pulse"></div>
                            <div class="h-6 w-20 bg-gray-200 rounded-full animate-pulse ml-auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Maps JavaScript Functions -->
    <script src="{{ asset('assets/js/maps/cari-mesin.js') }}"></script>
</body>
</html>
