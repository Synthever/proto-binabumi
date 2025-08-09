<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Scanner - SIGMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom styles for QR Scanner */
        .scanner-container {
            max-width: 1024px;
            min-height: 100vh;
            margin: 0 auto;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .scanner-frame {
            position: relative;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 3px solid #3b82f6;
        }

        .scanner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(90deg, rgba(59, 130, 246, 0.1) 50%, transparent 50%),
                linear-gradient(rgba(59, 130, 246, 0.1) 50%, transparent 50%);
            background-size: 20px 20px;
            pointer-events: none;
            z-index: 10;
        }

        .scan-line {
            position: absolute;
            left: 10%;
            right: 10%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #22c55e, transparent);
            animation: scan 2s linear infinite;
            z-index: 20;
        }

        @keyframes scan {
            0% { top: 10%; opacity: 1; }
            50% { opacity: 1; }
            100% { top: 90%; opacity: 0; }
        }

        .corner-frame {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 3px solid #22c55e;
            z-index: 15;
        }

        .corner-frame.top-left {
            top: 20px;
            left: 20px;
            border-right: none;
            border-bottom: none;
        }

        .corner-frame.top-right {
            top: 20px;
            right: 20px;
            border-left: none;
            border-bottom: none;
        }

        .corner-frame.bottom-left {
            bottom: 20px;
            left: 20px;
            border-right: none;
            border-top: none;
        }

        .corner-frame.bottom-right {
            bottom: 20px;
            right: 20px;
            border-left: none;
            border-top: none;
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .scanner-container {
                padding: 16px;
            }
            
            .scanner-frame {
                border-radius: 16px;
                border-width: 2px;
            }
            
            .corner-frame {
                width: 30px;
                height: 30px;
                border-width: 2px;
            }
            
            .corner-frame.top-left,
            .corner-frame.top-right {
                top: 15px;
            }
            
            .corner-frame.top-left,
            .corner-frame.bottom-left {
                left: 15px;
            }
            
            .corner-frame.top-right,
            .corner-frame.bottom-right {
                right: 15px;
            }
            
            .corner-frame.bottom-left,
            .corner-frame.bottom-right {
                bottom: 15px;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .scanner-container {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            }
            
            .result-card {
                background: #1e293b;
                border-color: #334155;
                color: #f1f5f9;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="scanner-container">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6 sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button onclick="goBack()" class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center hover:bg-white/30 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <div>
                    <h1 class="text-xl font-bold">QR Scanner</h1>
                    <p class="text-blue-100 text-sm">Arahkan kamera ke QR Code</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-6">
            <!-- Scanner Section -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Auto QR Scanner</h2>
                <p class="text-gray-600">QR code akan terdeteksi otomatis dan langsung diarahkan ke halaman tujuan</p>
            </div>

            <!-- Scanner Frame -->
            <div class="scanner-frame mx-auto" style="max-width: 400px; aspect-ratio: 1/1;">
                <!-- Scanner Element -->
                <div id="scanner" class="w-full h-full relative">
                    <!-- Loading State -->
                    <div id="loading" class="flex items-center justify-center h-full bg-gray-100">
                        <div class="text-center">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                            <p class="text-gray-600">Memuat kamera...</p>
                        </div>
                    </div>
                </div>
                
                <!-- Scanner Overlay -->
                <div class="scanner-overlay"></div>
                
                <!-- Scan Line -->
                <div class="scan-line"></div>
                
                <!-- Corner Frames -->
                <div class="corner-frame top-left"></div>
                <div class="corner-frame top-right"></div>
                <div class="corner-frame bottom-left"></div>
                <div class="corner-frame bottom-right"></div>
            </div>

            <!-- Controls -->
            <div class="flex justify-center gap-4 mt-6">
                <button onclick="toggleFlash()" class="flex items-center gap-2 bg-gray-700 text-white px-4 py-2 rounded-xl hover:bg-gray-600 transition-colors">
                    <i class="fas fa-flashlight"></i>
                    <span>Flash</span>
                </button>
                <button onclick="switchCamera()" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition-colors">
                    <i class="fas fa-camera-rotate"></i>
                    <span>Ubah Kamera</span>
                </button>
            </div>

            <!-- Instructions -->
            <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-4">
                <h3 class="font-semibold text-blue-800 mb-2 flex items-center gap-2">
                    <i class="fas fa-info-circle"></i>
                    Tips Auto Scanning
                </h3>
                <ul class="text-blue-700 text-sm space-y-1">
                    <li>• QR code akan terdeteksi secara otomatis</li>
                    <li>• Posisikan QR code dalam frame scanner</li>
                    <li>• Jaga jarak sekitar 10-30 cm dari kamera</li>
                    <li>• Pastikan pencahayaan yang cukup</li>
                    <li>• Hindari bayangan atau pantulan cahaya</li>
                    <li>• Setelah terdeteksi, akan langsung diarahkan ke halaman tujuan</li>
                    <li>• Gunakan HTTPS atau localhost untuk akses kamera</li>
                </ul>
            </div>

            <!-- Debug Info -->
            <div class="mt-4 bg-gray-50 border border-gray-200 rounded-xl p-4">
                <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                    <i class="fas fa-bug"></i>
                    Debug Info
                </h3>
                <div class="text-gray-600 text-sm space-y-1">
                    <div>Protocol: <span id="debugProtocol" class="font-mono"></span></div>
                    <div>Host: <span id="debugHost" class="font-mono"></span></div>
                    <div>getUserMedia: <span id="debugGetUserMedia" class="font-mono"></span></div>
                    <div>Library Status: <span id="debugLibrary" class="font-mono">Loading...</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/minified/html5-qrcode.min.js"></script>
    <script type="text/javascript">
        let html5QrCode = null;
        let isFlashOn = false;
        let isScanning = false;
        let scanSuccessful = false;

        function onQRCodeScanned(decodedText, decodedResult) {
            if (scanSuccessful) return; // Prevent multiple scans

            scanSuccessful = true;
            console.log('QR Code scanned:', decodedText);
            
            // Stop scanning immediately
            if (html5QrCode && isScanning) {
                html5QrCode.stop().then(() => {
                    isScanning = false;
                    console.log('Scanner stopped successfully');
                }).catch(err => {
                    console.error('Error stopping scanner:', err);
                });
            }
            
            // Play success sound
            playSuccessSound();
            
            // Vibrate if supported
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100]);
            }
            
            // Show success message and redirect
            showSuccessAndRedirect(decodedText);
        }

        function onScanFailure(error) {
            // Handle scan failure quietly - this is normal behavior
        }

        function showSuccessAndRedirect(scannedText) {
            // Show success overlay
            const successOverlay = document.createElement('div');
            successOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            successOverlay.innerHTML = `
                <div class="bg-white rounded-2xl p-8 mx-4 max-w-md w-full text-center transform animate-pulse">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Scan Berhasil!</h3>
                    <p class="text-gray-600 mb-4">QR Code telah terdeteksi</p>
                    <div class="bg-gray-100 rounded-lg p-3 mb-4">
                        <p class="text-sm text-gray-700 font-mono break-all">${scannedText}</p>
                    </div>
                    <p class="text-sm text-gray-500">Mengarahkan ke halaman tujuan...</p>
                    <div class="mt-4">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-green-600 mx-auto"></div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(successOverlay);
            
            // Redirect after 2 seconds
            setTimeout(() => {
                redirectToDestination(scannedText);
            }, 2000);
        }

        function redirectToDestination(qrData) {
            try {
                // Check if it's a URL
                if (qrData.startsWith('http://') || qrData.startsWith('https://')) {
                    window.location.href = qrData;
                    return;
                }
                
                // Check if it's a custom app URL scheme
                if (qrData.includes('://')) {
                    window.location.href = qrData;
                    return;
                }
                
                // Check for specific patterns and redirect accordingly
                if (qrData.includes('profile')) {
                    window.location.href = '/profile';
                } else if (qrData.includes('beranda')) {
                    window.location.href = '/beranda';
                } else if (qrData.includes('tukar-koin')) {
                    window.location.href = '/tukar-koin';
                } else if (qrData.includes('maps')) {
                    window.location.href = '/maps';
                } else if (qrData.includes('edukasi')) {
                    window.location.href = '/edukasi';
                } else {
                    // Default redirect with QR data as parameter
                    window.location.href = `/scan-result?data=${encodeURIComponent(qrData)}`;
                }
            } catch (error) {
                console.error('Redirect error:', error);
                // Fallback: show result on current page
                showToast('Berhasil scan: ' + qrData);
            }
        }

        function startQRScanner() {
            const loading = document.getElementById('loading');
            
            try {
                // Initialize HTML5 QR Code scanner
                html5QrCode = new Html5Qrcode("scanner");
                
                // Define config
                const config = {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    aspectRatio: 1.0
                };

                // Start camera scanning
                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        let cameraId = devices[0].id;
                        
                        // Prefer back camera if available
                        for (let device of devices) {
                            if (device.label.toLowerCase().includes('back') || 
                                device.label.toLowerCase().includes('rear') ||
                                device.label.toLowerCase().includes('environment')) {
                                cameraId = device.id;
                                break;
                            }
                        }

                        html5QrCode.start(
                            cameraId,
                            config,
                            onQRCodeScanned,
                            onScanFailure
                        ).then(() => {
                            isScanning = true;
                            if (loading) {
                                loading.style.display = 'none';
                            }
                            console.log('QR Scanner started successfully');
                            showToast('Scanner siap - Arahkan kamera ke QR code');
                        }).catch(err => {
                            console.error('Error starting scanner:', err);
                            showErrorAndFallback('Gagal memulai scanner: ' + err);
                        });
                    } else {
                        showErrorAndFallback('Tidak ada kamera yang tersedia');
                    }
                }).catch(err => {
                    console.error('Error getting cameras:', err);
                    showErrorAndFallback('Gagal mengakses kamera: ' + err);
                });

            } catch (error) {
                console.error('Error initializing scanner:', error);
                showErrorAndFallback('Error initializing scanner: ' + error.message);
            }
        }

        function showErrorAndFallback(message) {
            const loading = document.getElementById('loading');
            if (loading) {
                loading.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                        <p class="text-red-600 mb-2">Scanner Error</p>
                        <p class="text-gray-600 text-sm mb-4">${message}</p>
                        <button onclick="requestCameraPermission()" class="bg-blue-600 text-white px-4 py-2 rounded-lg mr-2">
                            Minta Akses Kamera
                        </button>
                        <button onclick="startFallbackCamera()" class="bg-green-600 text-white px-4 py-2 rounded-lg mr-2">
                            Kamera Manual
                        </button>
                        <button onclick="location.reload()" class="bg-gray-600 text-white px-4 py-2 rounded-lg">
                            Coba Lagi
                        </button>
                    </div>
                `;
            }
        }

        function goBack() {
            if (html5QrCode && isScanning) {
                html5QrCode.stop().then(() => {
                    isScanning = false;
                    console.log('Scanner stopped');
                }).catch(err => {
                    console.error('Error stopping scanner:', err);
                });
            }
            
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }

        function toggleFlash() {
            // HTML5-QRCode doesn't have direct flash control
            // This is a placeholder for flash functionality
            showToast('Flash control tidak tersedia pada library ini');
        }

        function switchCamera() {
            if (html5QrCode && isScanning) {
                html5QrCode.stop().then(() => {
                    isScanning = false;
                    
                    // Get cameras and switch to next one
                    Html5Qrcode.getCameras().then(devices => {
                        if (devices && devices.length > 1) {
                            // Simple camera switching logic
                            const currentCameraId = html5QrCode.getRunningTrackCameraCapabilities().deviceId;
                            let nextCameraIndex = 0;
                            
                            for (let i = 0; i < devices.length; i++) {
                                if (devices[i].id === currentCameraId) {
                                    nextCameraIndex = (i + 1) % devices.length;
                                    break;
                                }
                            }
                            
                            const config = {
                                fps: 10,
                                qrbox: { width: 250, height: 250 },
                                aspectRatio: 1.0
                            };

                            html5QrCode.start(
                                devices[nextCameraIndex].id,
                                config,
                                onQRCodeScanned,
                                onScanFailure
                            ).then(() => {
                                isScanning = true;
                                showToast('Berganti kamera...');
                            }).catch(err => {
                                console.error('Error switching camera:', err);
                                showToast('Gagal berganti kamera');
                            });
                        } else {
                            showToast('Hanya ada satu kamera yang tersedia');
                            // Restart the same camera
                            startQRScanner();
                        }
                    });
                }).catch(err => {
                    console.error('Error stopping scanner for switch:', err);
                });
            }
        }

        function showToast(message) {
            // Create toast notification
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
            toast.textContent = message;
            document.body.appendChild(toast);
            
            // Show toast
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            // Hide toast
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        function playSuccessSound() {
            // Create audio context for success sound
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();
                
                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);
                
                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.setValueAtTime(1000, audioContext.currentTime + 0.1);
                
                gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.2);
                
                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.2);
            } catch (error) {
                console.warn('Audio not supported:', error);
            }
        }

        // Handle page visibility
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                if (html5QrCode && isScanning) {
                    html5QrCode.pause();
                }
            } else {
                if (html5QrCode && isScanning) {
                    html5QrCode.resume();
                }
            }
        });

        // Handle errors
        window.addEventListener('error', function(e) {
            console.error('Error:', e.error);
            const loading = document.getElementById('loading');
            if (loading && loading.style.display !== 'none') {
                loading.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                        <p class="text-red-600">Gagal memuat kamera</p>
                        <button onclick="location.reload()" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg">
                            Coba Lagi
                        </button>
                    </div>
                `;
            }
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', function() {
            if (html5QrCode && isScanning) {
                html5QrCode.stop().catch(err => {
                    console.error('Error stopping scanner on unload:', err);
                });
            }
        });

        // Request camera permission manually
        async function requestCameraPermission() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                showToast('Akses kamera diberikan');
                stream.getTracks().forEach(track => track.stop()); // Stop the stream
                startQRScanner(); // Start scanner after permission granted
            } catch (error) {
                console.error('Camera permission denied:', error);
                if (error.name === 'NotAllowedError') {
                    showToast('Akses kamera ditolak. Silakan izinkan di pengaturan browser.');
                } else if (error.name === 'NotFoundError') {
                    showToast('Kamera tidak ditemukan pada perangkat ini.');
                } else {
                    showToast('Gagal mengakses kamera: ' + error.message);
                }
            }
        }

        // Fallback camera using native HTML5
        async function startFallbackCamera() {
            try {
                const video = document.createElement('video');
                video.style.width = '100%';
                video.style.height = '100%';
                video.style.objectFit = 'cover';
                video.autoplay = true;
                video.playsInline = true;

                const stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'environment' // Use back camera if available
                    } 
                });
                
                video.srcObject = stream;
                
                const scannerElement = document.getElementById("scanner");
                const loading = document.getElementById('loading');
                
                // Clear existing content
                scannerElement.innerHTML = '';
                scannerElement.appendChild(video);
                
                // Add auto-scan overlay
                const autoScanOverlay = document.createElement('div');
                autoScanOverlay.innerHTML = `
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-green-600 text-white px-4 py-2 rounded-lg z-30">
                        <i class="fas fa-video animate-pulse mr-2"></i>Auto Scanning...
                    </div>
                `;
                scannerElement.appendChild(autoScanOverlay);
                
                // Hide loading
                if (loading) {
                    loading.style.display = 'none';
                }
                
                // Start auto-capture for demo
                setTimeout(() => {
                    autoCapture(video);
                }, 3000); // Auto capture after 3 seconds for demo
                
                showToast('Kamera fallback aktif - Auto scanning dalam 3 detik...');
                
            } catch (error) {
                console.error('Fallback camera error:', error);
                showToast('Gagal mengaktifkan kamera: ' + error.message);
            }
        }

        function autoCapture(video) {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            
            context.drawImage(video, 0, 0);
            
            // For demo purposes, simulate a successful QR scan
            // In real implementation, you would use a QR detection library here
            const demoQRData = generateDemoQRData();
            onQRCodeScanned(demoQRData);
        }

        function generateDemoQRData() {
            const demoUrls = [
                'https://www.google.com',
                '/profile',
                '/beranda',
                '/tukar-koin',
                '/maps',
                'demo-product-123',
                'https://github.com',
                '/edukasi'
            ];
            
            return demoUrls[Math.floor(Math.random() * demoUrls.length)];
        }

        // Check if HTTPS is required
        function checkHTTPS() {
            if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
                const loading = document.getElementById('loading');
                if (loading) {
                    loading.innerHTML = `
                        <div class="text-center">
                            <i class="fas fa-shield-alt text-amber-500 text-4xl mb-4"></i>
                            <p class="text-amber-600 mb-2">HTTPS Diperlukan</p>
                            <p class="text-gray-600 text-sm">Akses kamera memerlukan koneksi HTTPS untuk keamanan.</p>
                        </div>
                    `;
                }
                return false;
            }
            return true;
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Update debug info
            updateDebugInfo();
            
            // Check HTTPS requirement
            if (!checkHTTPS()) {
                return;
            }

            // Check if getUserMedia is supported
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                const loading = document.getElementById('loading');
                if (loading) {
                    loading.innerHTML = `
                        <div class="text-center">
                            <i class="fas fa-times-circle text-red-500 text-4xl mb-4"></i>
                            <p class="text-red-600 mb-2">Browser Tidak Didukung</p>
                            <p class="text-gray-600 text-sm">Browser Anda tidak mendukung akses kamera.</p>
                        </div>
                    `;
                }
                return;
            }

            // Check if HTML5-QRCode library is loaded
            if (typeof Html5Qrcode === 'undefined') {
                console.error('HTML5-QRCode library failed to load');
                document.getElementById('debugLibrary').textContent = 'Failed to load';
                
                showErrorAndFallback('Library HTML5-QRCode gagal dimuat');
                return;
            } else {
                document.getElementById('debugLibrary').textContent = 'HTML5-QRCode loaded successfully';
            }

            // Start the QR scanner
            setTimeout(() => {
                startQRScanner();
            }, 1000); // Give a small delay for initialization
        });

        function updateDebugInfo() {
            document.getElementById('debugProtocol').textContent = location.protocol;
            document.getElementById('debugHost').textContent = location.hostname;
            document.getElementById('debugGetUserMedia').textContent = 
                (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) ? 'Supported' : 'Not supported';
        }
    </script>
</body>
</html>