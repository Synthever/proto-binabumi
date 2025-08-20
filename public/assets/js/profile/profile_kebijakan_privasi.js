/**
 * Profile Kebijakan Privasi Page JavaScript
 * Handles navigation, smooth scrolling, and accessibility features
 */

// Page-specific initialization
document.addEventListener('DOMContentLoaded', function() {
    // Mark current page
    if (window.profileNavigator) {
        profileNavigator.currentPage = 'kebijakan';
    }

    initializePageAnimations();
    initializeSmoothScrolling();
    initializeClickAnimations();
    initializeAccessibility();
    initializeExternalLinks();
    initializeTextSelection();
    trackPageView();
    
    // Apply navigation fixes
    setTimeout(() => {
        autoFixBackButton();
    }, 100);
});

// Override global goBack function
window.goBack = enhancedGoBack;

// Enhanced navigation functions with fixes
function enhancedGoBack() {
    console.log('🔙 Enhanced go back triggered from kebijakan privasi');
    
    // Add visual feedback
    const backButton = document.querySelector('.back-button');
    if (backButton) {
        backButton.style.transform = 'scale(0.95)';
        backButton.style.background = '#f0f0f0';
        
        setTimeout(() => {
            backButton.style.transform = '';
            backButton.style.background = '';
        }, 200);
    }
    
    // Mark that we're returning to main page
    sessionStorage.setItem('returningToMain', 'true');
    
    try {
        if (window.profileNavigator && typeof window.profileNavigator.goBack === 'function') {
            window.profileNavigator.goBack();
        } else {
            window.location.href = '/profile';
        }
    } catch (error) {
        console.error('❌ Error in goBack:', error);
        window.location.href = '/profile';
    }
}

// Fix scroll issues
function fixScrolling() {
    const containers = document.querySelectorAll('.page-container, .page-content, .kebijakan-privasi-container');
    
    containers.forEach(container => {
        if (container) {
            container.style.height = 'auto';
            container.style.maxHeight = 'none';
            container.style.overflow = 'visible';
            container.style.overflowY = 'auto';
        }
    });
    
    document.body.style.overflow = 'auto';
}

// Force attach click handlers
function forceAttachClickHandlers() {
    const backButtons = document.querySelectorAll('.back-button');
    
    backButtons.forEach((button) => {
        button.removeEventListener('click', enhancedGoBack);
        button.addEventListener('click', enhancedGoBack, { passive: false });
        button.addEventListener('touchend', function(e) {
            e.preventDefault();
            enhancedGoBack();
        }, { passive: false });
        
        button.style.cssText += `
            position: relative !important;
            z-index: 99999 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
        `;
    });
}

// Auto-fix function
function autoFixBackButton() {
    fixScrolling();
    forceAttachClickHandlers();
}

// Backward compatibility
function goBack() {
    enhancedGoBack();
}

// Smooth scrolling for anchor links
function initializeSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Initialize page animations
function initializePageAnimations() {
    const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
    elements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
    });
}

// Initialize click animations
function initializeClickAnimations() {
    document.querySelectorAll('.back-button').forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
}

// Reading progress indicator (optional)
function updateReadingProgress() {
    const article = document.querySelector('.privacy-card');
    const scrollTop = window.pageYOffset;
    const docHeight = article.offsetHeight;
    const winHeight = window.innerHeight;
    const scrollPercent = scrollTop / (docHeight - winHeight);
    const scrollPercentRounded = Math.round(scrollPercent * 100);

    // You can add a progress bar here if needed
    // console.log('Reading progress:', scrollPercentRounded + '%');
}

// Print functionality
function printPolicy() {
    window.print();
}

// Email link click tracking (optional)
function initializeEmailTracking() {
    document.querySelectorAll('.email-link').forEach(link => {
        link.addEventListener('click', function() {
            console.log('Email link clicked:', this.href);
            // You can add analytics tracking here
        });
    });
}

// Accessibility improvements
function initializeAccessibility() {
    // ESC key to go back
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            goBack();
        }
    });

    // Focus management for better accessibility
    const backButton = document.querySelector('.back-button');
    if (backButton) {
        backButton.setAttribute('aria-label', 'Kembali ke halaman sebelumnya');
    }

    // Add ARIA labels to sections
    const sections = document.querySelectorAll('.privacy-section');
    sections.forEach((section, index) => {
        section.setAttribute('aria-labelledby', `section-${index + 1}`);
    });
}

// Handle external links (if any)
function initializeExternalLinks() {
    document.querySelectorAll('a[href^="http"]').forEach(link => {
        link.setAttribute('target', '_blank');
        link.setAttribute('rel', 'noopener noreferrer');
    });
}

// Simple text selection analytics (optional)
function initializeTextSelection() {
    document.addEventListener('mouseup', function() {
        const selection = window.getSelection().toString();
        if (selection.length > 10) {
            console.log('Text selected:', selection.substring(0, 50) + '...');
            // You can add analytics for highlighted text here
        }
    });
}

// Track page view
function trackPageView() {
    console.log('Privacy Policy viewed at:', new Date().toISOString());
    // You can add analytics tracking here
}

// Initialize email link tracking
document.addEventListener('DOMContentLoaded', function() {
    initializeEmailTracking();
});

// Optional: Enable reading progress tracking
// window.addEventListener('scroll', updateReadingProgress);
