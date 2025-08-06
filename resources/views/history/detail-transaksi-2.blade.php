<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css/history/detail-transaksi-2.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <div class="container">
        <!-- Header with back button -->
        <div class="header">
            <a href="{{ route('history.index') }}" class="back-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
            <h1>Detail Transaksi</h1>
        </div>

        <!-- Status Section -->
        <div class="status-section">
            <div class="status-icon">
                <i class="fas fa-clock fa-2x" style="color: #920807;"></i>
            </div>

            <h2 class="status-title">Penarikan Ditolak</h2>
            <p class="status-description">Penarikan koin kamu tidak dapat diproses saat ini. Coba lagi beberapa saat lagi.</p>
            <div class="amount">Rp 5.000</div>
        </div>

        <!-- Transaction Information -->
        <div class="transaction-card">
            <div class="transaction-detail">
                <h3>Tujuan Penarikan :</h3>
                <div class="bank-info">
                    <div class="bank-icon">S</div>
                    <div class="bank-details">
                        <div class="bank-name">Shopeepay - 0857****1234</div>
                        <div class="account-name">Sukmawati</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Transaction Details -->
        <div class="transaction-card">
            <div class="transaction-detail">
                <h3>Tanggal Penarikan :</h3>
                <p>3 Januari 2025</p>
            </div>

            <div class="transaction-detail">
                <h3>Jumlah Koin :</h3>
                <p>500 Koin</p>
            </div>

            <div class="transaction-detail">
                <h3>Waktu Transaksi :</h3>
                <p>17:00 WIB</p>
            </div>
        </div>
</body>
</html>