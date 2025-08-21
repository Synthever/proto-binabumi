<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Profil - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/profile_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation-fixes.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/scan/modal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Force minimal padding for immediate effect */
        .profile-container {
            padding: 100px 8px 40px !important;
            background: #ffffff !important;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1) !important;
        }
        
        @media (min-width: 1024px) {
            .profile-container {
                padding: 100px 8px 40px !important;
                background: #ffffff !important;
                border-left: 1px solid #e2e8f0 !important;
                border-right: 1px solid #e2e8f0 !important;
            }
        }
        
        .main-content {
            width: 100% !important;
            max-width: 500px !important;
            margin: 0 auto !important;
        }
    </style>
</head>

<body class="profile-container">
    <div class="main-content">
        <!-- Header Section -->
        <div class="header-section fade-in">
            <button class="back-button" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h1 class="page-title">Data Profil</h1>
        </div>

        <!-- Profile Form Content -->
        <form id="profileForm" onsubmit="handleSubmit(event)">
            <!-- Section Title -->
            <h2 class="section-title">Detail Profil</h2>

                        <!-- Photo Section -->
                        <div class="photo-section">
                            <label class="photo-upload-label">Ubah foto profil</label>
                            <div class="profile-photo" onclick="triggerFileUpload()" 
                                 @if($userData['profile_picture']) 
                                     style="background-image: url('{{ $userData['profile_picture'] }}'); background-size: cover; background-position: center;"
                                 @endif>
                                @if(!$userData['profile_picture'])
                                    {{ strtoupper(substr($userData['name'], 0, 1)) }}
                                @endif
                            </div>
                            <div class="file-upload-section">
                                <button type="button" class="file-upload-button" onclick="triggerFileUpload()">
                                    <i class="fas fa-upload"></i>
                                    Pilih file
                                </button>
                                <span class="file-upload-text">
                                    @if($userData['profile_picture'])
                                        Foto profil tersimpan
                                    @else
                                        Belum ada file ya dipilih
                                    @endif
                                </span>
                            </div>
                            <input type="file" id="photoUpload" accept="image/*" style="display: none;"
                                onchange="handleFileUpload(event)">
                        </div>

                        <!-- Form Fields -->
                        <div class="form-group">
                            <label class="form-label">Ubah nama lengkap</label>
                            <input type="text" class="form-input" value="{{ $userData['name'] }}"
                                placeholder="Masukkan nama lengkap" id="name" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Ubah username</label>
                            <input type="text" class="form-input" value="{{ $userData['username'] }}"
                                placeholder="Masukkan username" id="username" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Ubah email</label>
                            <input type="email" class="form-input" value="{{ $userData['email'] }}"
                                placeholder="Masukkan email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Ubah no hp</label>
                            <input type="tel" class="form-input" value="{{ $userData['no_handphone'] }}"
                                placeholder="Masukkan nomor HP" id="phone" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-input form-textarea" placeholder="Masukkan alamat lengkap" id="address"></textarea>
                        </div>

                        <!-- Checkbox Agreement -->
                        <div class="checkbox-group">
                            <input type="checkbox" class="checkbox-input" id="agreement" required>
                            <label for="agreement" class="checkbox-label">
                                Tambahkan alamat Anda disini
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button type="button" class="btn-primary" onclick="saveChanges()">
                                <i class="fas fa-save mr-2"></i>
                                Simpan
                            </button>
                            <button type="button" class="btn-secondary" onclick="resetForm()">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </button>
                        </div>
                    </form>
    </div>

    <!-- Loading Scripts -->
    <script src="{{ asset('/assets/js/profile/navigation-utils.js') }}"></script>
    <script src="{{ asset('/assets/js/profile/profile_detail.js') }}"></script>
</body>

</html>
