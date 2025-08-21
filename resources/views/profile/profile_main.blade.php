<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/profile_style.css') }}" onerror="this.remove()">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation.css') }}" onerror="this.remove()">
    <link rel="stylesheet" href="{{ asset('/assets/css/components/bottom-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/scan/modal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- EMERGENCY STICKY HEADER FIX -->
    <style>
        /* Debug - Make sure class is applied */
        .page-header {
            background: white;
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        /* Force sticky header for mobile - Direct CSS in head */
        .page-header.sticky-header {
            position: fixed !important;
            top: 0 !important;
            z-index: 9999 !important;
            background: white !important;
            border-bottom: 1px solid rgba(25, 61, 41, 0.1) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
            box-sizing: border-box !important;
            width: 100% !important;
        }

        /* Mobile specific */
        @media screen and (max-width: 767px) {
            .page-header.sticky-header {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                transform: none !important;
                width: 100vw !important;
                max-width: 100vw !important;
                padding: 15px 20px 10px 20px !important;
                z-index: 9999 !important;
                background: white !important;
            }
            
            .page-header.sticky-header .header-title {
                font-size: 16px !important;
                color: #193D29 !important;
                font-weight: 800 !important;
                margin: 0 !important;
            }
        }

        /* Extra small mobile */
        @media screen and (max-width: 480px) {
            .page-header.sticky-header {
                padding: 12px 16px 8px 16px !important;
            }
            
            .page-header.sticky-header .header-title {
                font-size: 15px !important;
            }
        }

        /* Desktop */
        @media screen and (min-width: 768px) {
            .page-header.sticky-header {
                position: fixed !important;
                top: 0 !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
                max-width: 1024px !important;
                width: 1024px !important;
                padding: 20px 32px 15px 32px !important;
                z-index: 9999 !important;
            }
            
            .page-header.sticky-header .header-title {
                font-size: 18px !important;
                color: #193D29 !important;
                font-weight: 800 !important;
                margin: 0 !important;
            }
        }

        /* Header title base styles */
        .header-title {
            color: #193D29 !important;
            font-weight: 800 !important;
            margin: 0 !important;
            font-size: 18px;
        }

        /* CRITICAL FIX: Remove transforms that break fixed positioning */
        .page-content,
        .page-container {
            transform: none !important;
        }

        /* Add padding to content when header is sticky */
        .profile-main-content {
            padding-top: 80px !important;
            margin-top: 0 !important;
        }

        /* Mobile-specific adjustments */
        @media (max-width: 375px) {
            .profile-main-content {
                padding-top: 60px !important;
            }
        }

        @media (min-width: 376px) and (max-width: 480px) {
            .profile-main-content {
                padding-top: 60px !important;
            }
        }

        @media (min-width: 481px) and (max-width: 767px) {
            .profile-main-content {
                padding-top: 65px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .profile-main-content {
                padding-top: 75px !important;
            }
        }
    </style>

        /* Force header to be positioned relative to viewport, not parent */
        body > .page-header.sticky-header {
            position: fixed !important;
            top: 0 !important;
            z-index: 9999 !important;
            background: white !important;
            border-bottom: 1px solid rgba(25, 61, 41, 0.1) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
            box-sizing: border-box !important;
        }
    </style>

    <!-- Debug Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('.page-header.sticky-header');
            if (header) {
                console.log('Sticky header found:', header);
                console.log('Header classes:', header.className);
                console.log('Header computed style position:', getComputedStyle(header).position);
                
                // Force fix positioning
                header.style.position = 'fixed';
                header.style.top = '0';
                header.style.left = window.innerWidth <= 767 ? '0' : '50%';
                header.style.transform = window.innerWidth <= 767 ? 'none' : 'translateX(-50%)';
                header.style.zIndex = '9999';
                header.style.width = window.innerWidth <= 767 ? '100vw' : '1024px';
                header.style.maxWidth = window.innerWidth <= 767 ? '100vw' : '1024px';
                header.style.background = 'white';
                header.style.borderBottom = '1px solid rgba(25, 61, 41, 0.1)';
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
                
                console.log('Header position after fix:', getComputedStyle(header).position);
            } else {
                console.log('Sticky header NOT found');
            }
            
            // Remove transforms from parent containers
            const pageContent = document.querySelector('.page-content');
            const pageContainer = document.querySelector('.page-container');
            
            if (pageContent) {
                pageContent.style.transform = 'none';
                console.log('Removed transform from page-content');
            }
            
            if (pageContainer) {
                pageContainer.style.transform = 'none';
                console.log('Removed transform from page-container');
            }
        });
    </script>


</head>

<body class="bg-gray-50">
    <!-- Profile Header Component - MOVED OUTSIDE ALL CONTAINERS -->
    <x-header title="Akun Saya" :sticky="true" />
    
    <div class="page-container">
        <div class="page-content" id="mainPageContent">
            <div class="profile-container">                
                <!-- Main Content -->
                <div>

                    <!-- Profile Card -->
                    <div class="profile-card fade-in">
                        <div class="profile-avatar" 
                             @if($userData['profile_picture']) 
                                 style="background-image: url('{{ $userData['profile_picture'] }}'); background-size: cover; background-position: center;"
                             @endif>
                            @if(!$userData['profile_picture'])
                                {{ strtoupper(substr($userData['name'], 0, 1)) }}
                            @endif
                        </div>
                        <h2 class="text-2xl font-bold text-center text-gray-800 mb-3">{{ $userData['name'] }}</h2>
                        <p class="text-center text-gray-500 text-base">{{ $userData['email'] }}</p>
                    </div>

                    <!-- Vertical Layout for Settings and Other Info -->
                    <div class="space-y-8">
                        <!-- Pengaturan Section -->
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

                        <!-- Info Lainnya Section -->
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
                    <div class="mt-10 mb-8 fade-in-delayed" style="animation-delay: 0.6s;">
                        <div class="space-y-4">
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
    <script src="{{ asset('assets/js/profile/navigation-utils.js') }}" onerror="console.warn('Navigation utils script not found')">
    </script>
    <script src="{{ asset('assets/js/profile/profile_main.js') }}" onerror="console.warn('Profile main script not found')">
    </script>
    
</body>

</html>
