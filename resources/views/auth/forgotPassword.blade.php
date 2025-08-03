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

            // Illustration animation
            anime({
                targets: '.forgot-illustration',
                translateY: [50, 0],
                opacity: [0, 1],
                duration: 800,
                easing: 'easeOutQuart',
                delay: 400
            });

            // Question marks floating animation
            anime({
                targets: '.question-mark',
                translateY: [-10, 10],
                rotate: [-5, 5],
                duration: 2000,
                easing: 'easeInOutSine',
                direction: 'alternate',
                loop: true,
                delay: anime.stagger(200, {start: 1500})
            });

            // Title section animation
            anime({
                targets: '.forgot-title',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: 800
            });

            // Description animation
            anime({
                targets: '.forgot-description',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 500,
                easing: 'easeOutQuart',
                delay: 1000
            });

            // Form animation
            anime({
                targets: '.forgot-form',
                translateY: [40, 0],
                opacity: [0, 1],
                duration: 700,
                easing: 'easeOutQuart',
                delay: 1200
            });

            // Button animation
            anime({
                targets: '.send-code-btn',
                scale: [0.8, 1],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutBack',
                delay: 1400
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

            // Form submission
            const form = document.getElementById('forgotPasswordForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = document.querySelector('.send-code-btn');
                const originalText = submitBtn.textContent;
                
                // Show loading state
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengirim...
                `;
                submitBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    console.log('Email submitted:', form.email.value);
                    // Add your password reset logic here
                }, 2000);
            });

            // Input focus animation
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('focus', function() {
                anime({
                    targets: this,
                    scale: 1.02,
                    duration: 200,
                    easing: 'easeOutQuart'
                });
            });

            emailInput.addEventListener('blur', function() {
                anime({
                    targets: this,
                    scale: 1,
                    duration: 200,
                    easing: 'easeOutQuart'
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
        <button class="back-btn" onclick="location.href='/login'">
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
        <!-- Illustration -->
        <img class="forgot-illustration" src="{{ asset('assets/images/auth/icon-p.png') }}" alt="Forgot Password Illustration" />

        <!-- Forgot Password Title -->
        <div class="forgot-title">
            <h2 class="main-title">Lupa password?</h2>
        </div>

        <!-- Description -->
        <div class="forgot-description">
            <p class="description-text">
                Silakan masukkan email kamu untuk menerima kode konfirmasi agar bisa mengatur ulang kata sandi.
            </p>
        </div>

        <!-- Forgot Password Form -->
        <div class="forgot-form">
            <form id="forgotPasswordForm" class="form-container">
                <!-- Email Input -->
                <div class="input-group">
                    <input 
                        type="email" 
                        id="email" 
                        name="email"
                        class="form-input"
                        placeholder="Email"
                        required
                    >
                </div>

                <!-- Submit Button -->
                <div class="form-buttons">
                    <button type="submit" class="send-code-btn">Kirim Kode</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>