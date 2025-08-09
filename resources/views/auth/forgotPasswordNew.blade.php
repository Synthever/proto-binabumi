<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/auth/forgotPassword.css') }}">
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

            // Title section animation
            anime({
                targets: '.forgot-title',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: 300
            });

            // Description animation
            anime({
                targets: '.forgot-description',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 500,
                easing: 'easeOutQuart',
                delay: 500
            });

            // Form animation
            anime({
                targets: '.forgot-form',
                translateY: [40, 0],
                opacity: [0, 1],
                duration: 700,
                easing: 'easeOutQuart',
                delay: 700
            });

            // Button animation
            anime({
                targets: '.send-code-btn',
                scale: [0.8, 1],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutBack',
                delay: 900
            });

            // Back button functionality
            const backBtn = document.querySelector('.back-btn');
            if (backBtn) {
                backBtn.addEventListener('click', function() {
                    window.history.back();
                });
            }

            // Form submission
            const form = document.getElementById('newPasswordForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                
                if (newPassword !== confirmPassword) {
                    alert('Password dan konfirmasi password tidak cocok');
                    return;
                }
                
                if (newPassword.length < 6) {
                    alert('Password minimal 6 karakter');
                    return;
                }
                
                // Simulate password reset
                alert('Password berhasil diubah!');
                // Redirect to login or dashboard
                window.location.href = '/login';
            });

            // Input focus animations
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    anime({
                        targets: this,
                        scale: 1.02,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                input.addEventListener('blur', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });
            });

            // Button hover animation
            const sendBtn = document.querySelector('.send-code-btn');
            sendBtn.addEventListener('mouseenter', function() {
                anime({
                    targets: this,
                    scale: 1.02,
                    duration: 200,
                    easing: 'easeOutQuart'
                });
            });

            sendBtn.addEventListener('mouseleave', function() {
                anime({
                    targets: this,
                    scale: 1,
                    duration: 200,
                    easing: 'easeOutQuart'
                });
            });
        });
    </script>
</head>

<body class="oauth-container">
    <!-- Header with Back Button -->
    <div class="oauth-header">
        <button class="back-btn" onclick="history.back()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <div class="header-content">
            <h1 class="header-title">Lupa Password</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- New Password Title -->
        <div class="forgot-title">
            <h2 class="main-title">Password Baru</h2>
        </div>

        <!-- Description -->
        <div class="forgot-description">
            <p class="description-text">
                Silakan masukkan kata sandi barumu.
            </p>
        </div>

        <!-- New Password Form -->
        <div class="forgot-form">
            <form id="newPasswordForm" class="form-container">
                <!-- New Password Input -->
                <div class="input-group">
                    <input 
                        type="password" 
                        id="newPassword" 
                        name="newPassword"
                        class="form-input"
                        placeholder="Password Baru"
                        required
                        minlength="6"
                    >
                </div>

                <!-- Confirm Password Input -->
                <div class="input-group">
                    <input 
                        type="password" 
                        id="confirmPassword" 
                        name="confirmPassword"
                        class="form-input"
                        placeholder="Konfirmasi Password Baru"
                        required
                        minlength="6"
                    >
                </div>

                <!-- Submit Button -->
                <div class="form-buttons">
                    <button type="submit" class="send-code-btn" onclick="location.href='/login'">Simpan Password</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>