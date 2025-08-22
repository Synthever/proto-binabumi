<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Profil - SIGMA</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/profile_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/components/back-button.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation-fixes.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/scan/modal.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Emergency CSS reset untuk konsistensi browser */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            box-sizing: border-box !important;
            overflow-x: hidden !important;
        }
        
        .page-container, 
        .page-content, 
        .slide-in-from-right {
            width: 100% !important;
            box-sizing: border-box !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .profile-detail-container {
            width: 100% !important;
            max-width: 1024px !important;
            margin: 0 auto !important;
            box-sizing: border-box !important;
        }
        
        /* Force 20px padding - Emergency Override */
        .profile-container {
            padding: 20px !important;
        }
        
        .detail-card {
            padding: 20px !important;
            margin: 0 !important;
        }
    </style>
</head>


<body>
    <!-- Header dan konten dibungkus container agar lebar 1024px dan rata kiri -->
    <div style="max-width:1024px; margin:0 auto; width:100%; box-shadow: 0 0 20px rgba(0,0,0,0.10); background: #fff; padding: 20px;">
    <div class="header" style="margin-bottom: 24px; position: sticky; top: 0; z-index: 100; background: #fff;">
            <x-back-button href="/profile" />
            <h1>Data Profil</h1>
        </div>
        <!-- Main Content -->
        <div class="detail-card fade-in-delayed" style="padding: 20px !important;">
            <form id="profileForm" onsubmit="handleSubmit(event)">
                <!-- Section Title -->
                <h2 class="section-title">Detail Profil</h2>
                <!-- Photo Section -->
                <div class="photo-section">
                    <label class="photo-upload-label">Ubah foto profil</label>
                    <div class="profile-photo" onclick="triggerFileUpload()"
                        style="{{ $userData['profile_picture'] ? "background-image: url('{$userData['profile_picture']}'); background-size: cover; background-position: center;" : '' }}">
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
    </div>

    <!-- ...existing code... -->

                <!-- Loading Scripts -->
                <script src="{{ asset('/assets/js/profile/navigation-utils.js') }}"></script>
                <script src="{{ asset('/assets/js/profile/profile_detail.js') }}"></script>
</body>

</html>
