<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" accesskey="favicon.ico" href="/assets/images/logo.png" />
  <title>Scan | SIGMA</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('assets/css/scan/scan.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components/bottom-nav.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script>
    let currentStream = null;
    let isScanning = false;

    // Initialize animations when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize camera immediately
      initializeScanner();

      // Simple fade-in animation for the whole page
      anime({
        targets: '.scan-container',
        opacity: [0, 1],
        duration: 600,
        easing: 'easeOutQuad'
      });

      // Scanner frame animation
      anime({
        targets: '.scanner-frame',
        opacity: [0, 1],
        scale: [0.8, 1],
        duration: 800,
        delay: 300,
        easing: 'easeOutQuart'
      });
    });

    async function initializeScanner() {
      try {
        const constraints = {
          video: {
            facingMode: 'environment', // Use back camera
            width: {
              ideal: 1280
            },
            height: {
              ideal: 720
            }
          }
        };

        currentStream = await navigator.mediaDevices.getUserMedia(constraints);
        const video = document.getElementById('camera');
        video.srcObject = currentStream;

        video.addEventListener('loadedmetadata', () => {
          video.play();
          startScanning();
        });

      } catch (error) {
        console.error('Error accessing camera:', error);
        showCameraError();
      }
    }

    function startScanning() {
      if (isScanning) return;
      isScanning = true;

      // Start scan line animation
      anime({
        targets: '.scan-line',
        translateY: [0, '100%'],
        duration: 2000,
        easing: 'easeInOutSine',
        loop: true,
        direction: 'alternate'
      });
    }

    function showCameraError() {
      const cameraContainer = document.querySelector('.camera-container');
      cameraContainer.innerHTML = `
                <div class="camera-error">
                    <i class="error-icon">📷</i>
                    <p>Tidak dapat mengakses kamera</p>
                    <small>Pastikan Anda memberikan izin kamera</small>
                </div>
            `;
    }

    // Cleanup on page unload
    window.addEventListener('beforeunload', () => {
      if (currentStream) {
        currentStream.getTracks().forEach(track => track.stop());
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
          <!-- Corner markers -->
          <div class="corner top-left"></div>
          <div class="corner top-right"></div>
          <div class="corner bottom-left"></div>
          <div class="corner bottom-right"></div>

          <!-- Scanning line animation -->
          <div class="scan-line"></div>
        </div>
      </div>
    </div>

    <!-- Bottom Navigation -->
    @include('components.bottom-nav', ['active' => 'scan'])
  </div>
</body>

</html>