<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in with Google - SIGMA</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/auth/loginPages1.css') }}">
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

            // App logo bounce animation - fixed mirror issue
            anime({
                targets: '.app-logo',
                scale: [0.2, 1.2, 1],
                rotate: [0, 0],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutBounce',
                delay: 300
            });

            // App title section animation
            anime({
                targets: '.app-title-section',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: 800
            });

            // Account list items stagger animation
            anime({
                targets: '.account-item',
                translateX: [100, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: anime.stagger(150, {start: 1000})
            });

            // Privacy notice fade in
            anime({
                targets: '.privacy-notice',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 500,
                easing: 'easeOutQuart',
                delay: 1600
            });

            // Language selector animation
            anime({
                targets: '.language-selector',
                scale: [0.8, 1],
                opacity: [0, 1],
                duration: 400,
                easing: 'easeOutQuart',
                delay: 1800
            });

            // Footer links stagger animation
            anime({
                targets: '.footer-link',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 400,
                easing: 'easeOutQuart',
                delay: anime.stagger(100, {start: 2000})
            });

            // Continuous subtle logo rotation - gentler version
            anime({
                targets: '.app-logo',
                rotate: [0, 2, 0, -2, 0],
                duration: 4000,
                easing: 'easeInOutSine',
                loop: true,
                delay: 2500
            });

            // Account item hover animations
            const accountItems = document.querySelectorAll('.account-item');
            accountItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    anime({
                        targets: this,
                        scale: 1.02,
                        translateX: 5,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                    
                    // Avatar pulse animation
                    const avatar = this.querySelector('.account-avatar');
                    if (avatar) {
                        anime({
                            targets: avatar,
                            scale: [1, 1.1, 1],
                            duration: 300,
                            easing: 'easeOutQuart'
                        });
                    }
                });

                item.addEventListener('mouseleave', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        translateX: 0,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                // Click animation
                item.addEventListener('click', function() {
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

            // Privacy links hover animation
            const privacyLinks = document.querySelectorAll('.privacy-link, .footer-link');
            privacyLinks.forEach(link => {
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

            // Floating animation for account avatars
            anime({
                targets: '.account-avatar',
                translateY: [-2, 2],
                duration: 2000,
                easing: 'easeInOutSine',
                direction: 'alternate',
                loop: true,
                delay: anime.stagger(300, {start: 3000})
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
        <!-- App Logo and Title -->
        <div class="app-info">
            <div class="app-logo-container">
                <img src="/assets/images/halaman-awal/logo.png" alt="SIGMA Logo" class="app-logo" />
            </div>
            <div class="app-title-section">
                <h2 class="app-title">Choose an account</h2>
                <p class="app-subtitle">to continue to <strong style="color: #2D5A3A;">SIGMA</strong></p>
            </div>
        </div>

        <!-- Account Selection -->
        <div class="account-list" onclick="location.href='/login/google/step1'">
            <!-- Account 1 -->
            <div class="account-item">
                <div class="account-avatar">
                    <img src="/assets/images/halaman-awal/logo.png" alt="SIGMA Logo" class="avatar-logo" />
                </div>
                <div class="account-info">
                    <h3 class="account-name">Bina Bumi</h3>
                    <p class="account-email">binabumi@gmail.com</p>
                </div>
            </div>

            <!-- Use Another Account -->
            <div class="account-item use-another">
                <div class="account-avatar alt-avatar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="account-info">
                    <h3 class="account-name">Use another account</h3>
                </div>
            </div>
        </div>

        <!-- Privacy Notice -->
        <div class="privacy-notice">
            <p class="privacy-text">
                To continue, Google share your name, email address,
                language preference, and profile picture with [App
                name]. Before using this app, you can review [App
                name]'s <a href="#" class="privacy-link">privacy policy</a> and <a href="#" class="privacy-link">terms of service</a>.
            </p>
        </div>

        <!-- Language Selector -->
        <div class="language-selector">
            <select class="language-select">
                <option value="en-US">English (United States)</option>
                <option value="id-ID">Bahasa Indonesia</option>
            </select>
        </div>

        <!-- Footer Links -->
        <div class="footer-links">
            <a href="#" class="footer-link">Help</a>
            <a href="#" class="footer-link">Privacy</a>
            <a href="#" class="footer-link">Terms</a>
        </div>

        <!-- Bottom Privacy Notice (Duplicate for mobile) -->
        <div class="bottom-privacy">
            <p class="privacy-text small">
                To continue, Google share your name, email address,
                language preference, and profile picture with [App
                name]. Before using this app, you can review [App
                name]'s <a href="#" class="privacy-link">privacy policy</a> and <a href="#" class="privacy-link">terms of service</a>.
            </p>
        </div>
    </div>
</body>

</html>