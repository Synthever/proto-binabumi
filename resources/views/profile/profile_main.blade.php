<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/profile/profile_style.css') }}" onerror="this.remove()">
    <link rel="stylesheet" href="{{ asset('assets/css/profile/navigation.css') }}" onerror="this.remove()">
    <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Fallback Styles -->
    <style>
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            padding-bottom: 100px; /* Space for bottom navigation */
        }
        
        .profile-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #2D5A3A;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            margin: 0 auto 1rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .menu-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .menu-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
        }
        
        .icon-data-profil { background: #3B82F6; }
        .icon-keamanan { background: #10B981; }
        .icon-rekening { background: #F59E0B; }
        .icon-kebijakan { background: #8B5CF6; }
        .icon-syarat { background: #EF4444; }
        
        .menu-text {
            flex: 1;
        }
        
        .menu-text h3 {
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.25rem;
        }
        
        .menu-text p {
            color: #6B7280;
            font-size: 0.875rem;
        }
        
        .chevron-icon {
            color: #9CA3AF;
        }
        
        .action-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            width: 100%;
        }
        
        .btn-logout {
            background: #EF4444;
            color: white;
        }
        
        .btn-logout:hover {
            background: #DC2626;
        }
        
        .btn-delete {
            background: #374151;
            color: white;
        }
        
        .btn-delete:hover {
            background: #1F2937;
        }
        
        .fade-in, .fade-in-delayed {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-in-from-left {
            animation: slideInFromLeft 0.3s ease forwards;
        }
        
        @keyframes slideInFromLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }
        
        .keyboard-navigation *:focus {
            outline: 2px solid #3B82F6;
            outline-offset: 2px;
        }
        
        .offline {
            filter: grayscale(100%);
        }
        
        @media (max-width: 768px) {
            .profile-container {
                margin: 0;
                border-radius: 0;
                padding-bottom: 120px; /* Extra space for mobile bottom nav */
            }
            
            .menu-item {
                padding: 0.75rem;
            }
            
            .menu-icon {
                width: 35px;
                height: 35px;
            }
            
            .p-8 {
                padding: 1.5rem !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="page-container">
        <div class="page-content" id="mainPageContent">
            <div class="profile-container">

                <!-- Main Content -->
                <div class="p-8">
                    <!-- Header -->
                    <h1 class="text-3xl font-bold text-gray-800 mb-10 fade-in">Akun Saya</h1>

                    <!-- Profile Card -->
                    <div class="profile-card fade-in">
                        <div class="profile-avatar">P</div>
                        <h2 class="text-2xl font-bold text-center text-gray-800 mb-3">Pamela Tri Anjani</h2>
                        <p class="text-center text-gray-500 text-base">pamelalrianjani@gmail.com</p>
                    </div>

                    <!-- Two Column Layout for iPad Pro -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column - Pengaturan Section -->
                <div class="fade-in-delayed">
                    <h3 class="section-title">Pengaturan</h3>
                    
                    <div class="menu-item" onclick="navigateTo('data-profile')">
                        <div class="menu-icon icon-data-profil">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="menu-text">
                            <h3>Data Profil</h3>
                            <p>Ubah data profil Anda</p>
                        </div>
                        <div class="chevron-icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>

                    <div class="menu-item" onclick="navigateTo('keamanan')">
                        <div class="menu-icon icon-keamanan">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="menu-text">
                            <h3>Keamanan Akun</h3>
                            <p>Ubah kata sandi Anda</p>
                        </div>
                        <div class="chevron-icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>

                    <div class="menu-item" onclick="navigateTo('rekening')">
                        <div class="menu-icon icon-rekening">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="menu-text">
                            <h3>Rekening</h3>
                            <p>Ubah no rekening Anda</p>
                        </div>
                        <div class="chevron-icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Info Lainnya Section -->
                <div class="fade-in-delayed" style="animation-delay: 0.2s;">
                    <h3 class="section-title">Info lainnya</h3>
                    
                    <div class="menu-item" onclick="navigateTo('kebijakan')">
                        <div class="menu-icon icon-kebijakan">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="menu-text">
                            <h3>Kebijakan Privasi</h3>
                            <p>Lihat dan kelola privasi Anda</p>
                        </div>
                        <div class="chevron-icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>

                    <div class="menu-item" onclick="navigateTo('syarat')">
                        <div class="menu-icon icon-syarat">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="menu-text">
                            <h3>Syarat & Ketentuan</h3>
                            <p>Baca aturan penggunaan aplikasi</p>
                        </div>
                        <div class="chevron-icon">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>

                    <!-- Action Buttons -->
                    <div class="mt-10 fade-in-delayed" style="animation-delay: 0.6s;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <button class="action-button btn-logout" onclick="logout()">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Log Out
                            </button>
                            
                            <button class="action-button btn-delete" onclick="confirmDelete()">
                                <i class="fas fa-trash-alt mr-3"></i>
                                Hapus Akun
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation Component -->
    @include('components.bottom-nav', ['active' => 'profil'])

    <!-- Loading Scripts -->
    <script src="{{ asset('assets/js/profile/navigation.js') }}" onerror="console.warn('Navigation script not found')"></script>
    <script>
        // Debug logging function
        function debugLog(message, data = null) {
            console.log(`[Profile Debug] ${message}`, data || '');
        }
        
        // Error handling function
        function handleError(error, context) {
            console.error(`[Profile Error] ${context}:`, error);
        }

        // Enhanced menu interactions with haptic feedback
        function initMenuInteractions() {
            try {
                debugLog('Initializing menu interactions');
                
                document.querySelectorAll('.menu-item, .action-button').forEach(item => {
                    item.addEventListener('click', function() {
                        // Add visual feedback
                        this.style.transform = 'scale(0.95)';
                        
                        // Add haptic feedback if available
                        if ('vibrate' in navigator) {
                            navigator.vibrate(50);
                        }
                        
                        setTimeout(() => {
                            this.style.transform = '';
                        }, 150);
                    });
                    
                    // Add hover effect for non-touch devices
                    item.addEventListener('mouseenter', function() {
                        if (!('ontouchstart' in window)) {
                            this.style.transform = 'translateY(-1px)';
                        }
                    });
                    
                    item.addEventListener('mouseleave', function() {
                        if (!('ontouchstart' in window)) {
                            this.style.transform = '';
                        }
                    });
                });
                
                debugLog('Menu interactions initialized');
            } catch (error) {
                handleError(error, 'Menu interactions initialization');
            }
        }

        // Initialize animations with stagger effect
        function initStaggerAnimation() {
            try {
                debugLog('Initializing stagger animations');
                
                const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
                elements.forEach((el, index) => {
                    el.style.animationDelay = `${index * 0.1}s`;
                    el.addEventListener('animationend', function() {
                        this.style.opacity = '1';
                        this.style.transform = 'translateY(0)';
                    });
                });
                
                debugLog('Stagger animations initialized');
            } catch (error) {
                handleError(error, 'Stagger animations initialization');
            }
        }

        // Performance optimization
        function optimizePerformance() {
            try {
                debugLog('Optimizing performance');
                
                // Use passive event listeners for better scroll performance
                document.addEventListener('touchstart', function() {}, { passive: true });
                document.addEventListener('touchmove', function() {}, { passive: true });
                
                debugLog('Performance optimization completed');
            } catch (error) {
                handleError(error, 'Performance optimization');
            }
        }

        // Accessibility improvements
        function initAccessibility() {
            try {
                debugLog('Initializing accessibility features');
                
                document.querySelectorAll('.menu-item').forEach((item, index) => {
                    item.setAttribute('tabindex', '0');
                    item.setAttribute('role', 'button');
                    item.setAttribute('aria-label', item.querySelector('h3').textContent);
                    
                    // Keyboard navigation
                    item.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            this.click();
                        }
                    });
                });
                
                // Add focus indicators
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Tab') {
                        document.body.classList.add('keyboard-navigation');
                    }
                });
                
                document.addEventListener('mousedown', function() {
                    document.body.classList.remove('keyboard-navigation');
                });
                
                debugLog('Accessibility features initialized');
            } catch (error) {
                handleError(error, 'Accessibility initialization');
            }
        }

        // Network status monitoring
        function initNetworkMonitoring() {
            try {
                debugLog('Initializing network monitoring');
                
                function updateNetworkStatus() {
                    const status = navigator.onLine ? 'online' : 'offline';
                    debugLog('Network status:', status);
                    
                    if (navigator.onLine) {
                        document.body.classList.remove('offline');
                    } else {
                        document.body.classList.add('offline');
                        if (window.showError) {
                            showError('Tidak Ada Koneksi', 'Periksa koneksi internet Anda');
                        }
                    }
                }
                
                window.addEventListener('online', updateNetworkStatus);
                window.addEventListener('offline', updateNetworkStatus);
                updateNetworkStatus();
                
                debugLog('Network monitoring initialized');
            } catch (error) {
                handleError(error, 'Network monitoring initialization');
            }
        }

        // Initialize everything when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            try {
                debugLog('Profile page initializing...');
                
                // Page navigation setup
                if (window.profileNavigator) {
                    profileNavigator.currentPage = 'main';
                    profileNavigator.pageStack = ['main'];
                }
                
                // Initialize page state
                history.replaceState({ page: 'main' }, '', '/profile');
                
                // Detect if returning from sub-page and add appropriate slide animation
                const isBackNavigation = window.performance.navigation.type === 2 || 
                                        document.referrer.includes('/profile/') ||
                                        sessionStorage.getItem('returningToMain') === 'true';
                
                const mainPageContent = document.getElementById('mainPageContent');
                if (isBackNavigation && mainPageContent) {
                    mainPageContent.classList.add('slide-in-from-left');
                    sessionStorage.removeItem('returningToMain');
                }
                
                // Initialize all features
                initStaggerAnimation();
                initMenuInteractions();
                optimizePerformance();
                initAccessibility();
                initNetworkMonitoring();
                
                debugLog('Profile page initialized successfully');
            } catch (error) {
                handleError(error, 'Profile initialization');
            }
        });

        // Error handling
        window.addEventListener('error', function(e) {
            handleError(e.error, 'Global error');
            // Show user-friendly error message
            if (window.showError) {
                showError('Terjadi Kesalahan', 'Silakan refresh halaman atau coba lagi nanti');
            }
        });

        // Navigation functions with error handling
        function navigateTo(page) {
            try {
                debugLog('Navigating to:', page);
                
                if (!page) {
                    throw new Error('Page parameter is required');
                }
                
                if (window.profileNavigator && typeof window.profileNavigator.navigateTo === 'function') {
                    window.profileNavigator.navigateTo(page);
                } else {
                    // Fallback navigation
                    debugLog('Using fallback navigation');
                    window.location.href = `/profile/${page}`;
                }
            } catch (error) {
                handleError(error, 'Navigation');
            }
        }

        function logout() {
            try {
                debugLog('Logout initiated');
                
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    debugLog('User confirmed logout');
                    // Add logout logic here
                    window.location.href = '/logout';
                }
            } catch (error) {
                handleError(error, 'Logout');
            }
        }

        function confirmDelete() {
            try {
                debugLog('Account deletion initiated');
                
                if (confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')) {
                    debugLog('User confirmed account deletion');
                    // Add delete account logic here
                    console.log('Delete account requested');
                }
            } catch (error) {
                handleError(error, 'Account deletion');
            }
        }
    </script>
</body>
</html>