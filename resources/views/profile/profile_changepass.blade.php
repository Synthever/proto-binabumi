<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keamanan Akun - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/profile_changepass.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation-fixes.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                        <input 
                            type="password" 
                            class="form-input" 
                            placeholder="Sandi lama"
                            id="currentPassword"
                            required
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('currentPassword', this)">
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
                        <input 
                            type="password" 
                            class="form-input" 
                            placeholder="Sandi Baru"
                            id="newPassword"
                            required
                            oninput="checkPasswordStrength(this.value)"
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('newPassword', this)">
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
                        <input 
                            type="password" 
                            class="form-input" 
                            placeholder="Konfirmasi Sandi Baru"
                            id="confirmPassword"
                            required
                            oninput="checkPasswordMatch()"
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword', this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="form-error" id="confirmPasswordError">
                        Konfirmasi password tidak cocok
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="button" class="btn-primary" id="saveButton" onclick="saveChanges()">
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
    <script src="{{ asset('js/profile/navigation.js') }}"></script>
    <script src="{{ asset('js/profile/navigation-fixes.js') }}"></script>
    <script>
    <script>
        // Page-specific initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Mark current page
               <script>
 if (window.profileNavigator) {
                profileNavigator.currentPage = 'keamanan';
            }
        });

        // Enhanced navigation functions               <script>
nction goBack() {
            // Mark that we're returning to main page
            sessionStorage.setItem('returningToMain', 'true');
            
            if (window.profileNavigator) {
                profileNavigator.goBack();
            } else {
                // Fallback
                console.log('Going back...');
                window.history.back();
            }
        }

        // Enhanced save function with modal confirmation
        function saveChanges() {
            if (window.showModal) {
                showModal('save');
            } else {
                // Fallback to original function
                handleSubmit({ preventDefault: () => {}, target: document.getElementById('changePasswordForm') });
            }
        }

        // Password visibility toggle
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            const strengthContainer = document.getElementById('passwordStrength');
            const requirementsContainer = document.getElementById('passwordRequirements');
            const strengthFill = document.getElementById('strengthFill');
            const strengthLabel = document.getElementById('strengthLabel');
            const strengthPercentage = document.getElementById('strengthPercentage');
            
            if (password.length === 0) {
                strengthContainer.style.display = 'none';
                requirementsContainer.style.display = 'none';
                return;
            }
            
            strengthContainer.style.display = 'block';
            requirementsContainer.style.display = 'block';
            
            // Check requirements
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(password)
            };
            
            // Update requirement indicators
            updateRequirement('req-length', requirements.length);
            updateRequirement('req-uppercase', requirements.uppercase);
            updateRequirement('req-lowercase', requirements.lowercase);
            updateRequirement('req-number', requirements.number);
            
            // Calculate strength
            const validCount = Object.values(requirements).filter(Boolean).length;
            const strength = (validCount / 4) * 100;
            
            // Update strength bar
            strengthFill.style.width = strength + '%';
            strengthPercentage.textContent = Math.round(strength) + '%';
            
            // Update strength class and label
            strengthFill.className = 'strength-fill';
            if (strength >= 100) {
                strengthFill.classList.add('strength-strong');
                strengthLabel.textContent = 'Sangat Kuat';
            } else if (strength >= 75) {
                strengthFill.classList.add('strength-good');
                strengthLabel.textContent = 'Kuat';
            } else if (strength >= 50) {
                strengthFill.classList.add('strength-medium');
                strengthLabel.textContent = 'Sedang';
            } else {
                strengthFill.classList.add('strength-weak');
                strengthLabel.textContent = 'Lemah';
            }
        }
        
        function updateRequirement(reqId, isValid) {
            const requirement = document.getElementById(reqId);
            const check = requirement.querySelector('.requirement-check');
            const icon = check.querySelector('i');
            
            if (isValid) {
                check.classList.add('valid');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-check');
            } else {
                check.classList.remove('valid');
                icon.classList.remove('fa-check');
                icon.classList.add('fa-times');
            }
        }

        // Password match checker
        function checkPasswordMatch() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const errorElement = document.getElementById('confirmPasswordError');
            
            if (confirmPassword && newPassword !== confirmPassword) {
                errorElement.classList.add('show');
                return false;
            } else {
                errorElement.classList.remove('show');
                return true;
            }
        }

        // Form validation
        function validateForm() {
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            let isValid = true;
            
            // Reset errors
            document.querySelectorAll('.form-error').forEach(error => {
                error.classList.remove('show');
            });
            
            // Check current password
            if (!currentPassword) {
                document.getElementById('currentPasswordError').classList.add('show');
                isValid = false;
            }
            
            // Check new password strength
            const requirements = {
                length: newPassword.length >= 8,
                uppercase: /[A-Z]/.test(newPassword),
                lowercase: /[a-z]/.test(newPassword),
                number: /\d/.test(newPassword)
            };
            
            const allRequirementsMet = Object.values(requirements).every(Boolean);
            if (!allRequirementsMet) {
                document.getElementById('newPasswordError').classList.add('show');
                isValid = false;
            }
            
            // Check password match
            if (!checkPasswordMatch()) {
                isValid = false;
            }
            
            return isValid;
        }

        // Form submission
        function handleSubmit(event) {
            event.preventDefault();
            
            if (!validateForm()) {
                return;
            }
            
            const saveButton = document.getElementById('saveButton');
            const originalContent = saveButton.innerHTML;
            
            // Show loading state
            saveButton.innerHTML = '<span class="loading-spinner"></span>Menyimpan...';
            saveButton.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Show success message
                const successMessage = document.getElementById('successMessage');
                successMessage.classList.add('show');
                
                // Reset form
                document.getElementById('changePasswordForm').reset();
                document.getElementById('passwordStrength').style.display = 'none';
                document.getElementById('passwordRequirements').style.display = 'none';
                
                // Reset button
                saveButton.innerHTML = originalContent;
                saveButton.disabled = false;
                
                // Hide success message after 3 seconds
                setTimeout(() => {
                    successMessage.classList.remove('show');
                }, 3000);
                
            }, 2000);
        }

        // Reset form
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin membatalkan perubahan?')) {
                document.getElementById('changePasswordForm').reset();
                document.getElementById('passwordStrength').style.display = 'none';
                document.getElementById('passwordRequirements').style.display = 'none';
                
                // Reset all errors
                document.querySelectorAll('.form-error').forEach(error => {
                    error.classList.remove('show');
                });
                
                // Reset password toggles
                document.querySelectorAll('.password-toggle i').forEach(icon => {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                });
                
                document.querySelectorAll('input[type="text"]').forEach(input => {
                    if (input.classList.contains('form-input')) {
                        input.type = 'password';
                    }
                });
            }
        }

        // Add click animation effect
        document.querySelectorAll('.btn-primary, .btn-secondary, .back-button').forEach(item => {
            item.addEventListener('click', function() {
                if (!this.disabled) {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                }
            });
        });

        // Initialize page animations
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Real-time validation
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.id === 'newPassword') {
                        const requirements = {
                            length: this.value.length >= 8,
                            uppercase: /[A-Z]/.test(this.value),
                            lowercase: /[a-z]/.test(this.value),
                            number: /\d/.test(this.value)
                        };
                        
                        const allRequirementsMet = Object.values(requirements).every(Boolean);
                        if (!allRequirementsMet && this.value) {
                            document.getElementById('newPasswordError').classList.add('show');
                        }
                    }
                });
                
                input.addEventListener('input', function() {
                    // Remove error styling when user starts typing
                    const errorElement = document.getElementById(this.id + 'Error');
                    if (errorElement && errorElement.classList.contains('show')) {
                        errorElement.classList.remove('show');
                    }
                });
            });
        });
    </script>
</body>
</html>
