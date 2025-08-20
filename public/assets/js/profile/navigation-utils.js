/**
 * Navigation Utilities for Profile Pages
 * Shared utilities for page animations and touch gestures
 */

// Touch Gesture Support
function initTouchGestures() {
    let startX = 0;
    let startY = 0;
    let endX = 0;
    let endY = 0;
    
    document.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
    });
    
    document.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        endY = e.changedTouches[0].clientY;
        
        const deltaX = endX - startX;
        const deltaY = endY - startY;
        
        // Swipe right to go back (only if not on main page)
        if (deltaX > 50 && Math.abs(deltaY) < 100 && 
            window.location.pathname !== '/profile' && 
            !window.location.pathname.endsWith('/profile')) {
            if (window.goBack && typeof window.goBack === 'function') {
                window.goBack();
            }
        }
    });
}

// Page Load Animations - Fixed Direction
function initPageAnimations() {
    // Detect if this is a back navigation (kembali ke main)
    const isBackNavigation = window.performance.navigation.type === 2 || 
                            document.referrer.includes('/profile/');
    
    const currentPath = window.location.pathname;
    const isMainPage = currentPath === '/profile' || currentPath.endsWith('/profile');
    
    if (isMainPage && isBackNavigation) {
        // Kembali ke main: slide dari kiri ke kanan
        document.body.classList.add('slide-in-from-left');
    } else if (!isMainPage) {
        // Masuk ke sub-halaman: slide dari kanan ke kiri  
        document.body.classList.add('slide-in-from-right');
    }
    
    // Animate elements
    const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
    elements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
    });
}

// Performance Monitoring (simplified)
function initPerformanceMonitoring() {
    // Basic performance monitoring
    let animationFrameId;
    let lastTime = performance.now();
    
    function monitorFrame(currentTime) {
        const delta = currentTime - lastTime;
        if (delta > 20) {
            console.warn('Animation frame took', delta, 'ms');
        }
        lastTime = currentTime;
        animationFrameId = requestAnimationFrame(monitorFrame);
    }
    
    // Start monitoring on user interaction
    document.addEventListener('click', () => {
        if (!animationFrameId) {
            animationFrameId = requestAnimationFrame(monitorFrame);
        }
    }, { once: true });
}

// Initialize shared navigation features
function initSharedNavigation() {
    initPageAnimations();
    initTouchGestures();
    initPerformanceMonitoring();
    
    // Add accessibility improvements
    document.body.setAttribute('role', 'application');
    document.body.setAttribute('aria-label', 'Profile Navigation');
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', initSharedNavigation);

// Export for use in other files
if (typeof window !== 'undefined') {
    window.navigationUtils = {
        initTouchGestures,
        initPageAnimations,
        initPerformanceMonitoring,
        initSharedNavigation
    };
}
