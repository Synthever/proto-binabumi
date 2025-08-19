/**
 * Maps JavaScript Functions
 * Handles machine search, selection, and navigation for cari-mesin pages
 */

// Configuration for different page types
const PAGE_CONFIGS = {
    'cari-mesin-1': {
        hasResults: true,
        searchText: 'Mencari...',
        redirectPage: '/maps'
    },
    'cari-mesin-2': {
        hasResults: false,
        searchText: 'Mencari...',
        redirectPage: '/maps'
    },
    'cari-mesin-3': {
        hasResults: false,
        searchText: 'Mengaktifkan...',
        redirectPage: '/maps'
    }
};

// Machine routes configuration
const MACHINE_ROUTES = {
    'amikom': 'https://maps.google.com/?q=AMIKOM+Yogyakarta',
    'teras-malioboro': 'https://maps.google.com/?q=Teras+Malioboro+Yogyakarta'
};

// Get current page type
function getCurrentPageType() {
    const path = window.location.pathname;
    if (path.includes('cari-mesin-1')) return 'cari-mesin-1';
    if (path.includes('cari-mesin-2')) return 'cari-mesin-2';
    if (path.includes('cari-mesin-3')) return 'cari-mesin-3';
    return 'cari-mesin-1'; // default
}

// Navigation functions
function goBack() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '/'; // fallback to home
    }
}

// Machine selection function
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

    // Log selection for debugging
    console.log('Machine selected:', machineId);
}

// Route navigation function
function openRoute(machineId) {
    // Prevent event bubbling
    if (event) {
        event.stopPropagation();
    }
    
    // Store the selected machine
    localStorage.setItem('selectedMachine', machineId);
    
    // Open route in maps application
    if (MACHINE_ROUTES[machineId]) {
        window.open(MACHINE_ROUTES[machineId], '_blank');
    } else {
        console.warn('Route not found for machine:', machineId);
        // Fallback to generic maps search
        window.open(`https://maps.google.com/?q=${machineId}`, '_blank');
    }
    
    // Add visual feedback
    const routeButton = event?.target?.closest('.route-button');
    if (routeButton) {
        routeButton.style.transform = 'scale(0.95)';
        setTimeout(() => {
            routeButton.style.transform = '';
        }, 150);
    }
}

// Search again function - handles different page contexts
function searchAgain() {
    const currentPage = getCurrentPageType();
    const config = PAGE_CONFIGS[currentPage];
    
    // Get the button element - handle different selectors
    let button = event?.target?.closest('.search-again-btn');
    if (!button) {
        button = event?.target?.closest('.location-btn');
    }
    if (!button) {
        button = document.querySelector('.search-again-btn, .location-btn');
    }
    
    if (!button) {
        console.warn('Search button not found');
        return;
    }
    
    // Store original button content
    const originalContent = button.innerHTML;
    
    // Add loading animation to button
    button.innerHTML = `<i class="fas fa-spinner fa-spin"></i><span>${config.searchText}</span>`;
    button.disabled = true;
    
    // Simulate search/activation process
    setTimeout(() => {
        // Reset button
        button.innerHTML = originalContent;
        button.disabled = false;
        
        // Navigate based on page type
        if (currentPage === 'cari-mesin-3') {
            // GPS activation - go to results page
            window.location.href = '/maps';
        } else if (currentPage === 'cari-mesin-2') {
            // Search again - go to results page
            window.location.href = '/maps';
        } else {
            // Default - reload or go to maps
            window.location.href = config.redirectPage;
        }
    }, 2000);
}

// Initialize page animations
function initializeAnimations() {
    // Add staggered animation to cards
    const cards = document.querySelectorAll('.machine-card, .loading-card, .empty-state');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });
}

// Load previously selected machine
function loadSelectedMachine() {
    const selectedMachine = localStorage.getItem('selectedMachine');
    if (selectedMachine) {
        const machineCard = document.querySelector(`[onclick*="${selectedMachine}"]`);
        if (machineCard) {
            machineCard.classList.add('selected');
        }
    }
}

// Simulate loading completion for loading cards
function handleLoadingCards() {
    setTimeout(() => {
        const loadingCards = document.querySelectorAll('.loading-card');
        loadingCards.forEach(card => {
            card.style.opacity = '0';
            setTimeout(() => {
                if (card.parentNode) {
                    card.remove();
                }
            }, 300);
        });
    }, 2000);
}

// Handle touch events for mobile devices
function initializeTouchEvents() {
    document.addEventListener('touchstart', function(e) {
        const machineCard = e.target.closest('.machine-card');
        if (machineCard) {
            machineCard.style.transform = 'scale(0.98)';
        }
    });

    document.addEventListener('touchend', function(e) {
        const machineCard = e.target.closest('.machine-card');
        if (machineCard) {
            setTimeout(() => {
                machineCard.style.transform = '';
            }, 150);
        }
    });
}

// Handle keyboard navigation
function initializeKeyboardEvents() {
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            goBack();
        }
        
        // Add arrow key navigation for machine cards
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            e.preventDefault();
            navigateMachineCards(e.key === 'ArrowDown' ? 'next' : 'prev');
        }
        
        // Enter key to select highlighted machine
        if (e.key === 'Enter') {
            const selectedCard = document.querySelector('.machine-card.keyboard-focus');
            if (selectedCard) {
                selectedCard.click();
            }
        }
    });
}

// Navigate machine cards with keyboard
function navigateMachineCards(direction) {
    const cards = document.querySelectorAll('.machine-card');
    if (cards.length === 0) return;
    
    let currentIndex = Array.from(cards).findIndex(card => 
        card.classList.contains('keyboard-focus')
    );
    
    // Remove current focus
    cards.forEach(card => card.classList.remove('keyboard-focus'));
    
    // Calculate new index
    if (direction === 'next') {
        currentIndex = currentIndex >= cards.length - 1 ? 0 : currentIndex + 1;
    } else {
        currentIndex = currentIndex <= 0 ? cards.length - 1 : currentIndex - 1;
    }
    
    // Add focus to new card
    cards[currentIndex].classList.add('keyboard-focus');
    cards[currentIndex].scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
    });
}

// Initialize smooth scrolling
function initializeSmoothScrolling() {
    document.documentElement.style.scrollBehavior = 'smooth';
}

// Add accessibility improvements
function initializeAccessibility() {
    // Add ARIA labels to interactive elements
    const backButton = document.querySelector('.back-button');
    if (backButton) {
        backButton.setAttribute('aria-label', 'Kembali ke halaman sebelumnya');
    }
    
    const searchButton = document.querySelector('.search-again-btn, .location-btn');
    if (searchButton) {
        searchButton.setAttribute('aria-label', 'Cari mesin lagi');
    }
    
    // Add role attributes to machine cards
    document.querySelectorAll('.machine-card').forEach(card => {
        card.setAttribute('role', 'button');
        card.setAttribute('tabindex', '0');
    });
}

// Error handling for external resources
function handleImageErrors() {
    document.querySelectorAll('img[onerror]').forEach(img => {
        img.addEventListener('error', function() {
            // The onerror attribute will handle the fallback
            console.warn('Image failed to load:', this.src);
        });
    });
}

// Main initialization function
function initializeMapsPage() {
    initializeAnimations();
    loadSelectedMachine();
    handleLoadingCards();
    initializeTouchEvents();
    initializeKeyboardEvents();
    initializeSmoothScrolling();
    initializeAccessibility();
    handleImageErrors();
    
    console.log('Maps page initialized for:', getCurrentPageType());
}

// Page-specific initialization
document.addEventListener('DOMContentLoaded', function() {
    initializeMapsPage();
});

// Export functions for global access (if needed)
if (typeof window !== 'undefined') {
    window.mapsUtils = {
        goBack,
        selectMachine,
        openRoute,
        searchAgain,
        getCurrentPageType,
        initializeMapsPage
    };
}
