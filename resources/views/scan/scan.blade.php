<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
  <title>Scan | SIGMA</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/scan/scan.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/scan/modal.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- QR Code Scanner Library - Multiple options for better compatibility -->
  <script src="https://unpkg.com/@zxing/library@latest/umd/index.min.js"></script>
  <!-- Fallback QR scanner -->
  <script src="https://cdn.jsdelivr.net/npm/qr-scanner@1.4.2/qr-scanner.umd.min.js"></script>
  <script>
    let currentStream = null;
    let isScanning = false;
    let codeReader = null;
    let qrScanner = null;
    let selectedDeviceId = null;

    // Initialize animations when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize QR code scanner
      initializeQRScanner();

      // Simple fade-in animation for the whole page
      anime({
        targets: '.scan-container',
        opacity: [0, 1],
        duration: 600,
        easing: 'easeOutQuad'
      });
      
      // Function to show popup
      window.showRincianPopup = function() {
        // Close any existing notification modal first
        if (window.currentNotificationModal) {
          closeNotificationModal();
        }
        
        const overlay = document.getElementById('popupRincian');
        overlay.style.display = 'flex';
        
        // Add show class after a short delay to trigger animation
        setTimeout(() => {
          overlay.classList.add('show');
        }, 10);
      };

      // Scanner frame animation removed
    });

    async function checkCameraPermissions() {
      try {
        const permissions = await navigator.permissions.query({ name: 'camera' });
        console.log('Camera permission state:', permissions.state);
        
        if (permissions.state === 'denied') {
          showCameraError('Izin kamera ditolak. Silakan berikan izin kamera di pengaturan browser dan refresh halaman.');
          return false;
        }
        
        return true;
      } catch (error) {
        console.log('Cannot check camera permissions:', error);
        return true; // Assume OK if we can't check
      }
    }

    async function initializeQRScanner() {
      try {
        console.log('Initializing QR scanner...');
        
        // Check if browser supports getUserMedia
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
          showCameraError('Browser ini tidak mendukung akses kamera. Silakan gunakan browser yang lebih baru.');
          return;
        }
        
        // Request camera permission first
        const stream = await navigator.mediaDevices.getUserMedia({ 
          video: { 
            facingMode: { ideal: 'environment' }, // Prefer back camera
            width: { ideal: 1280, min: 640 },
            height: { ideal: 720, min: 480 }
          } 
        });
        
        console.log('Camera permission granted');
        
        // Set video source
        const video = document.getElementById('camera');
        video.srcObject = stream;
        currentStream = stream;
        
        // Wait for video to be ready
        await new Promise((resolve, reject) => {
          const timeout = setTimeout(() => {
            reject(new Error('Video load timeout'));
          }, 10000);
          
          video.addEventListener('loadedmetadata', () => {
            console.log('Video metadata loaded');
            clearTimeout(timeout);
            resolve();
          });
          
          video.addEventListener('error', (e) => {
            clearTimeout(timeout);
            reject(e);
          });
        });
        
        // Play video
        await video.play();
        console.log('Video playing');
        
        // Initialize ZXing QR code reader
        codeReader = new ZXing.BrowserQRCodeReader();
        
        // Start scanning after video is playing
        setTimeout(() => {
          startQRScanningWithZXing();
        }, 1000);

      } catch (error) {
        console.error('Error initializing camera:', error);
        
        if (error.name === 'NotAllowedError') {
          showCameraError('Izin kamera ditolak. Silakan berikan izin kamera dan refresh halaman.');
        } else if (error.name === 'NotFoundError') {
          showCameraError('Kamera tidak ditemukan pada perangkat ini.');
        } else if (error.name === 'NotSupportedError') {
          showCameraError('Kamera tidak didukung oleh browser ini.');
        } else if (error.message === 'Video load timeout') {
          showCameraError('Kamera membutuhkan waktu terlalu lama untuk memuat. Silakan refresh halaman.');
        } else {
          showCameraError('Gagal mengakses kamera: ' + error.message);
        }
        
        // Try fallback method
        setTimeout(() => {
          tryFallbackScanner();
        }, 2000);
      }
    }

    async function tryFallbackScanner() {
      try {
        console.log('Trying fallback QR scanner...');
        const video = document.getElementById('camera');
        
        // Use QrScanner as fallback
        if (window.QrScanner) {
          qrScanner = new QrScanner(video, result => {
            console.log('QR Code detected (fallback):', result.data);
            handleQRCodeDetected(result.data);
          });
          
          await qrScanner.start();
          startScanAnimation();
          isScanning = true;
          console.log('Fallback scanner started');
        }
      } catch (error) {
        console.error('Fallback scanner also failed:', error);
        showCameraError('Tidak dapat menginisialisasi scanner QR. Silakan refresh halaman atau gunakan browser yang berbeda.');
      }
    }

    async function startQRScanningWithZXing() {
      if (isScanning) return;
      isScanning = true;

      try {
        console.log('Starting QR scanning...');
        const video = document.getElementById('camera');
        
        if (!video.srcObject) {
          console.error('Video stream not available');
          showCameraError('Video stream tidak tersedia');
          return;
        }

        // Use ZXing to scan from video element
        if (codeReader) {
          console.log('Starting ZXing decode...');
          
          codeReader.decodeFromVideoElement(video, (result, err) => {
            if (result) {
              console.log('QR Code detected:', result.text);
              handleQRCodeDetected(result.text);
            }
            
            if (err && !(err instanceof ZXing.NotFoundException)) {
              console.log('QR scanning error:', err);
            }
          });
          
          // Add visual feedback that scanning is active
          startScanAnimation();
        }

      } catch (error) {
        console.error('Error starting QR scanning:', error);
        showCameraError('Gagal memulai scanning: ' + error.message);
        isScanning = false;
      }
    }

    function startScanAnimation() {
      // Scan line animation removed
      // Add scanning indicator
      document.querySelector('.scanner-frame').classList.add('scanning');
    }

    async function handleQRCodeDetected(qrText) {
      console.log('QR Code detected:', qrText);
      
      // Stop scanning temporarily to show result
      isScanning = false;
      
      // Stop the scanner
      if (codeReader) {
        codeReader.reset();
      }
      
      // Process QR code through Laravel controller
      const result = await processQRCode(qrText);
      
      if (result.success) {
        // Show success notification
        showSuccessNotification(qrText, result.message);
      } else {
        // Show error notification
        showErrorNotification(qrText, result.message);
      }
      
      // Restart scanning after 4 seconds
      setTimeout(() => {
        if (qrScanner) {
          qrScanner.start();
        } else {
          startQRScanningWithZXing();
        }
      }, 4000);
    }

    async function processQRCode(qrText) {
      try {
        const response = await fetch('/scan/process', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            machine_code: qrText.trim()
          })
        });

        const data = await response.json();
        
        if (!response.ok) {
          return {
            success: false,
            message: data.message || 'Terjadi kesalahan pada server'
          };
        }

        return {
          success: true,
          message: data.message || 'Scan berhasil!',
          data: data.connection_data
        };

      } catch (error) {
        console.error('Error processing QR code:', error);
        return {
          success: false,
          message: 'Gagal menghubungi server. Silakan coba lagi.'
        };
      }
    }

    function showSuccessNotification(qrText, message = 'Scan berhasil!') {
      // Instead of showing modal, redirect to success page
      setTimeout(() => {
        window.location.href = '/scan/success?points=100&machine_id=' + encodeURIComponent(qrText);
      }, 500); // Small delay for user feedback
    }

    function showErrorNotification(qrText, message = 'Kode QR tidak valid') {
      // Create modal overlay for error
      const modalOverlay = document.createElement('div');
      modalOverlay.className = 'modal-overlay';
      modalOverlay.innerHTML = `
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-icon warning">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="modal-title">Scan Gagal!</h3>
            <p class="modal-subtitle">${message}</p>
          </div>
          <div class="modal-actions">
            <button class="modal-button primary" onclick="closeNotificationModal()">
              <i class="fas fa-redo"></i> Scan Ulang
            </button>
          </div>
        </div>
      `;
      
      document.body.appendChild(modalOverlay);
      
      // Show modal with animation
      setTimeout(() => {
        modalOverlay.classList.add('show');
      }, 10);
      
      // Prevent body scroll
      document.body.style.overflow = 'hidden';
      
      // Close on overlay click
      modalOverlay.addEventListener('click', (e) => {
        if (e.target === modalOverlay) {
          closeNotificationModal();
        }
      });
      
      // Store reference for closing
      window.currentNotificationModal = modalOverlay;
    }

    function closeNotificationModal() {
      const modalOverlay = window.currentNotificationModal;
      if (!modalOverlay) return;
      
      modalOverlay.classList.remove('show');
      
      setTimeout(() => {
        if (modalOverlay.parentNode) {
          modalOverlay.parentNode.removeChild(modalOverlay);
        }
        
        // Restore body scroll
        document.body.style.overflow = '';
        
        // Clear reference
        window.currentNotificationModal = null;
      }, 300);
    }

    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        // Show toast notification
        showToast('Teks berhasil disalin!');
        // Close modal after successful copy
        setTimeout(() => {
          closeNotificationModal();
        }, 1000);
      }).catch(err => {
        console.error('Failed to copy:', err);
        showToast('Gagal menyalin teks');
      });
    }

    function showToast(message) {
      const toast = document.createElement('div');
      toast.className = 'toast';
      toast.textContent = message;
      document.body.appendChild(toast);
      
      anime({
        targets: toast,
        translateY: [-50, 0],
        opacity: [0, 1],
        duration: 300,
        easing: 'easeOutQuart'
      });
      
      setTimeout(() => {
        anime({
          targets: toast,
          translateY: [0, -50],
          opacity: [1, 0],
          duration: 300,
          easing: 'easeInQuart',
          complete: () => {
            toast.remove();
          }
        });
      }, 2000);
    }

    function showCameraError(message = 'Tidak dapat mengakses kamera') {
      const cameraContainer = document.querySelector('.camera-container');
      cameraContainer.innerHTML = `
        <div class="camera-error">
          <i class="error-icon">📷</i>
          <p>${message}</p>
          <small>Pastikan Anda memberikan izin kamera dan refresh halaman</small>
          <button onclick="window.location.reload()" class="retry-btn">
            <i class="fas fa-redo"></i> Coba Lagi
          </button>
        </div>
      `;
    }

    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
      if (codeReader) {
        codeReader.reset();
      }
      if (qrScanner) {
        qrScanner.stop();
      }
      if (currentStream) {
        currentStream.getTracks().forEach(track => track.stop());
      }
    });

    // Handle visibility change (when user switches tabs)
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        if (codeReader) {
          codeReader.reset();
        }
        if (qrScanner) {
          qrScanner.stop();
        }
        isScanning = false;
      } else {
        if (!isScanning) {
          setTimeout(() => {
            if (qrScanner) {
              qrScanner.start();
            } else {
              startQRScanningWithZXing();
            }
          }, 500);
        }
      }
    });

    // Handle keyboard events
    document.addEventListener('keydown', (e) => {
      // ESC key to close modal
      if (e.key === 'Escape' && window.currentNotificationModal) {
        closeNotificationModal();
      }
    });
  </script>
</head>

<body class="scan-container">
  <div class="scan-content">
    <!-- Title -->
    <div class="scan-title">
      <h1>Scan</h1>
    </div>

    <!-- QR Scanner -->
    <div class="scanner-wrapper">
      <div class="camera-container">
        <video id="camera" class="camera-feed" autoplay playsinline muted></video>

        <!-- Scanner Frame Overlay -->
        <div class="scanner-frame">
          <!-- Corner markers dan scan line dihapus -->
        </div>
      </div>

      <!-- Scan Instructions -->
      <div class="scan-instructions">
        <p>Arahkan kamera ke QR code yang ingin di-scan</p>
        <small>Pastikan QR code berada dalam frame scanner</small>
      </div>
    </div>

    <!-- Bottom Navigation -->
    @include('components.bottom-nav', ['active' => 'scan'])
  </div>
</body>

</html>