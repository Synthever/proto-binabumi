<x-halamanawal.head />

<!-- Loading Screen -->
<div class="loading-screen" id="loadingScreen">
    <div class="loading-content">
        <div class="loading-logo animate-float">
            <img src="{{ asset('assets/images/halaman-awal/logo.png') }}" alt="Logo" class="w-24 h-24 mb-4">
        </div>
        <h4 class="fw-bold mb-3 title">SIGMA</h4>
        <p class="sub-title">Smart Integrated Plastic Gathering Machine</p>
        <div class="loading-dots">
            <div class="loading-dot" id="dot1"></div>
            <div class="loading-dot" id="dot2"></div>
            <div class="loading-dot" id="dot3"></div>
        </div>
    </div>
</div>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGMA</title>
    <meta name="description"
        content="SIGMA - Menjadikan Indonesia lebih bersih, bernilai, dan berdaya melalui pengelolaan sampah plastik yang cerdas dan terintegrasi">
    <!-- icon -->
    <link rel="icon" href="assets/images/halaman-awal/light.png" type="images/halaman-awal/png">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bina-dark-green': '#1a3a1a',
                        'bina-green': '#2d5a3a',
                        'bina-light-green': '#4d8b64',
                        'bina-cream': '#fff8ee',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-white text-gray-800">
    <!-- Navigation -->
    <nav class="backdrop-blur-sm bg-white/90 fixed w-full z-10 transition-all duration-300 border-b border-gray-200">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="flex items-center group">
                <div
                    class="relative overflow-hidden rounded-full p-1 bg-gradient-to-r from-bina-light-green/20 to-bina-green/20 transition-all duration-300 group-hover:from-bina-light-green/30 group-hover:to-bina-green/30">
                    <img src="{{ asset('assets/images/halaman-awal/light.png') }}" alt="BinaBumi Logo"
                        class="h-12 transition-transform duration-300 group-hover:scale-105">
                </div>
                <span
                    class="ml-3 text-2xl font-bold bg-gradient-to-r from-bina-dark-green to-bina-green bg-clip-text text-transparent">BinaBumi</span>
            </a>

            <div class="hidden md:flex items-center">
                <div class="flex space-x-1 mr-6">
                    <a href="#about"
                        class="px-4 py-2 rounded-lg text-bina-dark-green hover:bg-bina-cream/70 transition-all duration-200 relative nav-item group">
                        <span>Tentang Kami</span>
                        <span
                            class="absolute bottom-1.5 left-1/2 w-0 h-0.5 bg-bina-green group-hover:w-1/2 group-hover:left-1/4 transition-all duration-300"></span>
                    </a>
                    <a href="#how-it-works"
                        class="px-4 py-2 rounded-lg text-bina-dark-green hover:bg-bina-cream/70 transition-all duration-200 relative nav-item group">
                        <span>Cara Kerja</span>
                        <span
                            class="absolute bottom-1.5 left-1/2 w-0 h-0.5 bg-bina-green group-hover:w-1/2 group-hover:left-1/4 transition-all duration-300"></span>
                    </a>
                    <a href="#benefits"
                        class="px-4 py-2 rounded-lg text-bina-dark-green hover:bg-bina-cream/70 transition-all duration-200 relative nav-item group">
                        <span>Keunggulan</span>
                        <span
                            class="absolute bottom-1.5 left-1/2 w-0 h-0.5 bg-bina-green group-hover:w-1/2 group-hover:left-1/4 transition-all duration-300"></span>
                    </a>
                    <a href="#target"
                        class="px-4 py-2 rounded-lg text-bina-dark-green hover:bg-bina-cream/70 transition-all duration-200 relative nav-item group">
                        <span>Target Pasar</span>
                        <span
                            class="absolute bottom-1.5 left-1/2 w-0 h-0.5 bg-bina-green group-hover:w-1/2 group-hover:left-1/4 transition-all duration-300"></span>
                    </a>
                    <a href="#team"
                        class="px-4 py-2 rounded-lg text-bina-dark-green hover:bg-bina-cream/70 transition-all duration-200 relative nav-item group">
                        <span>Tim</span>
                        <span
                            class="absolute bottom-1.5 left-1/2 w-0 h-0.5 bg-bina-green group-hover:w-1/2 group-hover:left-1/4 transition-all duration-300"></span>
                    </a>
                </div>
                <a href="#contact"
                    class="bg-gradient-to-r from-bina-green to-bina-light-green hover:from-bina-dark-green hover:to-bina-green text-white py-2 px-5 rounded-full transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Mulai Sekarang
                </a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden backdrop-blur-md bg-white/95 w-full border-t border-gray-100" id="mobile-menu">
            <div class="container mx-auto px-4 py-3 flex flex-col">
                <a href="#about"
                    class="py-3 px-4 text-bina-dark-green border-l-2 border-transparent hover:border-bina-green hover:bg-bina-cream/50 transition-all duration-200">Tentang
                    Kami</a>
                <a href="#how-it-works"
                    class="py-3 px-4 text-bina-dark-green border-l-2 border-transparent hover:border-bina-green hover:bg-bina-cream/50 transition-all duration-200">Cara
                    Kerja</a>
                <a href="#benefits"
                    class="py-3 px-4 text-bina-dark-green border-l-2 border-transparent hover:border-bina-green hover:bg-bina-cream/50 transition-all duration-200">Keunggulan</a>
                <a href="#target"
                    class="py-3 px-4 text-bina-dark-green border-l-2 border-transparent hover:border-bina-green hover:bg-bina-cream/50 transition-all duration-200">Target
                    Pasar</a>
                <a href="#team"
                    class="py-3 px-4 text-bina-dark-green border-l-2 border-transparent hover:border-bina-green hover:bg-bina-cream/50 transition-all duration-200">Tim</a>
                <a href="#contact"
                    class="mt-3 mx-4 bg-gradient-to-r from-bina-green to-bina-light-green text-white py-3 px-4 rounded-md text-center shadow-md">Mulai
                    Sekarang</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-28 pb-20 bg-gradient-to-br from-bina-cream to-white">
        <div class="container mx-auto px-4 md:px-8 lg:px-12 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0 pl-0 md:pl-4 lg:pl-8">
                <h1 class="text-4xl md:text-5xl font-bold text-bina-dark-green mb-6">Transformasi Pengelolaan Sampah
                    Plastik di Indonesia</h1>
                <p class="text-lg mb-8">BinaBumi menciptakan solusi inovatif berupa mesin pintar SIGMA yang mengubah
                    botol plastik menjadi E-Money, untuk Indonesia yang lebih bersih dan bernilai.</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="/login" target="_blank"
                        class="btn bg-bina-green hover:bg-bina-dark-green text-white py-3 px-6 rounded-lg text-center transition-colors">Bermitra
                        dengan Kami</a>
                    <a href="#how-it-works"
                        class="btn border-2 border-bina-green text-bina-green hover:bg-bina-green hover:text-white py-3 px-6 rounded-lg text-center transition-colors">Pelajari
                        Cara Kerja</a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('assets/images/halaman-awal/mesin.png') }}" alt="BinaBumi SIGMA Machine"
                    class="max-w-md w-full rounded-lg shadow-xl">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-bina-dark-green">Apa Itu BinaBumi?</h2>
                <div class="h-1 w-24 bg-bina-green mx-auto mt-4"></div>
            </div>
            <div class="max-w-4xl mx-auto">
                <p class="text-lg text-center mb-10">BinaBumi adalah startup berbasis teknologi yang bergerak di bidang
                    pengelolaan sampah plastik. Kami menciptakan solusi berupa mesin pintar bernama SIGMA (Plastic
                    Gathering Machine) yang terintegrasi dengan aplikasi digital, untuk menukar botol plastik menjadi
                    E-Money.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
                    <div class="bg-bina-cream p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow">
                        <div class="bg-bina-light-green inline-block p-3 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-bina-dark-green">Meningkatkan Partisipasi</h3>
                        <p>Mendorong masyarakat untuk lebih aktif dalam mendaur ulang plastik</p>
                    </div>
                    <div class="bg-bina-cream p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow">
                        <div class="bg-bina-light-green inline-block p-3 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-bina-dark-green">Akses Mudah</h3>
                        <p>Mempermudah pengelolaan sampah di area yang belum terjangkau bank sampah</p>
                    </div>
                    <div class="bg-bina-cream p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow">
                        <div class="bg-bina-light-green inline-block p-3 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-bina-dark-green">Nilai Ekonomi</h3>
                        <p>Memberi nilai ekonomi pada sampah botol plastik melalui E-Money</p>
                    </div>
                    <div class="bg-bina-cream p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow">
                        <div class="bg-bina-light-green inline-block p-3 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-bina-dark-green">Dampak Lingkungan</h3>
                        <p>Mengurangi dampak sampah plastik di lingkungan secara signifikan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section id="how-it-works" class="py-20 bg-bina-cream">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-bina-dark-green">Cara Kerja SIGMA</h2>
                <div class="h-1 w-24 bg-bina-green mx-auto mt-4"></div>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-10 md:mb-0">
                        <img src="assets/images/halaman-awal/mesin.png" alt="SIGMA Machine Illustration"
                            class="w-full max-w-md mx-auto rounded-lg shadow-lg">
                    </div>
                    <div class="md:w-1/2 md:pl-10">
                        <div class="flex mb-8">
                            <div
                                class="bg-bina-green rounded-full h-10 w-10 flex items-center justify-center text-white font-bold mr-4 shrink-0">
                                1</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 text-bina-dark-green">Masukkan Botol Plastik</h3>
                                <p>Pengguna memasukkan botol plastik ke mesin SIGMA yang tersedia di lokasi strategis.
                                </p>
                            </div>
                        </div>
                        <div class="flex mb-8">
                            <div
                                class="bg-bina-green rounded-full h-10 w-10 flex items-center justify-center text-white font-bold mr-4 shrink-0">
                                2</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 text-bina-dark-green">Scan & Hitung Otomatis</h3>
                                <p>Mesin SIGMA akan membaca dan menghitung jumlah botol plastik secara otomatis.</p>
                            </div>
                        </div>
                        <div class="flex mb-8">
                            <div
                                class="bg-bina-green rounded-full h-10 w-10 flex items-center justify-center text-white font-bold mr-4 shrink-0">
                                3</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 text-bina-dark-green">Tukar Menjadi E-Money</h3>
                                <p>Botol ditukar menjadi saldo E-Money melalui aplikasi dengan harga Rp 4.000/kg, lebih
                                    tinggi dari bank sampah biasa.</p>
                            </div>
                        </div>
                        <div class="flex">
                            <div
                                class="bg-bina-green rounded-full h-10 w-10 flex items-center justify-center text-white font-bold mr-4 shrink-0">
                                4</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 text-bina-dark-green">Dapatkan Rewards</h3>
                                <p>Nikmati fitur challenge, reward dan ranking di aplikasi untuk meningkatkan
                                    engagement.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-bina-dark-green">Keunggulan BinaBumi</h2>
                <div class="h-1 w-24 bg-bina-green mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                <div class="bg-bina-cream p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <div class="bg-bina-green rounded-full h-14 w-14 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center text-bina-dark-green">Lebih Terjangkau & Mudah Diakses
                    </h3>
                    <p class="text-center">Lokasi strategis dan kemudahan penggunaan menjadikan BinaBumi lebih unggul
                        daripada bank sampah konvensional.</p>
                </div>

                <div class="bg-bina-cream p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <div class="bg-bina-green rounded-full h-14 w-14 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center text-bina-dark-green">Harga Lebih Tinggi</h3>
                    <p class="text-center">Menawarkan harga Rp 4.000/kg, lebih kompetitif dibandingkan kompetitor di
                        pasar.</p>
                </div>

                <div class="bg-bina-cream p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <div class="bg-bina-green rounded-full h-14 w-14 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center text-bina-dark-green">Lebih Cepat</h3>
                    <p class="text-center">Satu scan bisa menukar banyak botol sekaligus, menjadikan proses lebih cepat
                        dari sistem lain.</p>
                </div>

                <div class="bg-bina-cream p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <div class="bg-bina-green rounded-full h-14 w-14 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center text-bina-dark-green">Terbukti Menarik Perhatian</h3>
                    <p class="text-center">Konten TikTok viral dengan 5,5 juta views menunjukkan antusiasme publik
                        terhadap solusi ini.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Target Market Section -->
    <section id="target" class="py-20 bg-bina-cream">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-bina-dark-green">Target Pasar</h2>
                <div class="h-1 w-24 bg-bina-green mx-auto mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <div
                        class="bg-bina-light-green rounded-full h-14 w-14 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center text-bina-dark-green">Institusi Pendidikan & Fasilitas
                        Umum</h3>
                    <p class="text-center">Sekolah, universitas, mall, bandara, dan taman kota yang memiliki lalu lintas
                        tinggi dan kebutuhan pengelolaan sampah.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <div
                        class="bg-bina-light-green rounded-full h-14 w-14 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center text-bina-dark-green">Perusahaan & Brand</h3>
                    <p class="text-center">Perusahaan atau brand yang ingin membangun citra eco-friendly dan mendukung
                        kampanye keberlanjutan lingkungan.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <div
                        class="bg-bina-light-green rounded-full h-14 w-14 flex items-center justify-center mb-6 mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-center text-bina-dark-green">Masyarakat Umum</h3>
                    <p class="text-center">Masyarakat yang peduli terhadap lingkungan dan ingin berkontribusi dalam
                        pengelolaan sampah plastik.</p>
                </div>
            </div>

            <div class="mt-16 bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
                <h3 class="text-2xl font-bold mb-4 text-bina-dark-green">Potensi Pasar yang Besar</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-bina-green mr-2 shrink-0 mt-0.5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Jawa, sebagai wilayah terpadat, hanya <strong>23%</strong> desanya memiliki bank
                            sampah.</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-bina-green mr-2 shrink-0 mt-0.5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Indonesia penyumbang sampah plastik <strong>no. 2 di dunia</strong>.</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-bina-green mr-2 shrink-0 mt-0.5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Hanya <strong>7.500 ton</strong> sampah plastik terserap bank sampah per tahun.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Business Model Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-bina-dark-green">Model Bisnis</h2>
                <div class="h-1 w-24 bg-bina-green mx-auto mt-4"></div>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-bina-cream p-8 rounded-lg shadow-lg mb-10">
                    <h3 class="text-2xl font-bold mb-4 text-bina-dark-green">Model Bisnis B2B</h3>
                    <p class="mb-6">BinaBumi menyewakan mesin SIGMA ke institusi atau perusahaan. Botol yang dikumpulkan
                        kemudian disalurkan ke mitra pengelola sampah untuk didaur ulang.</p>

                    <h4 class="text-xl font-semibold mb-3 text-bina-dark-green">Sumber Pendapatan:</h4>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-bina-green mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Sewa mesin
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-bina-green mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Penjualan botol
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-bina-green mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Iklan & donasi
                        </li>
                    </ul>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-bina-cream p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold mb-4 text-bina-dark-green">Proyeksi Bisnis</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-bina-green mr-2 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Satu paket (2 mesin) memberikan keuntungan lebih dari 100%</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-bina-green mr-2 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Proyeksi pertumbuhan: 4 klien baru setiap tahun</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-bina-cream p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold mb-4 text-bina-dark-green">Kebutuhan Modal</h3>
                        <p class="mb-2">Modal awal: <strong>Rp 47.160.000</strong></p>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-bina-green mr-2 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Pembuatan mesin</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-bina-green mr-2 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Pengembangan aplikasi</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-bina-green mr-2 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Operasional 1 tahun</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-20 bg-bina-cream">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-bina-dark-green">Tim BinaBumi</h2>
                <div class="h-1 w-24 bg-bina-green mx-auto mt-4"></div>
                <p class="mt-6 max-w-3xl mx-auto text-lg">Dipimpin oleh mahasiswa aktif di bidang pengelolaan sampah,
                    bisnis, dan teknologi.</p>
            </div>
            
            <!-- Team Image Section -->
            <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <img src="{{ asset('assets/images/halaman-awal/team.jpg') }}" alt="Tim BinaBumi" class="w-full rounded-lg">
                </div>
            </div>
            
            <!-- Partners Section -->
            <div class="mt-16">
                <h3 class="text-center text-2xl font-semibold text-bina-dark-green mb-8">Telah dipercaya dan didukung oleh:</h3>
                <div class="flex justify-center items-center">
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <img src="{{ asset('assets/images/halaman-awal/ABP.png') }}" alt="Amikom Business Park" 
                            class="h-16 md:h-20">
                    </div>
                </div>
            </div>
        </div>
    </section></div>

    <!-- Call to Action Section -->
    <section id="contact" class="py-20 bg-gradient-to-br from-bina-green to-bina-dark-green text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Bergabung dengan Visi BinaBumi</h2>
            <p class="text-xl mb-10 max-w-3xl mx-auto">"Menjadikan Indonesia lebih bersih, bernilai, dan berdaya melalui
                pengelolaan sampah plastik yang cerdas dan terintegrasi."</p>

            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="/login" target="_blank"
                    class="bg-white text-bina-dark-green hover:bg-bina-cream transition-colors py-3 px-8 rounded-lg font-bold text-lg">Bermitra
                    dengan Kami</a>
                <a href="#"
                    class="border-2 border-white hover:bg-white hover:text-bina-dark-green transition-colors py-3 px-8 rounded-lg font-bold text-lg">Pelajari
                    Lebih Lanjut</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-12 px-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-8 md:mb-0">
                    <a href="#" class="flex items-center">
                        <img src="{{ asset('assets/images/halaman-awal/light.png') }}" alt="BinaBumi Logo" class="h-12">
                        <span class="ml-3 text-xl font-bold text-bina-dark-green">BinaBumi</span>
                    </a>
                    <p class="mt-4 text-gray-600 max-w-md">Transformasi pengelolaan sampah plastik melalui inovasi
                        teknologi untuk masa depan Indonesia yang lebih bersih dan berkelanjutan.</p>
                </div>

                <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 md:gap-16">
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-bina-dark-green">Navigasi</h3>
                        <ul class="space-y-2">
                            <li><a href="#about" class="text-gray-600 hover:text-bina-green transition-colors">Tentang
                                    Kami</a></li>
                            <li><a href="#how-it-works"
                                    class="text-gray-600 hover:text-bina-green transition-colors">Cara Kerja</a></li>
                            <li><a href="#benefits"
                                    class="text-gray-600 hover:text-bina-green transition-colors">Keunggulan</a></li>
                            <li><a href="#target" class="text-gray-600 hover:text-bina-green transition-colors">Target
                                    Pasar</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold mb-4 text-bina-dark-green">Kontak</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-bina-green mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <a href="mailto:official.binabumi@gmail.com"
                                    class="text-gray-600 hover:text-bina-green transition-colors">official.binabumi@gmail.com</a>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-bina-green mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <a href="tel:0895704090901"
                                    class="text-gray-600 hover:text-bina-green transition-colors">0895704090901 (Nabil)</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 mt-12 pt-8 text-center">
                <p class="text-gray-600">&copy; 2025 BinaBumi. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
    <!-- JavaScript for Mobile Menu Toggle and Nav Scroll Effect -->
    <script>
        // Mobile menu toggle
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Navigation scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.remove('py-3');
                nav.classList.add('py-2');
                nav.classList.add('shadow-md');
            } else {
                nav.classList.add('py-3');
                nav.classList.remove('py-2');
                nav.classList.remove('shadow-md');
            }
        });
    </script>
<x-halamanawal.footer />