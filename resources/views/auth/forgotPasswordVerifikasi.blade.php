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
                
                // Get verification code
                const inputs = document.querySelectorAll('.verification-input');
                const verificationCode = Array.from(inputs).map(input => input.value).join('');
                
                if (verificationCode.length !== 4) {
                    alert('Silakan masukkan kode verifikasi 4 digit');
                    return;
                }
                
                // Redirect directly to forgot password confirm page
                window.location.href = '/forgot/password/confirm';
            });

            // Verification input handling
            const verificationInputs = document.querySelectorAll('.verification-input');
            
            verificationInputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = e.target.value;
                    
                    // Only allow numbers
                    if (!/^\d*$/.test(value)) {
                        e.target.value = '';
                        return;
                    }
                    
                    // Move to next input if current is filled
                    if (value && index < verificationInputs.length - 1) {
                        verificationInputs[index + 1].focus();
                    }
                });
                
                input.addEventListener('keydown', function(e) {
                    // Move to previous input on backspace if current is empty
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        verificationInputs[index - 1].focus();
                    }
                });
                
                // Input focus animation
                input.addEventListener('focus', function() {
                    anime({
                        targets: this,
                        scale: 1.05,
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

            // Countdown timer
            let countdown = 29;
            const countdownElement = document.getElementById('countdown');
            
            function updateCountdown() {
                const minutes = Math.floor(countdown / 60);
                const seconds = countdown % 60;
                countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (countdown > 0) {
                    countdown--;
                    setTimeout(updateCountdown, 1000);
                } else {
                    // Enable resend option
                    const timerText = document.querySelector('.timer-text');
                    timerText.innerHTML = '<button class="resend-btn">Kirim ulang kode</button>';
                }
            }
            
            // Start countdown
            setTimeout(updateCountdown, 2000);

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
        <button class="back-btn" onclick="location.href='/forgot/password'">
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

        <!-- Verification Title -->
        <div class="forgot-title">
            <h2 class="main-title">Verifikasi Email</h2>
        </div>

        <!-- Description with Email Badge -->
        <div class="forgot-description">
            <p class="description-text">
                Kode verifikasi telah dikirim ke :
            </p>
            <div class="email-badge">
                <div class="email-avatar">P</div>
                <span class="email-text">pamelatrianjani@gmail.com</span>
            </div>
        </div>

        <!-- Verification Code Form -->
        <div class="forgot-form">
            <form id="forgotPasswordForm" class="form-container">
                <!-- Verification Code Inputs -->
                <div class="verification-inputs">
                    <input type="text" class="verification-input" maxlength="1" data-index="0">
                    <input type="text" class="verification-input" maxlength="1" data-index="1">
                    <input type="text" class="verification-input" maxlength="1" data-index="2">
                    <input type="text" class="verification-input" maxlength="1" data-index="3">
                </div>

                <!-- Submit Button -->
                <div class="form-buttons">
                    <button type="submit" class="send-code-btn" onclick="location.href='/forgot/password/new'">Konfirmasi</button>
                </div>
            </form>
            
            <!-- Resend Timer -->
            <div class="resend-timer">
                <p class="timer-text">Kirim ulang kode dalam <span id="countdown">00:29</span></p>
            </div>
        </div>
    </div>
</body>
</html>