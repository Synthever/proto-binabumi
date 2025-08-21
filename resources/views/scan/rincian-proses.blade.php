<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Proses Scan Botol | SIGMA</title>
    <link rel="stylesheet" href="{{ asset('assets/css/scan/rincian-proses.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <x-header title="Proses Scan Botol" :sticky="true" />
    <div class="rincian-container">
        <div class="proses-info">
            <h2>Masukkan Botol ke Mesin RVM</h2>
            <p>Silakan masukkan botol plastik ke dalam mesin RVM sesuai instruksi di layar mesin.</p>
        </div>
        <div class="proses-status">
            <div class="status-icon loading"></div>
            <p class="status-text">Menunggu botol dimasukkan...</p>
        </div>
        <div class="proses-detail">
            <ul>
                <li>Scan berhasil: <span class="success">Ya</span></li>
                <li>Mesin: <span class="machine">RVM-01</span></li>
                <li>Waktu: <span class="time">{{ date('d/m/Y H:i') }}</span></li>
            </ul>
        </div>
    </div>
</body>
</html>
