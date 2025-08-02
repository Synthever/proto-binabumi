<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/profile/profile_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/navigation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                    
                    <div class="menu-item" onclick="navigateTo('data-profil')">
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

    <!-- Loading Scripts -->
    <script src="{{ asset('js/profile/navigation.js') }}"></script>
    <script>
    <!-- Loading Scripts -->
    <script src="{{ asset('js/profile/navigation.js') }}"></script>
    <script>
        // Page-specific initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Mark this as the main page
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
            if (isBackNavigation) {
                // Kembali ke main: slide dari kiri ke kanan
                mainPageContent.classList.add('slide-in-from-left');
                sessionStorage.removeItem('returningToMain'); // Clean up
            }
        });

        // Enhanced menu interactions with haptic feedback
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

        // Initialize animations with stagger effect
        function initStaggerAnimation() {
            const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
                el.addEventListener('animationend', function() {
                    this.style.opacity = '1';
                    this.style.transform = 'translateY(0)';
                });
            });
        }

        // Performance optimization
        function optimizePerformance() {
            // Use passive event listeners for better scroll performance
            document.addEventListener('touchstart', function() {}, { passive: true });
            document.addEventListener('touchmove', function() {}, { passive: true });
            
            // Preload next likely pages
            const preloadLinks = [
                '{{ route("profile_detail") }}',
                '{{ route("profile_changepass") }}'
            ];
            
            preloadLinks.forEach(url => {
                const link = document.createElement('link');
                link.rel = 'prefetch';
                link.href = url;
                document.head.appendChild(link);
            });
        }

        // Initialize everything
        document.addEventListener('DOMContentLoaded', function() {
            initStaggerAnimation();
            optimizePerformance();
            
            // Add accessibility improvements
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
        });

        // Error handling
        window.addEventListener('error', function(e) {
            console.error('Profile page error:', e.error);
            // Show user-friendly error message
            if (window.showError) {
                showError('Terjadi Kesalahan', 'Silakan refresh halaman atau coba lagi nanti');
            }
        });

        // Network status monitoring
        function initNetworkMonitoring() {
            function updateNetworkStatus() {
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
        }

        // Initialize network monitoring
        initNetworkMonitoring();
    </script>
</body>
</html>