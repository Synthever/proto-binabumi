/**
 * Profile Syarat Ketentuan Page JavaScript
 * Handles navigation, smooth scrolling, accessibility, and reading features
 */

// Page-specific initialization
document.addEventListener('DOMContentLoaded', function() {
    // Mark current page
    if (window.profileNavigator) {
        profileNavigator.currentPage = 'syarat';
    }

    initializePageAnimations();
    initializeSmoothScrolling();
    initializeClickAnimations();
    initializeAccessibility();
    initializeExternalLinks();
    initializeTextSelection();
    initializeScrollToTop();
    initializeSectionHighlighting();
    trackTermsViewed();
});

// Enhanced navigation functions
function goBack() {
    // Mark that we're returning to main page
    sessionStorage.setItem('returningToMain', 'true');

    if (window.profileNavigator) {
        profileNavigator.goBack();
    } else {
        // Fallback
        console.log('Going back...');
        window.history.back();
    }
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
    const article = document.querySelector('.terms-card');
    const scrollTop = window.pageYOffset;
    const docHeight = article.offsetHeight;
    const winHeight = window.innerHeight;
    const scrollPercent = scrollTop / (docHeight - winHeight);
    const scrollPercentRounded = Math.round(scrollPercent * 100);

    // You can add a progress bar here if needed
    // console.log('Reading progress:', scrollPercentRounded + '%');
}

// Print functionality
function printTerms() {
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
    const sections = document.querySelectorAll('.terms-section');
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

// Scroll to top functionality
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Initialize scroll to top feature
function initializeScrollToTop() {
    // Show scroll to top button when scrolled down
    window.addEventListener('scroll', function() {
        const scrollButton = document.getElementById('scrollToTop');
        if (scrollButton) {
            if (window.pageYOffset > 300) {
                scrollButton.style.display = 'block';
            } else {
                scrollButton.style.display = 'none';
            }
        }
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

// Terms acceptance tracking (optional)
function trackTermsViewed() {
    console.log('Terms & Conditions viewed at:', new Date().toISOString());
    // You can add analytics tracking here
}

// Highlight current section when scrolling (optional)
function initializeSectionHighlighting() {
    function highlightCurrentSection() {
        const sections = document.querySelectorAll('.terms-section');
        const scrollPosition = window.pageYOffset + 100;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                // Add highlighting logic here if needed
                section.classList.add('active-section');
            } else {
                section.classList.remove('active-section');
            }
        });
    }

    // Optional: Enable section highlighting on scroll
    // window.addEventListener('scroll', highlightCurrentSection);
}

// Initialize email link tracking
document.addEventListener('DOMContentLoaded', function() {
    initializeEmailTracking();
});

// Optional: Enable reading progress tracking
// window.addEventListener('scroll', updateReadingProgress);
