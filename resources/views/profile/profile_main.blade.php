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
    <script src="{{ asset('assets/js/profile/navigation-utils.js') }}" onerror="console.warn('Navigation utils script not found')">
    </script>
    <script src="{{ asset('assets/js/profile/profile_main.js') }}" onerror="console.warn('Profile main script not found')">
    </script>
    
</body>

</html>
