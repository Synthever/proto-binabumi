<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Profil - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/profile_detail.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation-fixes.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="page-container">
        <div class="page-content slide-in-from-right">
            <div class="profile-detail-container">
            <!-- Header Section -->
            <div class="header-section fade-in">
                <button class="back-button" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1 class="page-title">Data Profil</h1>
            </div>

        <!-- Main Content -->
        <div class="detail-card fade-in-delayed">
            <form id="profileForm" onsubmit="handleSubmit(event)">
                <!-- Section Title -->
                <h2 class="section-title">Detail Profil</h2>
                
                <!-- Photo Section -->
                <div class="photo-section">
                    <label class="photo-upload-label">Ubah foto profil</label>
                    <div class="profile-photo" onclick="triggerFileUpload()">
                        P
                    </div>
                    <div class="file-upload-section">
                        <button type="button" class="file-upload-button" onclick="triggerFileUpload()">
                            <i class="fas fa-upload"></i>
                            Pilih file
                        </button>
                        <span class="file-upload-text">Belum ada file ya dipilih</span>
                    </div>
                    <input type="file" id="photoUpload" accept="image/*" style="display: none;" onchange="handleFileUpload(event)">
                </div>

                <!-- Form Fields -->
                <div class="form-group">
                    <label class="form-label">Ubah username</label>
                    <input 
                        type="text" 
                        class="form-input" 
                        value="Pamela Tri Anjani" 
                        placeholder="Masukkan username"
                        id="username"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Ubah email</label>
                    <input 
                        type="email" 
                        class="form-input" 
                        value="pamelalrianjani@gmail.com" 
                        placeholder="Masukkan email"
                        id="email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Ubah no hp</label>
                    <input 
                        type="tel" 
                        class="form-input" 
                        value="+62 8888 7777 3333" 
                        placeholder="Masukkan nomor HP"
                        id="phone"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea 
                        class="form-input form-textarea" 
                        placeholder="Masukkan alamat lengkap"
                        id="address"
                    ></textarea>
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

    <!-- Loading Scripts -->
    <script src="{{ asset('js/profile/navigation.js') }}"></script>
    <script src="{{ asset('js/profile/navigation-fixes.js') }}"></script>
    <script>
        // Page-specific initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Mark current page
            if (window.profileNavigator) {
                profileNavigator.currentPage = 'data-profil';
            }
        });

        // Enhanced navigation functions
        function goBack() {
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
                handleSubmit({ preventDefault: () => {}, target: document.getElementById('profileForm') });
            }
        }

        // File upload functions
        function triggerFileUpload() {
            document.getElementById('photoUpload').click();
        }

        function handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const fileText = document.querySelector('.file-upload-text');
                fileText.textContent = file.name;
                fileText.style.color = '#065f46';
                
                // Preview the image
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profilePhoto = document.querySelector('.profile-photo');
                    profilePhoto.style.backgroundImage = `url(${e.target.result})`;
                    profilePhoto.style.backgroundSize = 'cover';
                    profilePhoto.style.backgroundPosition = 'center';
                    profilePhoto.textContent = '';
                };
                reader.readAsDataURL(file);
            }
        }

        // Form handling
        function handleSubmit(event) {
            event.preventDefault();
            
            // Collect form data
            const formData = {
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                photo: document.getElementById('photoUpload').files[0]
            };
            
            console.log('Form data:', formData);
            
            // Show loading state
            const submitBtn = event.target.querySelector('.btn-primary');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                alert('Profil berhasil disimpan!');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        }

        function resetForm() {
            if (confirm('Apakah Anda yakin ingin membatalkan perubahan?')) {
                document.getElementById('profileForm').reset();
                
                // Reset photo preview
                const profilePhoto = document.querySelector('.profile-photo');
                profilePhoto.style.backgroundImage = '';
                profilePhoto.textContent = 'P';
                
                // Reset file upload text
                const fileText = document.querySelector('.file-upload-text');
                fileText.textContent = 'Belum ada file ya dipilih';
                fileText.style.color = '#9ca3af';
            }
        }

        // Custom checkbox styling
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.checkbox-input');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        this.style.background = '#065f46';
                        this.style.borderColor = '#065f46';
                    } else {
                        this.style.background = '';
                        this.style.borderColor = '#d1d5db';
                    }
                });
            });
        });

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.required && !this.value) {
                        this.style.borderColor = '#ef4444';
                    } else {
                        this.style.borderColor = '#e5e7eb';
                    }
                });
                
                input.addEventListener('input', function() {
                    if (this.style.borderColor === 'rgb(239, 68, 68)') {
                        this.style.borderColor = '#e5e7eb';
                    }
                });
            });
        });

        // Add click animation effect
        document.querySelectorAll('.btn-primary, .btn-secondary, .back-button').forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Initialize page animations
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Phone number formatting
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('62')) {
                value = '+62 ' + value.slice(2).replace(/(\d{4})(\d{4})(\d{4})/, '$1 $2 $3');
            } else if (value.startsWith('0')) {
                value = '+62 ' + value.slice(1).replace(/(\d{4})(\d{4})(\d{4})/, '$1 $2 $3');
            }
            e.target.value = value;
        });
    </script>
</body>
</html>
