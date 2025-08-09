<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in with Google</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/auth/loginManual1.css') }}">
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

            // User avatar animation
            anime({
                targets: '.user-avatar',
                scale: [0.3, 1.1, 1],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutBounce',
                delay: 300
            });

            // Verification title animation
            anime({
                targets: '.verification-title',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: 800
            });

            // User email info animation
            anime({
                targets: '.user-email-info',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 500,
                easing: 'easeOutQuart',
                delay: 1000
            });

            // Password form animation
            anime({
                targets: '.password-form',
                translateY: [40, 0],
                opacity: [0, 1],
                duration: 700,
                easing: 'easeOutQuart',
                delay: 1200
            });

            // Links and buttons stagger animation
            anime({
                targets: '.password-links a, .password-buttons *',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 500,
                easing: 'easeOutQuart',
                delay: anime.stagger(100, {start: 1400})
            });

            // Footer animation
            anime({
                targets: '.footer-content > *',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 400,
                easing: 'easeOutQuart',
                delay: anime.stagger(100, {start: 1800})
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

                // Back button functionality
                backBtn.addEventListener('click', function() {
                    window.history.back();
                });
            }

            // Password form submission
            const form = document.getElementById('passwordForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('Password form submitted');
                // Add your password verification logic here
            });

            // Show/hide password toggle
            const showPasswordBtn = document.querySelector('.show-password-btn');
            const passwordInput = document.getElementById('password');
            
            if (showPasswordBtn && passwordInput) {
                showPasswordBtn.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.textContent = 'Hide';
                    } else {
                        passwordInput.type = 'password';
                        this.textContent = 'Show';
                    }
                });
            }
        });
    </script>
</head>

<body class="oauth-container">
    <!-- Header with Back Button -->
    <div class="oauth-header">
        <button class="back-btn" onclick="location.href='/login/manual'">
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
        <!-- User Avatar -->
        <div class="user-avatar-container">
            <div class="user-avatar">
                <div class="avatar-circle">
                    <svg class="avatar-icon" width="48" height="48" viewBox="0 0 24 24" fill="none">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="#ffffff"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Verification Title -->
        <div class="verification-title">
            <h2 class="main-title">To continue, first verify that it's you</h2>
        </div>

        <!-- User Email Info -->
        <div class="user-email-info">
            <div class="email-badge">
                <span class="email-initial">P</span>
                <span class="email-address">pamelatrianjani@gmail.com</span>
            </div>
        </div>

        <!-- Password Form -->
        <div class="password-form">
            <form id="passwordForm" class="form-container">
                <!-- Password Input -->
                <div class="input-group">
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="form-input password-input"
                        placeholder="Password"
                        required
                    >
                    <button type="button" class="show-password-btn">Show</button>
                </div>

                <!-- Password Links -->
                <div class="password-links">
                    <a href="#" class="forgot-password-link">Forgot password?</a>
                </div>

                <!-- Password Buttons -->
                <div class="password-buttons">
                    <button type="submit" class="next-btn" onclick="location.href='/login/google/step1'">Next</button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="footer-content">
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
        </div>
    </div>
</body>
</html>