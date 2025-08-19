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
