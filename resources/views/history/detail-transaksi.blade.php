<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css/history/detail-transaksi.css') }}">
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
                <i class="fas fa-clock fa-2x" style="color: #92400e;"></i>
            </div>

            <h2 class="status-title">Sedang Diproses</h2>
            <p class="status-description">Penarikan koin kamu sedang diproses dan menunggu konfirmasi dari sistem.</p>
            <div class="amount">Rp 20.000</div>
        </div>

        <!-- Transaction Information -->
        <div class="transaction-card">
            <div class="transaction-detail">
                <h3>Tujuan Penarikan :</h3>
                <div class="bank-info">
                    <div class="bank-icon">P</div>
                    <div class="bank-details">
                        <div class="bank-name">Bank BCA - 365 - 111 - 5657</div>
                        <div class="account-name">Pamela Tri Anjani</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Transaction Details -->
        <div class="transaction-card">
            <div class="transaction-detail">
                <h3>Tanggal Penarikan :</h3>
                <p>10 Januari 2025</p>
            </div>

            <div class="transaction-detail">
                <h3>Jumlah Koin :</h3>
                <p>2000 Koin</p>
            </div>

            <div class="transaction-detail">
                <h3>Waktu Transaksi :</h3>
                <p>15:30 WIB</p>
            </div>
        </div>

        <!-- Download Button -->
        <button class="download-button" id="downloadButton">Unduh Bukti Transfer</button>
        <div id="warningMessage" class="warning-message fade-in">Bukti transfer bisa diunduh setelah transaksi berhasil.</div>
    </div>
    <script>
    document.getElementById("downloadButton").addEventListener("click", function () {
        const status = document.querySelector(".status-title").textContent.trim();
        const message = document.getElementById("warningMessage");

        if (status === "Sedang Diproses") {
        message.classList.add("show");
        } else {
        // window.location.href = '/path/to/file.pdf';
        }
    });
    </script>
</body>
</html>