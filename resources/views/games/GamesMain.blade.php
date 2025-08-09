<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permainan - SIGMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/games/gamesMain.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
    <div class="container fade-in">
        <!-- Header -->
        <div class="header">
            <a href="{{ route('beranda') }}" class="back-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
            <h1>Permainan</h1>
            <a href="{{ route('beranda') }}" class="ranking-button">
                <i class="fas fa-trophy"></i>
            </a>
        </div>

        <!-- Konten Game -->
        <section class="game-wrapper">
            <div class="game-greeting">
                <h2>Hai Pamela!</h2>
                <p>Kumpulkan botol agar peliharaanmu berevolusi!</p>
            </div>

            <div class="pet-image">
                <img src="{{ asset('assets/images/games/Group 21837.png') }}" alt="Akira">
            </div>

            <h3 class="pet-name">Akira</h3>

            <div class="progress-container">
                <div class="progress-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="progress-info">
                    <p class="progress-title">Beri Akira tenaga</p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 76%;"></div>
                    </div>
                    <span class="progress-text">19/25 Botol</span>
                </div>
            </div>

            <button class="play-btn">Mainkan Tantangan!</button>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            anime({
                targets: '.game-wrapper',
                opacity: [0, 1],
                translateY: [30, 0],
                duration: 600,
                easing: 'easeOutQuart'
            });
        });
    </script>
</body>
</html>
