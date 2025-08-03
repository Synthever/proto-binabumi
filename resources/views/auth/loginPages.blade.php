<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
    <title>{{ $name }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/auth/loginPages.css') }}">
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
            // Logo animation - simple and effective
            anime({
                targets: '.logo-container',
                opacity: [0, 1],
            });

            // Title section animation
            anime({
                targets: '.title-section',
                translateY: [50, 0],
                opacity: [0, 1],
                duration: 800,
                easing: 'easeOutQuart',
                delay: 600
            });

            // Login card animation
            anime({
                targets: '.login-card',
                translateY: [100, 0],
                scale: [0.8, 1],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutBack',
                delay: 1000
            });

            // Form elements stagger animation
            anime({
                targets: '.login-form > *',
                translateX: [-30, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: anime.stagger(100, {start: 1400})
            });

            // Register section animation
            anime({
                targets: '.register-section',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 600,
                easing: 'easeOutQuart',
                delay: 1800
            });

            // Floating animation for logo - gentler version
            anime({
                targets: '.logo-container',
                translateY: [-5, 5],
                duration: 3000,
                easing: 'easeInOutSine',
                direction: 'alternate',
                loop: true,
                delay: 2000
            });

            // Button hover animations
            const googleBtn = document.querySelector('.google-btn');
            const submitBtn = document.querySelector('.submit-btn');

            if (googleBtn) {
                googleBtn.addEventListener('mouseenter', function() {
                    anime({
                        targets: this,
                        scale: 1.05,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                googleBtn.addEventListener('mouseleave', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });
            }

            if (submitBtn) {
                submitBtn.addEventListener('mouseenter', function() {
                    anime({
                        targets: this,
                        scale: 1.02,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                submitBtn.addEventListener('mouseleave', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });
            }

            // Input focus animations
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    anime({
                        targets: this,
                        scale: 1.02,
                        duration: 300,
                        easing: 'easeOutQuart'
                    });
                });

                input.addEventListener('blur', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        duration: 300,
                        easing: 'easeOutQuart'
                    });
                });
            });

            // Circle checkbox animation
            const checkboxContainer = document.querySelector('.checkbox-container');
            const checkboxInput = document.querySelector('.checkbox-input');
            const checkboxCircle = document.querySelector('.checkbox-circle');

            if (checkboxContainer && checkboxInput && checkboxCircle) {
                checkboxInput.addEventListener('change', function() {
                    if (this.checked) {
                        anime({
                            targets: checkboxCircle,
                            scale: [1, 1.2, 1],
                            duration: 300,
                            easing: 'easeOutBack'
                        });
                    } else {
                        anime({
                            targets: checkboxCircle,
                            scale: [1, 0.8, 1],
                            duration: 200,
                            easing: 'easeOutQuart'
                        });
                    }
                });

                checkboxContainer.addEventListener('mouseenter', function() {
                    anime({
                        targets: checkboxCircle,
                        scale: 1.05,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });

                checkboxContainer.addEventListener('mouseleave', function() {
                    anime({
                        targets: checkboxCircle,
                        scale: 1,
                        duration: 200,
                        easing: 'easeOutQuart'
                    });
                });
            }
        });
    </script>
</head>

<body class="login-container">
    <div class="main-content">
        <!-- Logo dengan background circle -->
        <div class="logo-container">
            <img src="/assets/images/halaman-awal/logo.png" alt="Logo SIGMA" class="logo-image" />
        </div>

        <!-- Judul -->
        <div class="title-section">
            <h1 class="main-title">Masuk</h1>
            <p class="subtitle">Silahkan akses akun Anda</p>
        </div>

        <!-- Card -->
        <div class="login-card">
            <form class="login-form">
                <!-- Google Button -->
                <button type="button" class="google-btn" onclick="location.href='/login/google'">
                    <svg width="20" height="20" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    <span>Lanjutkan dengan akun google</span>
                </button>

                <!-- Divider -->
                <div class="divider">
                    <hr class="divider-line" />
                    <span class="divider-text">atau</span>
                    <hr class="divider-line" />
                </div>

                <!-- Form Fields -->
                <div class="form-group">
                    <input
                        type="email"
                        placeholder="Email"
                        class="form-input"
                        required />
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        placeholder="Password"
                        class="form-input"
                        required />
                </div>

                <!-- Checkbox dan Forgot Password -->
                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox" class="checkbox-input" id="rememberMe" />
                        <span class="checkbox-circle"></span>
                        <span class="checkbox-text">Ingat saya</span>
                    </label>
                    <a href="/forgot/password" class="forgot-link">Lupa password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    Masuk
                </button>
            </form>
        </div>

        <!-- Register Link -->
        <div class="register-section">
            <p class="register-text">
                Belum punya akun? <a href="/daftar" class="register-link">Daftar sekarang!</a>
            </p>
        </div>
    </div>
</body>

</html>