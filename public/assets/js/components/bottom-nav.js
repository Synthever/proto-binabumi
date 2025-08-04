/* Bottom Navigation Component JavaScript */

// QR Button click handler
function handleQRClick() {
  // Check if anime.js is available
  if (typeof anime !== 'undefined') {
    anime({
      targets: '.qr-button',
      scale: [1, 1.1, 1],
      duration: 300,
      easing: 'easeOutQuart'
    });
  }
  
  // Add your QR code functionality here
  console.log('QR button clicked');
  
  // Example: Open QR scanner or show QR code
  // You can add your custom logic here
}

// Add click animations to nav items
document.addEventListener('DOMContentLoaded', function() {
  // Add click animations to nav links
  document.querySelectorAll('.nav-item .nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
      // Add click animation if anime.js is available
      if (typeof anime !== 'undefined') {
        anime({
          targets: this.parentElement,
          scale: [1, 0.95, 1],
          duration: 200,
          easing: 'easeOutQuart'
        });
      }
    });
  });
});
