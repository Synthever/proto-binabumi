/**
 * Profile Change Password Page JavaScript
 * Handles password validation, strength checking, and form submission
 */

// Page-specific initialization
document.addEventListener('DOMContentLoaded', function() {
    // Mark current page
    if (window.profileNavigator) {
        profileNavigator.currentPage = 'keamanan';
    }

    initializePageAnimations();
    initializeFormValidation();
    initializeClickAnimations();
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
            target: document.getElementById('changePasswordForm')
        });
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
    if (!requirement) return;
    
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

// Initialize page animations
function initializePageAnimations() {
    const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
    elements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
    });
}

// Initialize click animations
function initializeClickAnimations() {
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
}

// Real-time validation
function initializeFormValidation() {
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
}
