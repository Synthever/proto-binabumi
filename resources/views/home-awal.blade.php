<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGMA - Smart Integrated Gathering Machine</title>
    <link rel="stylesheet" href="{{ asset('assets/css/home-awal.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
    <!-- Container -->
    <div class="main-container">
        
        <!-- Splash 1 - Logo Only -->
        <section id="splash-1" class="splash-section active">
            <div class="splash-content">
                <div class="logo-container">
                    <div class="logo-circle">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="SIGMA Logo" class="main-logo">
                    </div>
                </div>
            </div>
        </section>

        <!-- Splash 2 - Logo + Title -->
        <section id="splash-2" class="splash-section">
            <div class="splash-content">
                <div class="logo-container">
                    <div class="logo-circle">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="SIGMA Logo" class="main-logo">
                    </div>
                </div>
                <div class="title-container">
                    <h1 class="app-title">SIGMA</h1>
                    <p class="app-subtitle">Smart Integrated<br>Gathering Machine</p>
                </div>
            </div>
        </section>

        <!-- Splash 3 - Welcome Page -->
        <section id="splash-3" class="splash-section welcome-section">
            <div class="background-grid">
                <div class="grid-item"></div>
                <div class="grid-item"></div>
                <div class="grid-item"></div>
                <div class="grid-item"></div>
                <div class="grid-item"></div>
                <div class="grid-item"></div>
            </div>
            <div class="welcome-overlay"></div>
            <div class="welcome-content">
                <div class="welcome-text">
                    <h2 class="welcome-title">Transformasi<br>Pengelolaan Sampah<br>Plastik di Indonesia</h2>
                    <p class="welcome-description">
                        Tukar botol plastikmu jadi E-Money dengan SIGMA, langkah kecil untuk Indonesia bersih bernilai.
                    </p>
                    <button class="start-button" onclick="startApp()">
                        Mulai
                    </button>
                </div>
            </div>
        </section>

    </div>

    <script>
        // Auto transition between splash screens
        let currentSplash = 1;

        // Transition to splash 2
        setTimeout(() => {
            document.getElementById('splash-1').classList.remove('active');
            document.getElementById('splash-2').classList.add('active');
            currentSplash = 2;
            
            // Animate title appearance
            anime({
                targets: '.app-title',
                opacity: [0, 1],
                translateY: [30, 0],
                duration: 800,
                easing: 'easeOutExpo'
            });
            
            anime({
                targets: '.app-subtitle',
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 800,
                delay: 300,
                easing: 'easeOutExpo'
            });
        }, 2500);

        // Transition to welcome page
        setTimeout(() => {
            document.getElementById('splash-2').classList.remove('active');
            document.getElementById('splash-3').classList.add('active');
            currentSplash = 3;
            
            // Animate welcome content
            anime({
                targets: '.welcome-text',
                opacity: [0, 1],
                translateY: [40, 0],
                duration: 1000,
                easing: 'easeOutExpo'
            });
            
            anime({
                targets: '.background-grid .grid-item',
                opacity: [0, 1],
                scale: [0.9, 1],
                duration: 800,
                delay: anime.stagger(100),
                easing: 'easeOutExpo'
            });
        }, 5000);

        // Start app function
        function startApp() {
            // Add loading animation
            const button = document.querySelector('.start-button');
            button.innerHTML = '<div class="button-spinner"></div>';
            button.disabled = true;
            
            // Redirect after animation
            setTimeout(() => {
                window.location.href = '{{ route("login") }}';
            }, 1000);
        }

        // Prevent manual navigation during splash sequence
        document.addEventListener('click', (e) => {
            if (currentSplash < 3 && !e.target.classList.contains('start-button')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
