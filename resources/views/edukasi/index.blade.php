<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi | SIGMA</title>
    <link rel="stylesheet" href="{{ asset('assets/css/edukasi/edukasi.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="mobile-container">
        <!-- Header Section -->
        <div class="header">
            <div class="header-content">
                <div class="page-info">
                    <h1>Edukasi Lingkungan</h1>
                    <p>Pelajari cara mengelola sampah dengan bijak</p>
                </div>
                <div class="header-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content-section">
            <!-- Hero Card -->
            <div class="hero-card">
                <div class="hero-content">
                    <div class="hero-text">
                        <h2>{{ $edukasiData['hero']['title'] }}</h2>
                        <h3>{{ $edukasiData['hero']['subtitle'] }}</h3>
                        <p>{{ $edukasiData['hero']['description'] }}</p>
                    </div>
                    <div class="hero-illustration">
                        <i class="fas fa-leaf"></i>
                    </div>
                </div>
            </div>

            <!-- Facts Section -->
            <div class="facts-section">
                <h3 class="section-title">Tahukah Kamu?</h3>
                <div class="facts-grid">
                    @foreach($edukasiData['facts'] as $fact)
                    <div class="fact-card">
                        <div class="fact-icon">
                            <i class="{{ $fact['icon'] }}"></i>
                        </div>
                        <div class="fact-number">{{ $fact['number'] }}</div>
                        <div class="fact-text">{{ $fact['text'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- About SIGMA Section -->
            <div class="info-card">
                <h3>Tentang SIGMA</h3>
                <p>
                    SIGMA (Smart Integrated Garbage Management Assistant) adalah mesin pintar yang membantu Anda 
                    mengelola sampah botol plastik dengan mudah dan menguntungkan. Dengan teknologi AI dan sensor 
                    canggih, SIGMA dapat mendeteksi, menimbang, dan memberikan reward sesuai dengan jumlah botol 
                    plastik yang Anda setorkan.
                </p>
                
                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-brain"></i>
                        <span>Deteksi AI untuk identifikasi botol plastik</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-weight"></i>
                        <span>Sensor berat dan volume yang akurat</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Terintegrasi dengan aplikasi mobile</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-gift"></i>
                        <span>Sistem reward dan gamifikasi</span>
                    </div>
                </div>
            </div>

            <!-- Articles Banner Section -->
            <div class="articles-section">
                <h3 class="section-title">Artikel & Berita Lingkungan</h3>
                <p class="section-subtitle">Baca artikel terbaru tentang lingkungan dan daur ulang</p>
                
                <!-- Featured Article Banner -->
                <div class="featured-article">
                    <div class="featured-content">
                        <div class="featured-text">
                            <span class="featured-category">{{ $edukasiData['articles'][0]['category'] }}</span>
                            <h4>{{ $edukasiData['articles'][0]['title'] }}</h4>
                            <p>{{ $edukasiData['articles'][0]['excerpt'] }}</p>
                            <div class="article-meta">
                                <span><i class="fas fa-clock"></i> {{ $edukasiData['articles'][0]['read_time'] }}</span>
                                <span><i class="fas fa-calendar"></i> {{ date('d M Y', strtotime($edukasiData['articles'][0]['date'])) }}</span>
                            </div>
                            <a href="/edukasi/artikel/{{ $edukasiData['articles'][0]['id'] }}" class="read-more-btn">
                                Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="featured-image">
                            <img src="{{ $edukasiData['articles'][0]['image'] }}" 
                                 alt="{{ $edukasiData['articles'][0]['title'] }}"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                            <div class="article-placeholder" style="display: none;">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles Grid -->
                <div class="articles-grid">
                    @foreach(array_slice($edukasiData['articles'], 1) as $article)
                    <a href="/edukasi/artikel/{{ $article['id'] }}" class="article-card-link">
                        <div class="article-card">
                            <div class="article-image">
                                <img src="{{ $article['image'] }}" 
                                     alt="{{ $article['title'] }}"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                <div class="article-placeholder" style="display: none;">
                                    <i class="fas fa-image"></i>
                                </div>
                                <span class="article-category">{{ $article['category'] }}</span>
                            </div>
                            <div class="article-content">
                                <h5>{{ $article['title'] }}</h5>
                                <p>{{ Str::limit($article['excerpt'], 80) }}</p>
                                <div class="article-footer">
                                    <span class="read-time">
                                        <i class="fas fa-clock"></i> {{ $article['read_time'] }}
                                    </span>
                                    <span class="article-date">{{ date('d M', strtotime($article['date'])) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                <!-- View All Articles Button -->
                <div class="view-all-container">
                    <a href="#" class="view-all-btn">
                        <i class="fas fa-newspaper"></i>
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="cta-card">
                <div class="cta-icon">🌱</div>
                <h3>Mulai Aksi Sekarang!</h3>
                <p>
                    Setiap botol plastik yang kamu setorkan adalah langkah kecil menuju bumi yang lebih hijau. 
                    Temukan mesin SIGMA terdekat dan mulai kumpulkan poin rewards!
                </p>
                <div class="cta-buttons">
                    <a href="/maps" class="btn-primary">
                        <i class="fas fa-map-marker-alt"></i>
                        Cari Mesin SIGMA
                    </a>
                    <a href="/beranda" class="btn-secondary">
                        <i class="fas fa-home"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation Component -->
        @include('components.bottom-nav', ['active' => $active])
    </div>
</body>
</html>
