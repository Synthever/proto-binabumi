<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" />
    <title>Scan Berhasil | SIGMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/scan/scan-success.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="mobile-container">
        <!-- Profile Header Component - MOVED OUTSIDE ALL CONTAINERS -->
    <x-header title="Scan" :sticky="true" />

        <!-- Main Content Container -->
        <div class="content-wrapper">
            <!-- Main Content -->
            <div class="main-content">
                <!-- Illustration -->
                <div class="illustration-container">
                    <img src="{{ asset('assets/images/scan/component_scan.png') }}" alt="Scan Success" class="scan-illustration">
                </div>

                <!-- Content Text -->
                <div class="content-section">
                    <h2 class="main-title">Masukkan Botol ke Mesin</h2>
                    <p class="description">
                        Masukkan satu per satu botol plastik kosong ke dalam lubang mesin. Pastikan botol dalam kondisi bersih dan tidak penyok.
                    </p>
                </div>

                <!-- Loading Circle -->
                <div class="loading-container">
                    <div class="loading-circle" style="
                        width: 48px;
                        height: 48px;
                        border: 4px solid #E5E5E5;
                        border-top: 4px solid #193D29;
                        border-radius: 50%;
                        animation: loading-rotate 1s linear infinite;
                        margin: 0 auto;
                    "></div>
                    <div class="countdown-timer">
                        <span id="countdown">00:30</span>
                    </div>
                </div>

                <style>
                @keyframes loading-rotate {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
                </style>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    @include('components.bottom-nav', ['active' => 'scan'])

    <script>
        // Initialize animations when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Fade in main container
            anime({
                targets: '.mobile-container',
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuad'
            });

            // Animate illustration
            anime({
                targets: '.scan-illustration',
                scale: [0.8, 1],
                opacity: [0, 1],
                duration: 800,
                delay: 300,
                easing: 'easeOutBack'
            });

            // Animate content
            anime({
                targets: '.content-section',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                delay: 500,
                easing: 'easeOutQuad'
            });

            // Animate loading circle
            anime({
                targets: '.loading-circle',
                scale: [0.5, 1],
                opacity: [0, 1],
                duration: 800,
                delay: 700,
                easing: 'easeOutBack'
            });

            // Animate countdown
            anime({
                targets: '.countdown-timer',
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 600,
                delay: 1000,
                easing: 'easeOutQuad'
            });

            // Start countdown (loading animation uses CSS)
            setTimeout(() => {
                startCountdown();
            }, 1000);
        });

        function startCountdown() {
            let timeLeft = 30;
            const countdownElement = document.getElementById('countdown');
            
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const remainingSeconds = seconds % 60;
                return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
            }
            
            const timer = setInterval(function() {
                timeLeft--;
                countdownElement.textContent = formatTime(timeLeft);
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    // Auto redirect atau action lainnya setelah countdown selesai
                    console.log('Countdown finished');
                }
            }, 1000);
        }
    </script>
</body>

</html>
