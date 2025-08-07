<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article['title'] }} | SIGMA</title>
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
                    <a href="/edukasi" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1>Detail Artikel</h1>
                        <p>{{ $article['category'] }}</p>
                    </div>
                </div>
                <div class="header-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>

        <!-- Article Content -->
        <div class="content-section">
            <div class="article-detail">
                <div class="article-header">
                    <span class="article-category-badge">{{ $article['category'] }}</span>
                    <h1>{{ $article['title'] }}</h1>
                    <div class="article-meta-detail">
                        <span><i class="fas fa-user"></i> {{ $article['author'] }}</span>
                        <span><i class="fas fa-calendar"></i> {{ date('d M Y', strtotime($article['date'])) }}</span>
                        <span><i class="fas fa-clock"></i> {{ $article['read_time'] }}</span>
                    </div>
                </div>

                <div class="article-image-detail">
                    <img src="{{ $article['image'] }}" 
                         alt="{{ $article['title'] }}"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="article-placeholder-large" style="display: none;">
                        <i class="fas fa-image"></i>
                    </div>
                </div>

                <div class="article-body">
                    <p>{{ $article['content'] ?? 'Konten artikel akan dimuat di sini. Dalam implementasi nyata, konten artikel akan diambil dari database dan ditampilkan dengan format yang sesuai.' }}</p>
                    
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    
                    <h3>Dampak Terhadap Lingkungan</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    
                    <h3>Solusi yang Dapat Dilakukan</h3>
                    <ul>
                        <li>Mengurangi penggunaan plastik sekali pakai</li>
                        <li>Memilah sampah dengan benar</li>
                        <li>Menggunakan produk ramah lingkungan</li>
                        <li>Mendaur ulang sampah plastik dengan baik</li>
                    </ul>
                    
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                </div>

                <div class="article-footer-action">
                    <div class="share-buttons">
                        <span>Bagikan artikel ini:</span>
                        <div class="share-icons">
                            <a href="#" class="share-btn facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="share-btn twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="share-btn whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="share-btn telegram">
                                <i class="fab fa-telegram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="related-articles">
                    <h3>Artikel Terkait</h3>
                    <div class="related-grid">
                        <a href="#" class="related-card">
                            <div class="related-image">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="related-content">
                                <h5>Tips Mengurangi Sampah Plastik</h5>
                                <span>5 menit baca</span>
                            </div>
                        </a>
                        <a href="#" class="related-card">
                            <div class="related-image">
                                <i class="fas fa-recycle"></i>
                            </div>
                            <div class="related-content">
                                <h5>Teknologi Daur Ulang Terbaru</h5>
                                <span>7 menit baca</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation Component -->
        @include('components.bottom-nav', ['active' => $active])
    </div>
</body>
</html>
