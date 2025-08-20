/**
 * Profile Main Page JavaScript Functions
 * Handles all interactions and functionality for the main profile page
 */

// Navigation class for profile main page
class ProfileMainNavigator {
    constructor() {
        this.currentPage = 'main';
        this.pageStack = ['main'];
        this.isTransitioning = false;
        this.modals = new Map();
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.createModals();
        this.setupKeyboardNavigation();
        this.checkForSuccessNotification();
    }
    
    setupEventListeners() {
        // Handle browser back button
        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.page) {
                this.navigateToPage(e.state.page, false, true);
            }
        });
        
        // Handle page visibility
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.pauseAnimations();
            } else {
                this.resumeAnimations();
            }
        });
    }
    
    setupKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            // ESC key to close modal
            if (e.key === 'Escape' && this.hasOpenModal()) {
                this.closeAllModals();
            }
            
            // Enter key for focused elements
            if (e.key === 'Enter') {
                const focused = document.activeElement;
                if (focused && focused.classList.contains('menu-item')) {
                    focused.click();
                }
            }
        });
    }
    
    createModals() {
        // Logout confirmation modal
        this.modals.set('logout', {
            type: 'confirmation',
            icon: 'fas fa-sign-out-alt',
            iconClass: 'warning',
            title: 'Yakin ingin keluar dari akun?',
            subtitle: 'Sesi kamu akan berakhir dan kamu perlu login kembali untuk melanjutkan',
            buttons: [
                {
                    text: 'Kembali',
                    class: 'secondary',
                    action: () => this.closeModal('logout')
                },
                {
                    text: 'Ya',
                    class: 'danger',
                    action: () => this.performLogout()
                }
            ]
        });
        
        // Delete account confirmation modal
        this.modals.set('delete', {
            type: 'confirmation',
            icon: 'fas fa-trash-alt',
            iconClass: 'warning',
            title: 'Yakin ingin menghapus akun?',
            subtitle: 'Saat kamu menghapus akun, semua histori aktivitasmu akan otomatis terhapus',
            buttons: [
                {
                    text: 'Kembali',
                    class: 'secondary',
                    action: () => this.closeModal('delete')
                },
                {
                    text: 'Ya',
                    class: 'danger',
                    action: () => this.showDeleteFinalConfirmation()
                }
            ]
        });

        // Success notification modal
        this.modals.set('success', {
            type: 'notification',
            icon: 'fas fa-check-circle',
            iconClass: 'success',
            title: 'Berhasil!',
            subtitle: 'Profil berhasil disimpan!',
            buttons: [
                {
                    text: 'Ok!',
                    class: 'primary',
                    action: () => this.closeModal('success')
                }
            ]
        });
    }
    
    // Navigation methods
    navigateTo(page) {
        if (this.isTransitioning || page === this.currentPage) return;
        
        const routes = {
            'data-profile': '/profile/data-profile',
            'keamanan': '/profile/keamanan',
            'rekening': '/profile/rekening',
            'kebijakan': '/profile/kebijakan',
            'syarat': '/profile/syarat'
        };
        
        if (routes[page]) {
            this.slideToPage(routes[page], page);
        }
    }
    
    slideToPage(url, pageKey) {
        this.isTransitioning = true;
        this.pageStack.push(pageKey);
        history.pushState({ page: pageKey }, '', url);
        
        setTimeout(() => {
            window.location.href = url;
        }, 300);
    }
    
    // Modal methods
    showModal(modalId, customData = {}) {
        const modalData = this.modals.get(modalId);
        if (!modalData) return;
        
        const finalData = { ...modalData, ...customData };
        const modalHTML = this.createModalHTML(finalData);
        const overlay = document.createElement('div');
        overlay.className = 'modal-overlay';
        overlay.id = `modal-${modalId}`;
        overlay.innerHTML = modalHTML;
        
        document.body.appendChild(overlay);
        
        setTimeout(() => {
            overlay.classList.add('show');
        }, 10);
        
        this.setupModalEvents(overlay, modalId, finalData);
        document.body.style.overflow = 'hidden';
        
        return overlay;
    }
    
    createModalHTML(data) {
        const buttonsHTML = data.buttons.map((btn, index) => 
            `<button class="modal-button ${btn.class}" data-action="${index}">
                ${btn.text}
            </button>`
        ).join('');
        
        return `
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-icon ${data.iconClass || ''}">
                        <i class="${data.icon}"></i>
                    </div>
                    <h3 class="modal-title">${data.title}</h3>
                    <p class="modal-subtitle">${data.subtitle}</p>
                </div>
                <div class="modal-actions">
                    ${buttonsHTML}
                </div>
            </div>
        `;
    }
    
    setupModalEvents(overlay, modalId, data) {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                this.closeModal(modalId);
            }
        });
        
        const buttons = overlay.querySelectorAll('.modal-button');
        buttons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                const action = data.buttons[index].action;
                if (typeof action === 'function') {
                    action();
                }
            });
        });
    }
    
    closeModal(modalId) {
        const overlay = document.getElementById(`modal-${modalId}`);
        if (!overlay) return;
        
        overlay.classList.remove('show');
        
        setTimeout(() => {
            if (overlay.parentNode) {
                overlay.parentNode.removeChild(overlay);
            }
            
            if (!this.hasOpenModal()) {
                document.body.style.overflow = '';
            }
        }, 300);
    }
    
    closeAllModals() {
        const modals = document.querySelectorAll('.modal-overlay');
        modals.forEach(modal => {
            modal.classList.remove('show');
            setTimeout(() => {
                if (modal.parentNode) {
                    modal.parentNode.removeChild(modal);
                }
            }, 300);
        });
        
        document.body.style.overflow = '';
    }
    
    hasOpenModal() {
        return document.querySelectorAll('.modal-overlay.show').length > 0;
    }
    
    performLogout() {
        this.closeModal('logout');
        debugLog('User confirmed logout');
        window.location.href = '/logout';
    }
    
    showDeleteFinalConfirmation() {
        this.closeModal('delete');
        
        this.showModal('delete-final', {
            type: 'confirmation',
            icon: 'fas fa-exclamation-triangle',
            iconClass: 'warning',
            title: 'Konfirmasi Terakhir',
            subtitle: 'Tindakan ini tidak dapat dibatalkan. Semua data akan hilang permanen.',
            buttons: [
                {
                    text: 'Batal',
                    class: 'secondary',
                    action: () => this.closeModal('delete-final')
                },
                {
                    text: 'Hapus Akun',
                    class: 'danger',
                    action: () => this.performDeleteAccount()
                }
            ]
        });
    }
    
    performDeleteAccount() {
        this.closeModal('delete-final');
        debugLog('User confirmed account deletion');
        console.log('Delete account requested');
    }
    
    pauseAnimations() {
        document.body.classList.add('paused-animations');
    }
    
    resumeAnimations() {
        document.body.classList.remove('paused-animations');
    }

    checkForSuccessNotification() {
        // Check if there's a success notification from profile update
        const hasSuccess = sessionStorage.getItem('profileUpdateSuccess');
        const message = sessionStorage.getItem('profileUpdateMessage');
        
        if (hasSuccess === 'true' && message) {
            // Clear the session storage
            sessionStorage.removeItem('profileUpdateSuccess');
            sessionStorage.removeItem('profileUpdateMessage');
            
            // Show success modal with custom message
            setTimeout(() => {
                this.showModal('success', {
                    subtitle: message
                });
            }, 500); // Small delay to ensure page is fully loaded
        }
    }
}

// Debug logging function
function debugLog(message, data = null) {
    console.log(`[Profile Debug] ${message}`, data || '');
}

// Error handling function
function handleError(error, context) {
    console.error(`[Profile Error] ${context}:`, error);
}

// Enhanced menu interactions with haptic feedback
function initMenuInteractions() {
    try {
        debugLog('Initializing menu interactions');

        document.querySelectorAll('.menu-item, .action-button').forEach(item => {
            item.addEventListener('click', function() {
                // Add visual feedback
                this.style.transform = 'scale(0.95)';

                // Add haptic feedback if available
                if ('vibrate' in navigator) {
                    navigator.vibrate(50);
                }

                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });

            // Add hover effect for non-touch devices
            item.addEventListener('mouseenter', function() {
                if (!('ontouchstart' in window)) {
                    this.style.transform = 'translateY(-1px)';
                }
            });

            item.addEventListener('mouseleave', function() {
                if (!('ontouchstart' in window)) {
                    this.style.transform = '';
                }
            });
        });

        debugLog('Menu interactions initialized');
    } catch (error) {
        handleError(error, 'Menu interactions initialization');
    }
}

// Initialize animations with stagger effect
function initStaggerAnimation() {
    try {
        debugLog('Initializing stagger animations');

        const elements = document.querySelectorAll('.fade-in, .fade-in-delayed');
        elements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
            el.addEventListener('animationend', function() {
                this.style.opacity = '1';
                this.style.transform = 'translateY(0)';
            });
        });

        debugLog('Stagger animations initialized');
    } catch (error) {
        handleError(error, 'Stagger animations initialization');
    }
}

// Performance optimization
function optimizePerformance() {
    try {
        debugLog('Optimizing performance');

        // Use passive event listeners for better scroll performance
        document.addEventListener('touchstart', function() {}, {
            passive: true
        });
        document.addEventListener('touchmove', function() {}, {
            passive: true
        });

        debugLog('Performance optimization completed');
    } catch (error) {
        handleError(error, 'Performance optimization');
    }
}

// Accessibility improvements
function initAccessibility() {
    try {
        debugLog('Initializing accessibility features');

        document.querySelectorAll('.menu-item').forEach((item, index) => {
            item.setAttribute('tabindex', '0');
            item.setAttribute('role', 'button');
            item.setAttribute('aria-label', item.querySelector('h3').textContent);

            // Keyboard navigation
            item.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        // Add focus indicators
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });

        debugLog('Accessibility features initialized');
    } catch (error) {
        handleError(error, 'Accessibility initialization');
    }
}

// Network status monitoring
function initNetworkMonitoring() {
    try {
        debugLog('Initializing network monitoring');

        function updateNetworkStatus() {
            const status = navigator.onLine ? 'online' : 'offline';
            debugLog('Network status:', status);

            if (navigator.onLine) {
                document.body.classList.remove('offline');
            } else {
                document.body.classList.add('offline');
                if (window.showError) {
                    showError('Tidak Ada Koneksi', 'Periksa koneksi internet Anda');
                }
            }
        }

        window.addEventListener('online', updateNetworkStatus);
        window.addEventListener('offline', updateNetworkStatus);
        updateNetworkStatus();

        debugLog('Network monitoring initialized');
    } catch (error) {
        handleError(error, 'Network monitoring initialization');
    }
}

// Logout function
function logout() {
    try {
        debugLog('Logout initiated');
        if (window.profileMainNavigator) {
            profileMainNavigator.showModal('logout');
        } else {
            // Fallback
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                debugLog('User confirmed logout');
                window.location.href = '/logout';
            }
        }
    } catch (error) {
        handleError(error, 'Logout');
    }
}

// Confirm delete account function
function confirmDelete() {
    try {
        debugLog('Account deletion initiated');
        if (window.profileMainNavigator) {
            profileMainNavigator.showModal('delete');
        } else {
            // Fallback
            if (confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')) {
                debugLog('User confirmed account deletion');
                console.log('Delete account requested');
            }
        }
    } catch (error) {
        handleError(error, 'Account deletion');
    }
}

// Global navigation function
function navigateTo(page) {
    if (window.profileMainNavigator) {
        profileMainNavigator.navigateTo(page);
    } else {
        // Fallback
        const routes = {
            'data-profile': '/profile/data-profile',
            'keamanan': '/profile/keamanan',
            'rekening': '/profile/rekening',
            'kebijakan': '/profile/kebijakan',
            'syarat': '/profile/syarat'
        };
        
        if (routes[page]) {
            window.location.href = routes[page];
        }
    }
}

// Main initialization function
function initProfileMain() {
    try {
        debugLog('Profile page initializing...');

        // Initialize navigation
        window.profileMainNavigator = new ProfileMainNavigator();

        // Initialize page state
        history.replaceState({
            page: 'main'
        }, '', '/profile');

        // Detect if returning from sub-page and add appropriate slide animation
        const isBackNavigation = window.performance.navigation.type === 2 ||
            document.referrer.includes('/profile/') ||
            sessionStorage.getItem('returningToMain') === 'true';

        const mainPageContent = document.getElementById('mainPageContent');
        if (isBackNavigation && mainPageContent) {
            mainPageContent.classList.add('slide-in-from-left');
            sessionStorage.removeItem('returningToMain');
        }

        // Initialize all features
        initStaggerAnimation();
        initMenuInteractions();
        optimizePerformance();
        initAccessibility();
        initNetworkMonitoring();

        // Setup global functions for backward compatibility
        window.navigateTo = navigateTo;
        window.showModal = (modalId, data) => profileMainNavigator.showModal(modalId, data);
        window.closeModal = (modalId) => profileMainNavigator.closeModal(modalId);
        window.showError = (title, subtitle) => profileMainNavigator.showModal('error', { title, subtitle });

        debugLog('Profile page initialized successfully');
    } catch (error) {
        handleError(error, 'Profile initialization');
    }
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', initProfileMain);

// Global error handler
window.addEventListener('error', function(e) {
    handleError(e.error, 'Global error');
    // Show user-friendly error message
    if (window.showError) {
        showError('Terjadi Kesalahan', 'Silakan refresh halaman atau coba lagi nanti');
    }
});
