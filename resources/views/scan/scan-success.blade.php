<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
    <title>Scan Berhasil | SIGMA</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/scan/scan-success.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="scan-success-container">
        <!-- Header -->
        @include('components.header', [
            'title' => 'Scan',
            'sticky' => true
        ])

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
        </div>
    </div>

    <!-- Bottom Navigation -->
    @include('components.bottom-nav', ['active' => 'scan'])

    <script>
        // Initialize animations when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Fade in main container
            anime({
                targets: '.scan-success-container',
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

            // Animate progress circle
            anime({
                targets: '.progress-circle',
                scale: [0.5, 1],
                opacity: [0, 1],
                duration: 800,
                delay: 700,
                easing: 'easeOutBack'
            });

            // Animate buttons
            anime({
                targets: '.action-buttons button',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 500,
                delay: anime.stagger(100, {start: 900}),
                easing: 'easeOutQuad'
            });

            // Progress bar animation
            setTimeout(() => {
                animateProgress();
            }, 1000);
        });

        function animateProgress() {
            anime({
                targets: '.progress-bar',
                strokeDashoffset: [314, 0],
                duration: 2000,
                easing: 'easeInOutQuad'
            });

            // Counter animation
            anime({
                targets: '.points',
                innerHTML: [0, 100],
                duration: 2000,
                round: 1,
                easing: 'easeInOutQuad'
            });
        }

        function continueScan() {
            // Add button animation
            anime({
                targets: '.btn-primary',
                scale: [1, 0.95, 1],
                duration: 200,
                complete: function() {
                    // Redirect to scan page
                    window.location.href = '/scan';
                }
            });
        }

        function goHome() {
            // Add button animation
            anime({
                targets: '.btn-secondary',
                scale: [1, 0.95, 1],
                duration: 200,
                complete: function() {
                    // Redirect to home page
                    window.location.href = '/beranda';
                }
            });
        }

        // Back button functionality
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
