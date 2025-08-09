<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Scan - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .scanner-container {
            max-width: 1024px;
            min-height: 100vh;
            margin: 0 auto;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .result-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 2px solid #22c55e;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .qr-data-display {
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 20px;
            font-family: 'Courier New', monospace;
            word-break: break-all;
            max-height: 200px;
            overflow-y: auto;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .result-card {
                margin: 16px;
                padding: 20px;
            }
            
            .success-icon {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="scanner-container">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-6 sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button onclick="goBack()" class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center hover:bg-white/30 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold">Hasil Scan QR</h1>
                    <p class="text-green-100 text-sm">QR Code berhasil dipindai</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-6">
            <!-- Success Card -->
            <div class="result-card">
                <!-- Success Icon -->
                <div class="success-icon">
                    <i class="fas fa-check text-white text-3xl"></i>
                </div>

                <!-- Title -->
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Scan Berhasil!</h2>
                <p class="text-center text-gray-600 mb-6">{{ $result['message'] }}</p>

                <!-- QR Data Display -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fas fa-qrcode text-blue-600"></i>
                        Data QR Code
                    </h3>
                    <div class="qr-data-display">
                        {{ $qrData }}
                    </div>
                </div>

                <!-- Result Type Badge -->
                <div class="mb-6 text-center">
                    @if($result['type'] === 'url')
                        <span class="inline-flex items-center gap-2 bg-blue-100 text-blue-800 px-4 py-2 rounded-full">
                            <i class="fas fa-link"></i>
                            Website/URL
                        </span>
                    @elseif($result['type'] === 'product')
                        <span class="inline-flex items-center gap-2 bg-purple-100 text-purple-800 px-4 py-2 rounded-full">
                            <i class="fas fa-box"></i>
                            Produk
                        </span>
                    @elseif($result['type'] === 'profile')
                        <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-2 rounded-full">
                            <i class="fas fa-user"></i>
                            Profil
                        </span>
                    @elseif($result['type'] === 'number')
                        <span class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full">
                            <i class="fas fa-hashtag"></i>
                            Kode Numerik
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-800 px-4 py-2 rounded-full">
                            <i class="fas fa-question-circle"></i>
                            Data Umum
                        </span>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    @if($result['type'] === 'url')
                        <button onclick="openUrl('{{ $qrData }}')" class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-external-link-alt"></i>
                            Buka Website
                        </button>
                    @endif

                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="copyToClipboard()" class="bg-gray-600 text-white py-3 px-6 rounded-xl hover:bg-gray-700 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-copy"></i>
                            Salin
                        </button>
                        <button onclick="shareData()" class="bg-green-600 text-white py-3 px-6 rounded-xl hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-share"></i>
                            Bagikan
                        </button>
                    </div>

                    <button onclick="scanAgain()" class="w-full bg-orange-600 text-white py-3 px-6 rounded-xl hover:bg-orange-700 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-qrcode"></i>
                        Scan Lagi
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl p-4 mt-4 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-3">Aksi Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <button onclick="goToMaps()" class="flex flex-col items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <i class="fas fa-map-marker-alt text-blue-600 text-xl mb-2"></i>
                        <span class="text-sm text-blue-700">Maps</span>
                    </button>
                    <button onclick="goToProfile()" class="flex flex-col items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                        <i class="fas fa-user text-green-600 text-xl mb-2"></i>
                        <span class="text-sm text-green-700">Profile</span>
                    </button>
                    <button onclick="goToBeranda()" class="flex flex-col items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                        <i class="fas fa-home text-purple-600 text-xl mb-2"></i>
                        <span class="text-sm text-purple-700">Beranda</span>
                    </button>
                    <button onclick="goToHistory()" class="flex flex-col items-center p-3 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                        <i class="fas fa-history text-orange-600 text-xl mb-2"></i>
                        <span class="text-sm text-orange-700">History</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Navigation functions
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }

        function scanAgain() {
            window.location.href = '/testcam';
        }

        // URL handling
        function openUrl(url) {
            window.open(url, '_blank');
        }

        // Copy to clipboard
        function copyToClipboard() {
            const qrData = @json($qrData);
            navigator.clipboard.writeText(qrData).then(function() {
                showToast('Data berhasil disalin ke clipboard');
            }).catch(function(err) {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = qrData;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showToast('Data berhasil disalin ke clipboard');
            });
        }

        // Share data
        function shareData() {
            const qrData = @json($qrData);
            
            if (navigator.share) {
                navigator.share({
                    title: 'Data QR Code',
                    text: qrData,
                }).then(() => {
                    showToast('Data berhasil dibagikan');
                }).catch((error) => {
                    console.log('Error sharing:', error);
                });
            } else {
                // Fallback: copy to clipboard
                copyToClipboard();
            }
        }

        // Quick navigation functions
        function goToMaps() {
            window.location.href = '/maps';
        }

        function goToProfile() {
            window.location.href = '/profile';
        }

        function goToBeranda() {
            window.location.href = '/beranda';
        }

        function goToHistory() {
            window.location.href = '/history';
        }

        // Toast notification
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-redirect for URLs after 3 seconds
            @if($result['type'] === 'url')
                let countdown = 3;
                const button = document.querySelector('button[onclick*="openUrl"]');
                const originalText = button.innerHTML;
                
                const interval = setInterval(() => {
                    button.innerHTML = `<i class="fas fa-external-link-alt"></i> Membuka dalam ${countdown}s...`;
                    countdown--;
                    
                    if (countdown < 0) {
                        clearInterval(interval);
                        openUrl('{{ $qrData }}');
                    }
                }, 1000);
                
                // Allow user to cancel auto-redirect
                button.onclick = function() {
                    clearInterval(interval);
                    button.innerHTML = originalText;
                    openUrl('{{ $qrData }}');
                };
            @endif
        });
    </script>
</body>
</html>
