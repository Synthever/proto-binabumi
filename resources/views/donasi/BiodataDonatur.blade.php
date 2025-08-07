<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Donatur - SIGMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/donasi/biodatadonatur.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
    <div class="container fade-in">
        <div class="header">
            <a href="{{ route('donasi.index') }}" class="back-button">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
            <h1>Biodata Donatur</h1>
        </div>

        <section class="form-wrapper">
            <h2 class="form-title">Biodata Donatur</h2>
            <form action="{{ route('donasi.bukti-tf') }}" method="POST">
                @csrf
                <input type="text" placeholder="Nama Lengkap" name="nama_lengkap" class="input-field" required />
                <input type="text" placeholder="Username" name="username" class="input-field" required />

                <div class="amount-grid">
                    <button type="button" class="amount-btn" data-amount="50000">50.000</button>
                    <button type="button" class="amount-btn" data-amount="100000">100.000</button>
                    <button type="button" class="amount-btn" data-amount="250000">250.000</button>
                    <button type="button" class="amount-btn" data-amount="500000">500.000</button>
                </div>

                <input type="text" id="nominalInput" name="nominal" placeholder="Nominal Rp." class="input-field" required />
                <button type="submit" class="submit-btn">Kirim</button>
            </form>
        </section>
    </div>

    <script>
        // Efek fade-in saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            anime({
                targets: '.form-wrapper',
                opacity: [0, 1],
                translateY: [30, 0],
                delay: anime.stagger(150),
                duration: 600,
                easing: 'easeOutQuart'
            });
        });

        // Efek klik tombol nominal
        const amountButtons = document.querySelectorAll('.amount-btn');
        const nominalInput = document.getElementById('nominalInput');

        amountButtons.forEach(button => {
            button.addEventListener('click', () => {
                amountButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const amountValue = button.getAttribute('data-amount');
                nominalInput.value = `Rp ${Number(amountValue).toLocaleString('id-ID')}`;

                anime({
                    targets: '#nominalInput',
                    scale: [0.9, 1],
                    duration: 500,
                    easing: 'easeOutExpo'
                });
            });
        });
    </script>
</body>
</html>
