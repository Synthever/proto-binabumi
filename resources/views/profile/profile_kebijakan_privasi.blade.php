<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kebijakan Privasi - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/profile_kebijakan_privasi.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/profile/navigation-fixes.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Emergency CSS reset untuk konsistensi browser */
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            box-sizing: border-box !important;
            overflow-x: hidden !important;
        }
        
        .page-container, 
        .page-content, 
        .slide-in-from-right {
            width: 100% !important;
            box-sizing: border-box !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .kebijakan-privasi-container {
            width: 100% !important;
            max-width: 1024px !important;
            margin: 0 auto !important;
            box-sizing: border-box !important;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="page-container">
        <div class="page-content slide-in-from-right">
            <div class="kebijakan-privasi-container">
                <!-- Header Section -->
                <div class="header-section fade-in">
                    <button class="back-button" onclick="goBack()">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <h1 class="page-title">Kebijakan Privasi</h1>
                </div>

                <!-- Main Content -->
                <div class="privacy-card fade-in-delayed">
                    <!-- Header dengan Icon -->
                    <div class="privacy-header">
                        <div class="privacy-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <h2 class="privacy-title">Kebijakan Privasi Bina Bumi</h2>
                            <p class="privacy-subtitle">Terakhir diperbarui: 2 Agustus 2025</p>
                        </div>
                    </div>

                    <!-- Intro Paragraph -->
                    <div class="privacy-content">
                        <p class="privacy-paragraph">
                            Bina Bumi berkomitmen untuk menjaga dan melindungi privasi data pribadi pengguna. Kebijakan
                            ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi
                            informasi pribadi pengguna saat menggunakan aplikasi.
                        </p>
                    </div>

                    <!-- Section 1: Informasi yang Kami Kumpulkan -->
                    <div class="privacy-section">
                        <h3 class="section-title">
                            <span class="section-number">1</span>
                            Informasi yang Kami Kumpulkan
                        </h3>

                        <p class="privacy-paragraph">
                            Kami dapat mengumpulkan informasi berikut:
                        </p>

                        <ul class="info-list">
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Nomor telepon (WhatsApp)</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Lokasi</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Riwayat donasi dan penjuatan botol</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Upload gambar pengelola (jenis perangkat, sistem operasi)</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Section 2: Cara Kami Menggunakan Informasi -->
                    <div class="privacy-section">
                        <h3 class="section-title">
                            <span class="section-number">2</span>
                            Cara Kami Menggunakan Informasi
                        </h3>

                        <p class="privacy-paragraph">
                            Informasi dikumpulkan dan digunakan untuk:
                        </p>

                        <ul class="info-list">
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Verifikasi identitas pengguna</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Memproses transaksi dan pengelaan botol</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Mengirimkan notifikasi dan bukti transaksi melalui WhatsApp</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Memberikan pengalaman aplikasi yang lebih personal</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Meningkatkan sistem keamanan dan performa layanan</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Section 3: Penyimpanan dan Keamanan Data -->
                    <div class="privacy-section">
                        <h3 class="section-title">
                            <span class="section-number">3</span>
                            Penyimpanan dan Keamanan Data
                        </h3>

                        <p class="privacy-paragraph">
                            Kami menggunakan sistem keamanan yang sesuai standar industri untuk melindungi informasi
                            Anda dari akses, penggunaan, atau pengungkapan tanpa izin.
                        </p>

                        <div class="highlight-box">
                            <h4 class="highlight-title">
                                <i class="fas fa-shield-alt"></i>
                                Keamanan Data
                            </h4>
                            <p class="highlight-text">
                                Data Anda disimpan dengan enkripsi tingkat tinggi dan hanya dapat diakses oleh personel
                                yang berwenang untuk keperluan operasional aplikasi.
                            </p>
                        </div>
                    </div>

                    <!-- Section 4: Berbagi Informasi -->
                    <div class="privacy-section">
                        <h3 class="section-title">
                            <span class="section-number">4</span>
                            Berbagi Informasi
                        </h3>

                        <p class="privacy-paragraph">
                            Kami tidak membagikan informasi pribadi kepada pihak ketiga tanpa persetujuan Anda, kecuali
                            yang diwajibkan oleh hukum atau untuk keperluan layanan (misalnya pengiriman notifikasi).
                        </p>
                    </div>

                    <!-- Section 5: Hak Pengguna -->
                    <div class="privacy-section">
                        <h3 class="section-title">
                            <span class="section-number">5</span>
                            Hak Pengguna
                        </h3>

                        <p class="privacy-paragraph">
                            Anda berhak untuk:
                        </p>

                        <ul class="info-list">
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Mengakses dan meminta informasi pribadi</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Meminta koreksi data yang tidak akurat</span>
                            </li>
                            <li class="info-item">
                                <span class="info-bullet"></span>
                                <span>Meminta penghapusan data pribadi</span>
                            </li>
                        </ul>

                        <p class="privacy-paragraph">
                            Untuk permintaan khusus terkait data, silakan hubungi kami melalui email resmi.
                        </p>
                    </div>

                    <!-- Contact Information -->
                    <div class="contact-info">
                        <h4 class="contact-title">
                            <i class="fas fa-envelope"></i>
                            Hubungi Kami
                        </h4>
                        <p class="contact-text">
                            Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini atau ingin menggunakan hak-hak
                            Anda terkait data pribadi, silakan hubungi kami di
                            <a href="mailto:privacy@binabumi.com" class="email-link">privacy@binabumi.com</a>
                        </p>
                    </div>

                    <!-- Last Updated -->
                    <div class="last-updated">
                        <p class="last-updated-text">
                            Kebijakan ini terakhir diperbarui pada 2 Agustus 2025 dan dapat berubah sewaktu-waktu sesuai
                            perkembangan layanan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Scripts -->
        <!-- Scripts -->
        <script src="{{ asset('/assets/js/profile/navigation-utils.js') }}"></script>
        <script src="{{ asset('/assets/js/profile/profile_kebijakan_privasi.js') }}"></script>
</body>

</html>
