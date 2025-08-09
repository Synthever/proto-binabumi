<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tantangan - SIGMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/games/challenge.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
    <div class="container fade-in">
        <!-- Header -->
        <div class="header">
            <a href="{{ route('games.index') }}" class="back-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
            <h1>Permainan</h1>
            <a href="{{ route('games.index') }}" class="ranking-button">
                <i class="fas fa-trophy"></i>
            </a>
        </div>

        <!-- Konten Tantangan -->
        <section class="challenge-wrapper">
            <div class="challenge-image">
                <img src="{{ asset('assets/images/games/image.png') }}" alt="Tantangan">
            </div>

            <h2 class="challenge-title">Tantangan</h2>
            <p class="challenge-subtitle">Selesaikan tantangan untuk dapatkan reward!</p>

            <div class="level-buttons">
                <button class="level-btn active" data-level="1">1</button>
                <button class="level-btn" data-level="2">2</button>
                <button class="level-btn" data-level="3">3</button>
                <button class="level-btn" data-level="4">4</button>
                <button class="level-btn" data-level="5">5</button>
                <button class="level-btn" data-level="6">6</button>
                <button class="level-btn" data-level="7">7</button>
                <button class="level-btn" data-level="8">8</button>
            </div>

            <div id="challenge-list">
                <!-- Konten tantangan akan muncul di sini -->
            </div>

        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            anime({
                targets: '.challenge-wrapper',
                opacity: [0, 1],
                translateY: [30, 0],
                duration: 600,
                easing: 'easeOutQuart'
            });
        });

        // Path ikon diambil dari Laravel supaya aman
        const iconPath = "{{ asset('assets/images/games/Group 21838.png') }}";

        const challenges = {
            1: [
                { title: "Kumpulkan 25 botol", progress: 17, total: 25 },
                { title: "Tukar botol 3 hari berturut-turut", progress: 2, total: 3 }
            ],
            2: [
                { title: "Tukar 50 botol", progress: 10, total: 50 },
                { title: "Tukar botol 5 hari berturut-turut", progress: 1, total: 5 }
            ]
            // Tambahkan untuk level lain
        };

        function renderChallenges(level) {
            const container = document.getElementById("challenge-list");
            container.innerHTML = challenges[level].map(ch => `
                <div class="challenge-card">
                    <div class="challenge-icon">
                        <img src="${iconPath}" width="24" alt="Icon">
                    </div>
                    <div class="challenge-content">
                        <div class="challenge-title">${ch.title}</div>
                        <div>${ch.progress}/${ch.total}</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:${(ch.progress/ch.total)*100}%"></div>
                        </div>
                    </div>
                </div>
            `).join("");
        }

        document.querySelectorAll(".level-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll(".level-btn").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                renderChallenges(btn.dataset.level);
            });
        });

        // Default load level 1
        renderChallenges(1);
    </script>
</body>
</html>
