<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ubah Rekening - SIGMA</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/profile_changerekening.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/components/back-button.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation-fixes.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            box-sizing: border-box !important;
            overflow-x: hidden !important;
        }
        .page-container, .page-content, .slide-in-from-right {
            width: 100% !important;
            box-sizing: border-box !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .change-rekening-container {
            width: 100% !important;
            max-width: 1024px !important;
            margin: 0 auto !important;
            box-sizing: border-box !important;
        }
    </style>
</head>
<body style="background: #fff; min-height: 100vh; margin:0;">
    <div style="max-width:1024px; margin:0 auto; width:100%; min-height: 100vh; box-shadow: 0 0 20px rgba(0,0,0,0.10); background: #fff; padding: 20px;">
        <div class="header" style="display: flex; align-items: center; padding: 16px 0; background: #fff; border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 10; margin-bottom: 24px;">
            <x-back-button href="/profile" />
            <h1 style="font-size: 18px; font-weight: 700; color: #193D29; opacity: 0.7; padding-left: 16px;">Rekening</h1>
        </div>
        <!-- Success Message -->
        <div class="success-message" id="successMessage" style="display:none;">
            <i class="fas fa-check-circle"></i>
            <span>Data rekening berhasil disimpan!</span>
        </div>
        <!-- Main Content -->
    <div class="rekening-card fade-in-delayed" style="border: 1px solid #e2e8f0; box-shadow: none; border-radius: 24px; padding: 32px; margin-bottom: 24px; position: relative; background: #fff;">
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
                            <input type="text" class="form-input" value="PAMELA TRI ANJANI"
                                placeholder="Masukkan nama pemilik rekening" id="accountName" required
                                oninput="formatAccountName(this)">
                            <div class="form-error" id="accountNameError">
                                Nama pemilik rekening harus diisi
                            </div>
                        </div>

                        <!-- Account Number -->
                        <div class="form-group">
                            <label class="form-label">No Rekening</label>
                            <div class="input-group">
                                <input type="text" class="form-input account-display" value="365 - 111 - 5657"
                                    placeholder="Masukkan nomor rekening" id="accountNumber" required
                                    oninput="formatAccountNumber(this)" maxlength="20">
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
    <script src="{{ asset('/assets/js/profile/navigation-utils.js') }}"></script>
    <script src="{{ asset('/assets/js/profile/profile_changerekening.js') }}"></script>
</body>

</html>
