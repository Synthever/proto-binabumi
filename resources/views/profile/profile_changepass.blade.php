<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Keamanan Akun - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/profile_changepass.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation-fixes.css') }}">
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
        
        .changepass-container {
            width: 100% !important;
            max-width: 1024px !important;
            margin: 0 auto !important;
            box-sizing: border-box !important;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="page-container">
        <div class="page-content slide-in-from-right">
            <div class="changepass-container">
                <html lang="id">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Keamanan Akun - SIGMA</title>
                    <script src="https://cdn.tailwindcss.com"></script>
                    <link rel="stylesheet" href="{{ asset('css/profile/profile_changepass.css') }}">
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                </head>

                <body class="bg-gray-50">
                    <div class="change-password-container">
                        <!-- Header Section -->
                        <div class="header-section fade-in">
                            <button class="back-button" onclick="goBack()">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <h1 class="page-title">Keamanan Akun</h1>
                        </div>

                        <!-- Success Message -->
                        <div class="success-message" id="successMessage">
                            <i class="fas fa-check-circle"></i>
                            <span>Password berhasil diubah!</span>
                        </div>

                        <!-- Main Content -->
                        <div class="password-card fade-in-delayed">
                            <form id="changePasswordForm" onsubmit="handleSubmit(event)">
                                <!-- Section Title -->
                                <h2 class="section-title">Ubah Sandi Akun</h2>

                                <!-- Current Password -->
                                <div class="form-group">
                                    <div class="password-input-wrapper">
                                        <input type="password" class="form-input" placeholder="Sandi lama"
                                            id="currentPassword" required>
                                        <button type="button" class="password-toggle"
                                            onclick="togglePassword('currentPassword', this)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-error" id="currentPasswordError">
                                        Sandi lama tidak valid
                                    </div>
                                </div>

                                <!-- New Password -->
                                <div class="form-group">
                                    <div class="password-input-wrapper">
                                        <input type="password" class="form-input" placeholder="Sandi Baru"
                                            id="newPassword" required oninput="checkPasswordStrength(this.value)">
                                        <button type="button" class="password-toggle"
                                            onclick="togglePassword('newPassword', this)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>

                                    <!-- Password Strength Indicator -->
                                    <div class="password-strength" id="passwordStrength" style="display: none;">
                                        <div class="strength-bar">
                                            <div class="strength-fill" id="strengthFill"></div>
                                        </div>
                                        <div class="strength-text">
                                            <span id="strengthLabel">Lemah</span>
                                            <span id="strengthPercentage">0%</span>
                                        </div>
                                    </div>

                                    <!-- Password Requirements -->
                                    <div class="password-requirements" id="passwordRequirements" style="display: none;">
                                        <div class="requirement-item" id="req-length">
                                            <div class="requirement-check">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <span>Minimal 8 karakter</span>
                                        </div>
                                        <div class="requirement-item" id="req-uppercase">
                                            <div class="requirement-check">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <span>Huruf besar (A-Z)</span>
                                        </div>
                                        <div class="requirement-item" id="req-lowercase">
                                            <div class="requirement-check">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <span>Huruf kecil (a-z)</span>
                                        </div>
                                        <div class="requirement-item" id="req-number">
                                            <div class="requirement-check">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <span>Angka (0-9)</span>
                                        </div>
                                    </div>

                                    <div class="form-error" id="newPasswordError">
                                        Password tidak memenuhi kriteria keamanan
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <div class="password-input-wrapper">
                                        <input type="password" class="form-input" placeholder="Konfirmasi Sandi Baru"
                                            id="confirmPassword" required oninput="checkPasswordMatch()">
                                        <button type="button" class="password-toggle"
                                            onclick="togglePassword('confirmPassword', this)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-error" id="confirmPasswordError">
                                        Konfirmasi password tidak cocok
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="action-buttons">
                                    <button type="button" class="btn-primary" id="saveButton"
                                        onclick="saveChanges()">
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

                    <!-- Scripts -->
                    <script src="{{ asset('/assets/js/profile/navigation.js') }}"></script>
                    <script src="{{ asset('/assets/js/profile/navigation-fixes.js') }}"></script>
                    <script src="{{ asset('/assets/js/profile/profile_changepass.js') }}"></script>
                </body>

                </html>
