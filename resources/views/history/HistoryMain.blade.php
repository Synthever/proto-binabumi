<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Anda - SIGMA</title>
    <link rel="stylesheet" href="{{ asset('css/history/historyMain.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <div class="header">
        <h1 class="title">History</h1>
    </div>

    <!-- Search -->
    <div class="search-box">
        <input 
            type="text" 
            placeholder="Cari riwayat transaksi" 
            class="search-input"
        >
    </div>

    <!-- List Riwayat -->
    <div class="history-list">
        <!-- Item -->
        <div>
            <a href="{{ route('history_detail-transaksi', ['id' => 1]) }}" class="history-item">
                <div>
                    <p class="item-date">10/01/2025</p>
                    <p class="item-title">Transfer ke ATM BCA</p>
                    <p class="item-name">PAMELA TRI ANJANI</p>
                </div>
                <div class="item-right">
                    <span class="status status-proses">Proses</span>
                    <p class="item-amount">Rp 20.000</p>
                </div>
            </a>
        </div>

        <div>
            <a href="{{ route('history_detail-transaksi-2', ['id' => 2]) }}" class="history-item">
                <div>
                    <p class="item-date">03/01/2025</p>
                    <p class="item-title">Transfer ke Shopeepay</p>
                    <p class="item-name">SUKMAWATI</p>
                </div>
                <div class="item-right">
                    <span class="status status-ditolak">Di Tolak</span>
                    <p class="item-amount">Rp 5.000</p>
                </div>
            </a>
        </div>

        <div>
            <a href="{{ route('history_detail-transaksi-3', ['id' => 3]) }}" class="history-item">
                <div>
                    <p class="item-date">23/12/2024</p>
                    <p class="item-title">Transfer ke DANA</p>
                    <p class="item-name">ANISA RAHMAWATI</p>
                </div>
                <div class="item-right">
                    <span class="status status-selesai">Selesai</span>
                    <p class="item-amount">Rp 10.000</p>
                </div>
            </a>
        </div>

        <div>
            <a href="{{ route('history_detail-transaksi-4', ['id' => 4]) }}" class="history-item">
                <div>
                    <p class="item-date">15/12/2024</p>
                    <p class="item-title">Transfer ke ATM BCA</p>
                    <p class="item-name">PAMELA TRI ANJANI</p>
                </div>
                <div class="item-right">
                    <span class="status status-selesai">Selesai</span>
                    <p class="item-amount">Rp 8.000</p>
                </div>
            </a>
        </div>

        <div>
            <a href="{{ route('history_detail-transaksi-5', ['id' => 5]) }}" class="history-item">
                <div>
                    <p class="item-date">7/12/2024</p>
                    <p class="item-title">Transfer ke DANA</p>
                    <p class="item-name">PAMELA TRI ANJANI</p>
                </div>
                <div class="item-right">
                    <span class="status status-selesai">Selesai</span>
                    <p class="item-amount">Rp 9.000</p>
                </div>
            </a>
        </div>

        <div>
            <a href="{{ route('history_detail-transaksi-6', ['id' => 6]) }}" class="history-item">
                <div>
                    <p class="item-date">29/11/2024</p>
                    <p class="item-title">Transfer ke DANA</p>
                    <p class="item-name">PAMELA TRI ANJANI</p>
                </div>
                <div class="item-right">
                    <span class="status status-selesai">Selesai</span>
                    <p class="item-amount">Rp 13.000</p>
                </div>
            </a>
        </div>
    </div>

</body>
</html>
