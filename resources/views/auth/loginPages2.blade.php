<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in with Google - SIGMA</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/auth/loginPages2.css') }}">
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
            // Header slide in animation
            anime({
                targets: '.oauth-header',
                translateY: [-60, 0],
                opacity: [0, 1],
                duration: 800,
                easing: 'easeOutQuart',
                delay: 100
            });

            // App logo bounce animation
            anime({
                targets: '.app-logo',
                scale: [0.3, 1.1, 1],
                rotate: [0, 360],
                opacity: [0, 1],
                duration: 1200,
                easing: 'easeOutElastic(1, .6)',
                delay: 300
            });

            // Main title section animation
            anime({
                targets: '.permission-title',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: 800
            });

            // User info animation
            anime({
                targets: '.user-info',
                translateY: [40, 0],
                opacity: [0, 1],
                duration: 700,
                easing: 'easeOutQuart',
                delay: 1000
            });

            // Permission section stagger animation
            anime({
                targets: '.permission-section > *',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 500,
                easing: 'easeOutQuart',
                delay: anime.stagger(100, {start: 1200})
            });

            // Action buttons stagger animation
            anime({
                targets: '.action-buttons .btn',
                scale: [0.8, 1],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutBack',
                delay: anime.stagger(150, {start: 1800})
            });

            // Continuous logo subtle animation
            anime({
                targets: '.app-logo',
                rotate: [0, 3, 0, -3, 0],
                duration: 4000,
                easing: 'easeInOutSine',
                loop: true,
                delay: 2500
            });

            // Button hover animations
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    anime({
                        targets: this,
                        scale: 1.02,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                btn.addEventListener('mouseleave', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                btn.addEventListener('click', function() {
                    anime({
                        targets: this,
                        scale: [1, 0.98, 1],
                        duration: 150,
                        easing: 'easeOutQuart'
                    });
                });
            });

            // Back button hover animation
            const backBtn = document.querySelector('.back-btn');
            if (backBtn) {
                backBtn.addEventListener('mouseenter', function() {
                    anime({
                        targets: this,
                        scale: 1.1,
                        rotate: -5,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                backBtn.addEventListener('mouseleave', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        rotate: 0,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });
            }

            // Links hover animation
            const links = document.querySelectorAll('.permission-link');
            links.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    anime({
                        targets: this,
                        scale: 1.05,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                link.addEventListener('mouseleave', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });
            });

            // Gmail icon pulse animation
            anime({
                targets: '.gmail-icon',
                scale: [1, 1.05, 1],
                duration: 2000,
                easing: 'easeInOutSine',
                direction: 'alternate',
                loop: true,
                delay: 3000
            });
        });
    </script>
</head>

<body class="oauth-container">
    <!-- Header with Back Button -->
    <div class="oauth-header">
        <button class="back-btn" onclick="location.href='{{ url()->previous() }}'">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <div class="header-content">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="google-logo" />
            <h1 class="header-title">Sign in with Google</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- App Logo -->
        <div class="app-logo-container">
            <img src="/assets/images/halaman-awal/logo.png" alt="SIGMA Logo" class="app-logo" />
        </div>

        <!-- Permission Title -->
        <div class="permission-title">
            <h2 class="main-title"><strong style="color: #204E34;">SIGMA</strong> wants to access your Google Account</h2>
        </div>

        <!-- User Info -->
        <div class="user-info">
            <div class="user-avatar">
                <img src="/assets/images/logo.png" alt="User Avatar" class="user-avatar-img" />
            </div>
            <p class="user-email">binabumi@gmail.com</p>
        </div>

        <!-- Permission Details -->
        <div class="permission-section">
            <h3 class="permission-heading">This will allow SIGMA to :</h3>
            
            <div class="permission-item">
                <div class="gmail-icon">
                    <img src="/assets/images/auth/gmail.png" alt="Gmail" class="gmail-icon-img" />
                </div>
                <div class="permission-text">
                    <p class="permission-description">Allow others to discover your Gamer ID using your email or name</p>
                    <button class="info-btn">
                        <img src="/assets/images/auth/icon-i.png" alt="Info" style="width: 16px; height: 16px;" />
                    </button>
                </div>
            </div>

            <!-- Trust Message -->
            <div class="trust-section">
                <h3 class="trust-title">Make sure that you trust <strong>SIGMA</strong></h3>
                <p class="trust-description">
                    You may be sharing sensitive info with this site or app. 
                    You can always see or remove access in your 
                    <a href="#" class="permission-link">Google Account</a>.
                </p>
                <p class="trust-description">
                    Learn how Google helps you 
                    <a href="#" class="permission-link">share data safely</a>.
                </p>
                <p class="trust-description">
                    See Playoff's 
                    <a href="#" class="permission-link">privacy policy</a> 
                    and 
                    <a href="#" class="permission-link">Terms of Service</a>.
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn btn-cancel" onclick="location.href='{{ url()->previous() }}'">Cancel</button>
            <button class="btn btn-allow" onclick="alert('Allow clicked')">Allow</button>
        </div>
    </div>
</body>

</html>
