/**
 * Profile Change Rekening Page JavaScript
 * Handles bank selection, account number formatting, and form validation
 */

let selectedBank = 'BCA';

// Page initialization
document.addEventListener('DOMContentLoaded', function() {
    // Mark current page for navigation
    if (window.profileNavigator) {
        profileNavigator.currentPage = 'rekening';
    }

    initializePageAnimations();
    initializeFormValidation();
    initializeBankSelection();
    initializeClickAnimations();
    initializeKeyboardNavigation();
    setupAccountNumberHandling();
    
    // Apply navigation fixes
    setTimeout(() => {
        autoFixBackButton();
    }, 100);
});

// Override global goBack function
window.goBack = enhancedGoBack;

// Enhanced navigation functions with fixes
function enhancedGoBack() {
    console.log('🔙 Enhanced go back triggered from changerekening');
    
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
    
    try {
        if (window.profileNavigator && typeof window.profileNavigator.goBack === 'function') {
            window.profileNavigator.goBack();
        } else {
            window.location.href = '/profile';
        }
    } catch (error) {
        console.error('❌ Error in goBack:', error);
        window.location.href = '/profile';
    }
}

// Fix scroll issues
function fixScrolling() {
    const containers = document.querySelectorAll('.page-container, .page-content, .changerekening-container');
    
    containers.forEach(container => {
        if (container) {
            container.style.height = 'auto';
            container.style.maxHeight = 'none';
            container.style.overflow = 'visible';
            container.style.overflowY = 'auto';
        }
    });
    
    document.body.style.overflow = 'auto';
}

// Force attach click handlers
function forceAttachClickHandlers() {
    const backButtons = document.querySelectorAll('.back-button');
    
    backButtons.forEach((button) => {
        button.removeEventListener('click', enhancedGoBack);
        button.addEventListener('click', enhancedGoBack, { passive: false });
        button.addEventListener('touchend', function(e) {
            e.preventDefault();
            enhancedGoBack();
        }, { passive: false });
        
        button.style.cssText += `
            position: relative !important;
            z-index: 99999 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
        `;
    });
}

// Auto-fix function
function autoFixBackButton() {
    fixScrolling();
    forceAttachClickHandlers();
}

// Backward compatibility
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
            target: document.getElementById('rekeningForm')
        });
    }
}

// Dropdown functions
function toggleDropdown() {
    const dropdown = document.getElementById('bankDropdown');
    const menu = document.getElementById('bankDropdownMenu');
    const arrow = dropdown.querySelector('.dropdown-arrow i');

    dropdown.classList.toggle('active');
    menu.classList.toggle('show');

    // Rotate arrow
    if (dropdown.classList.contains('active')) {
        arrow.style.transform = 'rotate(180deg)';
    } else {
        arrow.style.transform = 'rotate(0deg)';
    }
}

function selectBank(bankCode, bankFullName) {
    selectedBank = bankCode;
    document.getElementById('selectedBankName').textContent = bankCode;

    // Close dropdown
    const dropdown = document.getElementById('bankDropdown');
    const menu = document.getElementById('bankDropdownMenu');
    const arrow = dropdown.querySelector('.dropdown-arrow i');

    dropdown.classList.remove('active');
    menu.classList.remove('show');
    arrow.style.transform = 'rotate(0deg)';

    // Update selected state
    document.querySelectorAll('.bank-option').forEach(option => {
        option.classList.remove('selected');
    });

    // Find and select the clicked option
    const clickedOption = Array.from(document.querySelectorAll('.bank-option')).find(option =>
        option.querySelector('.bank-name').textContent === bankCode
    );
    if (clickedOption) {
        clickedOption.classList.add('selected');
    }

    console.log('Selected bank:', bankCode);
}

// Format account name to uppercase
function formatAccountName(input) {
    input.value = input.value.toUpperCase();

    // Remove error if user starts typing
    const errorElement = document.getElementById('accountNameError');
    if (errorElement.classList.contains('show')) {
        errorElement.classList.remove('show');
    }
}

// Format account number with dashes
function formatAccountNumber(input) {
    let value = input.value.replace(/\D/g, ''); // Remove non-digits

    // Format based on selected bank
    if (selectedBank === 'BCA') {
        // BCA format: XXX-XXX-XXXX
        if (value.length > 3 && value.length <= 6) {
            value = value.slice(0, 3) + '-' + value.slice(3);
        } else if (value.length > 6) {
            value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 10);
        }
    } else if (selectedBank === 'BNI' || selectedBank === 'BRI') {
        // BNI/BRI format: XXXX-XX-XXXXX-XXX-X
        if (value.length > 4 && value.length <= 6) {
            value = value.slice(0, 4) + '-' + value.slice(4);
        } else if (value.length > 6 && value.length <= 11) {
            value = value.slice(0, 4) + '-' + value.slice(4, 6) + '-' + value.slice(6);
        } else if (value.length > 11 && value.length <= 14) {
            value = value.slice(0, 4) + '-' + value.slice(4, 6) + '-' + value.slice(6, 11) + '-' + value.slice(11);
        } else if (value.length > 14) {
            value = value.slice(0, 4) + '-' + value.slice(4, 6) + '-' + value.slice(6, 11) + '-' + value.slice(11, 14) + '-' + value.slice(14, 15);
        }
    } else {
        // Generic format: XXX-XXX-XXXX
        if (value.length > 3 && value.length <= 6) {
            value = value.slice(0, 3) + '-' + value.slice(3);
        } else if (value.length > 6) {
            value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 10);
        }
    }

    input.value = value;

    // Remove error if user starts typing
    const errorElement = document.getElementById('accountNumberError');
    if (errorElement.classList.contains('show')) {
        errorElement.classList.remove('show');
    }
}

// Form validation
function validateForm() {
    let isValid = true;

    // Reset errors
    document.querySelectorAll('.form-error').forEach(error => {
        error.classList.remove('show');
    });

    // Validate account name
    const accountName = document.getElementById('accountName').value.trim();
    if (!accountName) {
        document.getElementById('accountNameError').classList.add('show');
        isValid = false;
    }

    // Validate account number
    const accountNumber = document.getElementById('accountNumber').value.trim();
    const cleanAccountNumber = accountNumber.replace(/\D/g, '');

    if (!accountNumber || cleanAccountNumber.length < 8) {
        document.getElementById('accountNumberError').classList.add('show');
        document.getElementById('accountNumberError').textContent =
            cleanAccountNumber.length === 0 ? 'Nomor rekening harus diisi' : 'Nomor rekening minimal 8 digit';
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

    // Collect form data
    const formData = {
        bank: selectedBank,
        accountName: document.getElementById('accountName').value,
        accountNumber: document.getElementById('accountNumber').value
    };

    console.log('Form data:', formData);

    // Simulate API call
    setTimeout(() => {
        // Show success message
        const successMessage = document.getElementById('successMessage');
        successMessage.classList.add('show');

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
        // Reset form values
        document.getElementById('accountName').value = 'PAMELA TRI ANJANI';
        document.getElementById('accountNumber').value = '365 - 111 - 5657';

        // Reset bank selection
        selectedBank = 'BCA';
        document.getElementById('selectedBankName').textContent = 'BCA';

        // Reset errors
        document.querySelectorAll('.form-error').forEach(error => {
            error.classList.remove('show');
        });

        // Reset dropdown
        const dropdown = document.getElementById('bankDropdown');
        const menu = document.getElementById('bankDropdownMenu');
        dropdown.classList.remove('active');
        menu.classList.remove('show');
    }
}

// Initialize page animations
function initializePageAnimations() {
    const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
    elements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
    });
}

// Initialize bank selection
function initializeBankSelection() {
    // Set initial selected bank option
    document.querySelectorAll('.bank-option').forEach(option => {
        const bankName = option.querySelector('.bank-name').textContent;
        if (bankName === selectedBank) {
            option.classList.add('selected');
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('bankDropdown');
        const menu = document.getElementById('bankDropdownMenu');
        const arrow = dropdown ? dropdown.querySelector('.dropdown-arrow i') : null;

        if (dropdown && menu && !dropdown.contains(event.target) && !menu.contains(event.target)) {
            dropdown.classList.remove('active');
            menu.classList.remove('show');
            if (arrow) {
                arrow.style.transform = 'rotate(0deg)';
            }
        }
    });
}

// Initialize form validation
function initializeFormValidation() {
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.required && !this.value.trim()) {
                const errorElement = document.getElementById(this.id + 'Error');
                if (errorElement) {
                    errorElement.classList.add('show');
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

// Setup account number handling
function setupAccountNumberHandling() {
    const accountNumberInput = document.getElementById('accountNumber');
    if (accountNumberInput) {
        accountNumberInput.addEventListener('paste', function(e) {
            setTimeout(() => {
                formatAccountNumber(this);
            }, 10);
        });
    }
}

// Keyboard navigation for dropdown
function initializeKeyboardNavigation() {
    document.addEventListener('keydown', function(e) {
        const menu = document.getElementById('bankDropdownMenu');
        if (menu && menu.classList.contains('show')) {
            if (e.key === 'Escape') {
                toggleDropdown();
            } else if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                const options = menu.querySelectorAll('.bank-option');
                let currentIndex = Array.from(options).findIndex(option =>
                    option.classList.contains('selected'));

                if (e.key === 'ArrowDown') {
                    currentIndex = (currentIndex + 1) % options.length;
                } else {
                    currentIndex = currentIndex <= 0 ? options.length - 1 : currentIndex - 1;
                }

                options.forEach(option => option.classList.remove('selected'));
                options[currentIndex].classList.add('selected');
            } else if (e.key === 'Enter') {
                e.preventDefault();
                const selectedOption = menu.querySelector('.bank-option.selected');
                if (selectedOption) {
                    const bankName = selectedOption.querySelector('.bank-name').textContent;
                    selectBank(bankName, bankName);
                }
            }
        }
    });
}
