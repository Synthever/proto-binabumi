<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Rekening - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/profile/profile_changerekening.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/navigation-fixes.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="page-container">
        <div class="page-content slide-in-from-right">
            <div class="change-rekening-container">
        <!-- Header Section -->
        <div class="header-section fade-in">
            <button class="back-button" onclick="goBack()">
                <i class="fas fa-arrow-left"></i>
            </button>
            <h1 class="page-title">Rekening</h1>
        </div>

        <!-- Success Message -->
        <div class="success-message" id="successMessage">
            <i class="fas fa-check-circle"></i>
            <span>Data rekening berhasil disimpan!</span>
        </div>

        <!-- Main Content -->
        <div class="rekening-card fade-in-delayed">
            <form id="rekeningForm" onsubmit="handleSubmit(event)">
                <!-- Section Title -->
                <h2 class="section-title">Ubah Rekening</h2>
                
                <!-- Bank Selection -->
                <div class="form-group">
                    <label class="form-label">Ubah Bank</label>
                    <div class="bank-selection">
                        <div class="bank-dropdown" onclick="toggleDropdown()" id="bankDropdown">
                            <div class="bank-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="bank-info">
                                <p class="bank-name" id="selectedBankName">BCA</p>
                            </div>
                            <div class="dropdown-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        
                        <div class="dropdown-menu" id="bankDropdownMenu">
                            <div class="bank-option" onclick="selectBank('BCA', 'Bank Central Asia')">
                                <div class="bank-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="bank-info">
                                    <p class="bank-name">BCA</p>
                                </div>
                            </div>
                            <div class="bank-option" onclick="selectBank('BNI', 'Bank Negara Indonesia')">
                                <div class="bank-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="bank-info">
                                    <p class="bank-name">BNI</p>
                                </div>
                            </div>
                            <div class="bank-option" onclick="selectBank('BRI', 'Bank Rakyat Indonesia')">
                                <div class="bank-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="bank-info">
                                    <p class="bank-name">BRI</p>
                                </div>
                            </div>
                            <div class="bank-option" onclick="selectBank('Mandiri', 'Bank Mandiri')">
                                <div class="bank-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="bank-info">
                                    <p class="bank-name">Mandiri</p>
                                </div>
                            </div>
                            <div class="bank-option" onclick="selectBank('CIMB', 'CIMB Niaga')">
                                <div class="bank-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="bank-info">
                                    <p class="bank-name">CIMB</p>
                                </div>
                            </div>
                            <div class="bank-option" onclick="selectBank('Danamon', 'Bank Danamon')">
                                <div class="bank-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="bank-info">
                                    <p class="bank-name">Danamon</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Holder Name -->
                <div class="form-group">
                    <label class="form-label">Nama Pemilik Bank</label>
                    <input 
                        type="text" 
                        class="form-input" 
                        value="PAMELA TRI ANJANI" 
                        placeholder="Masukkan nama pemilik rekening"
                        id="accountName"
                        required
                        oninput="formatAccountName(this)"
                    >
                    <div class="form-error" id="accountNameError">
                        Nama pemilik rekening harus diisi
                    </div>
                </div>

                <!-- Account Number -->
                <div class="form-group">
                    <label class="form-label">No Rekening</label>
                    <div class="input-group">
                        <input 
                            type="text" 
                            class="form-input account-display" 
                            value="365 - 111 - 5657" 
                            placeholder="Masukkan nomor rekening"
                            id="accountNumber"
                            required
                            oninput="formatAccountNumber(this)"
                            maxlength="20"
                        >
                    </div>
                    <div class="form-error" id="accountNumberError">
                        Nomor rekening tidak valid
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
</div>
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/profile/navigation.js') }}"></script>
    <script src="{{ asset('js/profile/navigation-fixes.js') }}"></script>
    <script>
        let selectedBank = 'BCA';
        
        // Page initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Mark current page for navigation
            if (window.profileNavigator) {
                profileNavigator.currentPage = 'rekening';
            }
            
            // Initialize page animations
            const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
            
            // Set initial selected bank option
            document.querySelectorAll('.bank-option').forEach(option => {
                const bankName = option.querySelector('.bank-name').textContent;
                if (bankName === selectedBank) {
                    option.classList.add('selected');
                }
            });
            
            // Setup form validation
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
            
            // Account number paste handling
            const accountNumberInput = document.getElementById('accountNumber');
            if (accountNumberInput) {
                accountNumberInput.addEventListener('paste', function(e) {
                    setTimeout(() => {
                        formatAccountNumber(this);
                    }, 10);
                });
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
                handleSubmit({ preventDefault: () => {}, target: document.getElementById('rekeningForm') });
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

        // Add click animation effects and keyboard navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Click animation for buttons
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
        });

        // Keyboard navigation for dropdown
        document.addEventListener('keydown', function(e) {
            const menu = document.getElementById('bankDropdownMenu');
            if (menu && menu.classList.contains('show')) {
                const arrow = document.querySelector('#bankDropdown .dropdown-arrow i');
                
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
    </script>
</body>
</html>
