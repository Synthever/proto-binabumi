/**
 * Profile Detail Page JavaScript
 * Handles form interactions, file uploads, and data management
 */

// Page-specific initialization
document.addEventListener('DOMContentLoaded', function() {
    // Mark current page
    if (window.profileNavigator) {
        profileNavigator.currentPage = 'data-profil';
    }

    initializePageAnimations();
    initializeFormValidation();
    initializeCheckboxStyling();
    
    // Apply navigation fixes after a short delay
    setTimeout(() => {
        autoFixBackButton();
    }, 100);
});

// Re-apply fixes on window resize
window.addEventListener('resize', function() {
    setTimeout(autoFixBackButton, 100);
});

// Override global goBack function
window.goBack = enhancedGoBack;

// Store original profile data on page load for better reset functionality
document.addEventListener('DOMContentLoaded', function() {
    const profilePhoto = document.querySelector('.profile-photo');
    if (profilePhoto) {
        // Store original background image
        const computedStyle = window.getComputedStyle(profilePhoto);
        profilePhoto.dataset.originalImage = computedStyle.backgroundImage !== 'none' ? 
            computedStyle.backgroundImage.slice(5, -2) : '';
        
        // Store original initial letter
        profilePhoto.dataset.originalInitial = profilePhoto.textContent.trim();
    }
});

/**
 * Profile Detail Page JavaScript
 * Handles form interactions, file uploads, and data management
 */

// Back button functionality with enhanced fixes
function enhancedGoBack() {
    console.log('🔙 Enhanced go back triggered');
    
    // Add visual feedback
    const backButton = document.querySelector('.back-button');
    if (backButton) {
        backButton.style.transform = 'scale(0.95)';
        backButton.style.background = '#f0f0f0';
        
        setTimeout(() => {
            backButton.style.transform = '';
            backButton.style.background = '';
        }, 200);
    }
    
    // Mark that we're returning to main page
    sessionStorage.setItem('returningToMain', 'true');
    
    // Multiple fallback methods
    try {
        if (window.profileNavigator && typeof window.profileNavigator.goBack === 'function') {
            console.log('🔙 Using profileNavigator.goBack()');
            window.profileNavigator.goBack();
        } else if (window.history.length > 1) {
            console.log('🔙 Using window.history.back()');
            window.location.href = '/profile';
        } else {
            console.log('🔙 Redirecting to profile main');
            window.location.href = '/profile';
        }
    } catch (error) {
        console.error('❌ Error in goBack:', error);
        window.location.href = '/profile';
    }
}

// Fix scroll issues
function fixScrolling() {
    console.log('🔧 Fixing scroll issues...');
    
    const containers = document.querySelectorAll('.page-container, .page-content, .profile-detail-container');
    
    containers.forEach(container => {
        if (container) {
            container.style.height = 'auto';
            container.style.maxHeight = 'none';
            container.style.overflow = 'visible';
            container.style.overflowY = 'auto';
            container.style.position = 'relative';
        }
    });
    
    document.body.style.overflow = 'auto';
    document.body.style.height = 'auto';
    document.documentElement.style.overflow = 'auto';
    document.documentElement.style.height = 'auto';
    
    console.log('✅ Scroll fixes applied');
}

// Force attach click handlers for back button
function forceAttachClickHandlers() {
    console.log('🔧 Force attaching click handlers...');
    
    const backButtons = document.querySelectorAll('.back-button');
    
    backButtons.forEach((button, index) => {
        console.log(`🔧 Processing back button ${index + 1}:`, button);
        
        // Remove existing listeners
        button.removeEventListener('click', enhancedGoBack);
        
        // Add multiple event listeners for maximum compatibility
        button.addEventListener('click', enhancedGoBack, { passive: false });
        button.addEventListener('touchstart', function(e) {
            console.log('👆 Touch start on back button');
            button.style.transform = 'scale(0.95)';
        }, { passive: false });
        
        button.addEventListener('touchend', function(e) {
            console.log('👆 Touch end on back button');
            e.preventDefault();
            button.style.transform = '';
            enhancedGoBack();
        }, { passive: false });
        
        // Mouse events
        button.addEventListener('mousedown', function(e) {
            console.log('🖱️ Mouse down on back button');
            button.style.transform = 'scale(0.95)';
        });
        
        button.addEventListener('mouseup', function(e) {
            console.log('🖱️ Mouse up on back button');
            button.style.transform = '';
        });
        
        // Keyboard support
        button.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                enhancedGoBack();
            }
        });
        
        // Make sure button is focusable
        button.tabIndex = 0;
        button.setAttribute('role', 'button');
        button.setAttribute('aria-label', 'Kembali');
        
        // Force styles
        button.style.cssText += `
            position: relative !important;
            z-index: 99999 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        `;
        
        console.log('✅ Enhanced click handlers attached to button', index + 1);
    });
}

// Auto-fix function for navigation issues
function autoFixBackButton() {
    console.log('🔧 Auto-fixing back button issues...');
    
    fixScrolling();
    forceAttachClickHandlers();
    
    console.log('✅ Auto-fix complete');
}

// Backward compatibility function
function goBack() {
    enhancedGoBack();
}

// Enhanced save function with modal confirmation
function saveChanges() {
    if (window.showModal) {
        showModal('save');
    } else {
        // Fallback to original function
        handleSubmit({
            preventDefault: () => {},
            target: document.getElementById('profileForm')
        });
    }
}

// File upload functions
function triggerFileUpload() {
    document.getElementById('photoUpload').click();
}

function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            showNotificationModal('Tipe File Tidak Valid', 'Hanya file gambar (JPEG, PNG, JPG, GIF) yang diperbolehkan');
            return;
        }

        // Validate file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            showNotificationModal('Ukuran File Terlalu Besar', 'Ukuran file tidak boleh lebih dari 2MB');
            return;
        }

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

        // Upload the file immediately
        uploadProfilePicture(file);
    }
}

// Upload profile picture function
function uploadProfilePicture(file) {
    const formData = new FormData();
    formData.append('profile_picture', file);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');

    // Show loading state
    const fileText = document.querySelector('.file-upload-text');
    const originalText = fileText.textContent;
    fileText.textContent = 'Mengunggah...';
    fileText.style.color = '#065f46';

    fetch('/profile/upload-picture', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fileText.textContent = 'Foto berhasil diunggah!';
            fileText.style.color = '#065f46';
            
            // Update the profile photo display
            const profilePhoto = document.querySelector('.profile-photo');
            profilePhoto.style.backgroundImage = `url(${data.url})`;
            profilePhoto.style.backgroundSize = 'cover';
            profilePhoto.style.backgroundPosition = 'center';
            profilePhoto.textContent = '';

        } else {
            fileText.textContent = 'Gagal mengunggah foto';
            fileText.style.color = '#ef4444';
            showNotificationModal('Gagal Mengunggah Foto', 'Gagal mengunggah foto: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        fileText.textContent = 'Terjadi kesalahan';
        fileText.style.color = '#ef4444';
        showNotificationModal('Terjadi Kesalahan', 'Terjadi kesalahan saat mengunggah foto');
    });
}

// Form handling
function handleSubmit(event) {
    event.preventDefault();

    // Collect form data
    const formData = {
        username: document.getElementById('username').value,
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        no_handphone: document.getElementById('phone').value,
        _token: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
    };

    console.log('Form data:', formData);

    // Show loading state
    const submitBtn = event.target.querySelector('.btn-primary');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
    submitBtn.disabled = true;

    // Send update request
    fetch('/profile/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Store success notification for profile main page
            sessionStorage.setItem('profileUpdateSuccess', 'true');
            sessionStorage.setItem('profileUpdateMessage', 'Profil berhasil disimpan!');
            
            // Redirect to profile main page
            window.location.href = '/profile';
        } else {
            showNotificationModal('Gagal Menyimpan', 'Gagal menyimpan profil: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotificationModal('Terjadi Kesalahan', 'Terjadi kesalahan saat menyimpan profil');
    })
    .finally(() => {
        // Restore button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
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

// Initialize page animations
function initializePageAnimations() {
    const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
    elements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
    });
}

// Custom checkbox styling
function initializeCheckboxStyling() {
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
}

// Form validation
function initializeFormValidation() {
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
}

// Phone number formatting
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.startsWith('62')) {
                value = '+62 ' + value.slice(2).replace(/(\d{4})(\d{4})(\d{4})/, '$1 $2 $3');
            } else if (value.startsWith('0')) {
                value = '+62 ' + value.slice(1).replace(/(\d{4})(\d{4})(\d{4})/, '$1 $2 $3');
            }
            e.target.value = value;
        });
    }
});

// Add click animation effect
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-primary, .btn-secondary, .back-button').forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
});

// Notification Modal Functions
function showNotificationModal(title, message) {
    // Create modal overlay
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay';
    overlay.id = 'notification-modal';
    
    // Create modal HTML
    overlay.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-icon success">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3 class="modal-title">${title}</h3>
                <p class="modal-subtitle">${message}</p>
            </div>
            <div class="modal-actions">
                <button class="modal-button primary" onclick="closeNotificationModal()">Ok!</button>
            </div>
        </div>
    `;
    
    // Add to document
    document.body.appendChild(overlay);
    
    // Show modal with animation
    setTimeout(() => {
        overlay.classList.add('show');
    }, 10);
    
    // Add click outside to close
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            closeNotificationModal();
        }
    });
    
    // Add keyboard support
    document.addEventListener('keydown', handleNotificationKeydown);
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeNotificationModal() {
    const overlay = document.getElementById('notification-modal');
    if (!overlay) return;
    
    // Remove with animation
    overlay.classList.remove('show');
    
    setTimeout(() => {
        if (overlay.parentNode) {
            overlay.parentNode.removeChild(overlay);
        }
        
        // Restore body scroll
        document.body.style.overflow = '';
        
        // Remove keyboard listener
        document.removeEventListener('keydown', handleNotificationKeydown);
    }, 300);
}

function handleNotificationKeydown(e) {
    if (e.key === 'Escape' || e.key === 'Enter') {
        e.preventDefault();
        closeNotificationModal();
    }
}
