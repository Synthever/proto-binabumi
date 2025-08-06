<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Mesin - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/maps/cari-mesin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="cari-mesin-container">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-content">
                <button class="back-button" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1 class="header-title">Cari Mesin</h1>
            </div>
        </div>

        <!-- Location Badge -->
        <button onclick="searchAgain()">
        <div class="location-btn fade-in">
            <i class="fas fa-map-marker-alt location-icon"></i>
            <span>Lokasi Kamu</span>
        </div>
        </button>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Empty State -->
            <div class="empty-state fade-in">
                <!-- Illustration -->
                <div class="empty-illustration">
                   <img src="{{ asset('/assets/images/maps/rvm_notfound.png') }}" alt="AMIKOM Yogyakarta" />
                </div>
                
                <!-- Text Content -->
                <div class="empty-content">
                    <h2 class="empty-title">Mesin RVM belum tersedia di dekatmu</h2>
                    <p class="empty-description">
                        Coba cari di area lain atau aktifkan lokasi 
                        secara manual.
                    </p>
                </div>
                
                <!-- Search Again Button -->
                <button class="search-again-btn" onclick="searchAgain()">
                    <i class="fas fa-search"></i>
                    <span>Cari Lagi</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Navigation functions
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/'; // fallback to home
            }
        }

        // Machine selection
        function selectMachine(element, machineId) {
            // Remove selected class from all cards
            document.querySelectorAll('.machine-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            element.classList.add('selected');
            
            // Store selected machine
            localStorage.setItem('selectedMachine', machineId);
            
            // Add subtle feedback animation
            element.style.transform = 'scale(0.98)';
            setTimeout(() => {
                element.style.transform = '';
            }, 150);
        }

        // Route navigation
        function openRoute(machineId) {
            // Prevent event bubbling
            event.stopPropagation();
            
            // Store the selected machine
            localStorage.setItem('selectedMachine', machineId);
            
            // Open route in maps application or navigate to detailed view
            const routes = {
                'amikom': 'https://maps.google.com/?q=AMIKOM+Yogyakarta',
                'teras-malioboro': 'https://maps.google.com/?q=Teras+Malioboro+Yogyakarta'
            };
            
            if (routes[machineId]) {
                window.open(routes[machineId], '_blank');
            }
            
            // Add visual feedback
            event.target.closest('.route-button').style.transform = 'scale(0.95)';
            setTimeout(() => {
                event.target.closest('.route-button').style.transform = '';
            }, 150);
        }

        // Search again function
        function searchAgain() {
            // Add loading animation to button
            const button = event.target.closest('.search-again-btn');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Mencari...</span>';
            button.disabled = true;
            
            // Simulate search process
            setTimeout(() => {
                // Reset button
                button.innerHTML = originalText;
                button.disabled = false;
                
                // Navigate to search results or reload with different params
                window.location.href = '/maps/cari-mesin-1'; // Navigate to results page
            }, 2000);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Add staggered animation to cards
            const cards = document.querySelectorAll('.machine-card, .loading-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Load previously selected machine
            const selectedMachine = localStorage.getItem('selectedMachine');
            if (selectedMachine) {
                const machineCard = document.querySelector(`[onclick*="${selectedMachine}"]`);
                if (machineCard) {
                    machineCard.classList.add('selected');
                }
            }

            // Simulate loading completion
            setTimeout(() => {
                const loadingCards = document.querySelectorAll('.loading-card');
                loadingCards.forEach(card => {
                    card.style.opacity = '0';
                    setTimeout(() => {
                        card.remove();
                    }, 300);
                });
            }, 2000);
        });

        // Handle touch events for mobile
        document.addEventListener('touchstart', function(e) {
            if (e.target.closest('.machine-card')) {
                e.target.closest('.machine-card').style.transform = 'scale(0.98)';
            }
        });

        document.addEventListener('touchend', function(e) {
            if (e.target.closest('.machine-card')) {
                setTimeout(() => {
                    e.target.closest('.machine-card').style.transform = '';
                }, 150);
            }
        });

        // Handle keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                goBack();
            }
        });

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>
</html>
