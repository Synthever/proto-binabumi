<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
    <title>SIGMA - Transformasi Pengelolaan Sampah Plastik</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
        // Force scroll to top on page load/refresh
        window.addEventListener('beforeunload', function() {
            window.scrollTo(0, 0);
        });

        // Ensure page starts from top
        if (history.scrollRestoration) {
            history.scrollRestoration = 'manual';
        }

        window.addEventListener('load', function() {
            setTimeout(() => {
                window.scrollTo(0, 0);
            }, 0);
        });

        // Initialize animations when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Title section animation
            anime({
                targets: '.title-section',
                translateY: [50, 0],
                opacity: [0, 1],
                duration: 800,
                easing: 'easeOutQuart',
                delay: 200
            });

            // Welcome card animation
            anime({
                targets: '.welcome-card',
                translateY: [100, 0],
                scale: [0.8, 1],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutBack',
                delay: 600
            });

            // Button hover animation
            const startBtn = document.querySelector('.start-button');
            if (startBtn) {
                startBtn.addEventListener('mouseenter', function() {
                    anime({
                        targets: this,
                        scale: 1.05,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                startBtn.addEventListener('mouseleave', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });
            }
        });
    </script>
</head>

<body class="welcome-container">
    <!-- Background Grid Pattern -->
    <div class="background-grid">
        <div class="grid-item grid-1"></div>
        <div class="grid-item grid-2"></div>
        <div class="grid-item grid-3"></div>
        <div class="grid-item grid-4"></div>
        <div class="grid-item grid-5"></div>
        <div class="grid-item grid-6"></div>
    </div>
    
    <!-- Overlay for content readability -->
    <div class="content-overlay"></div>

    <div class="main-content">
        <!-- Title Section -->
        <div class="title-section">
            <h1 class="main-title">Transformasi<br>Pengelolaan Sampah<br>Plastik di Indonesia</h1>
            <p class="subtitle">Bina Bumi menghadirkan solusi inovatif melalui mesin pintar SIGMA yang mengubah botol plastik menjadi E-Money, untuk Indonesia yang lebih bersih dan bermilai.</p>
        </div>

        <!-- Start Button -->
        <div class="button-section">
            <form action="{{ route('welcome.start') }}" method="POST">
                @csrf
                <button type="submit" class="start-button">
                    <span>Mulai</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Loading animation for smooth transition -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Memuat...</p>
        </div>
    </div>

    <script>
        document.querySelector('.start-button').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show loading animation
            document.getElementById('loadingOverlay').classList.add('show');
            
            // Submit form after short delay for smooth animation
            setTimeout(() => {
                this.closest('form').submit();
            }, 500);
        });

        // Initialize animations when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Background grid animation
            anime({
                targets: '.grid-item',
                opacity: [0, 1],
                scale: [0.8, 1],
                duration: 1000,
                easing: 'easeOutQuart',
                delay: anime.stagger(100)
            });

            // Title section animation
            anime({
                targets: '.title-section',
                translateY: [50, 0],
                opacity: [0, 1],
                duration: 800,
                easing: 'easeOutQuart',
                delay: 300
            });

            // Button animation
            anime({
                targets: '.button-section',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: 800
            });
        });
    </script>
</body>
</html>
