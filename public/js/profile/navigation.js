/**
 * PROFILE NAVIGATION SYSTEM
 * Handles slide animations, modals, and page transitions
 * Optimized for iPad Pro 12.9" (1024x1366) and mobile responsive
 */

class ProfileNavigator {
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
        this.preloadPages();
    }
    
    setupEventListeners() {
        // Handle browser back button
        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.page) {
                this.navigateToPage(e.state.page, false, true);
            } else {
                this.goBack();
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
        
        // Handle orientation change
        window.addEventListener('orientationchange', () => {
            setTimeout(() => {
                this.adjustForOrientation();
            }, 100);
        });
    }
    
    setupKeyboardNavigation() {
        document.addEventListener('keydown', (e) => {
            // ESC key to go back or close modal
            if (e.key === 'Escape') {
                if (this.hasOpenModal()) {
                    this.closeAllModals();
                } else if (this.currentPage !== 'main') {
                    this.goBack();
                }
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
        
        // Save changes confirmation modal
        this.modals.set('save', {
            type: 'confirmation',
            icon: 'fas fa-save',
            iconClass: 'primary',
            title: 'Simpan perubahan?',
            subtitle: 'Data yang telah diubah akan disimpan secara permanen',
            buttons: [
                {
                    text: 'Kembali',
                    class: 'secondary',
                    action: () => this.closeModal('save')
                },
                {
                    text: 'Ya',
                    class: 'primary',
                    action: () => this.performSave()
                }
            ]
        });
        
        // Success modal
        this.modals.set('success', {
            type: 'notification',
            icon: 'fas fa-check-circle',
            iconClass: 'primary',
            title: 'Berhasil!',
            subtitle: 'Data telah disimpan dengan sukses',
            buttons: [
                {
                    text: 'OK',
                    class: 'primary',
                    action: () => this.closeModal('success')
                }
            ]
        });
        
        // Error modal
        this.modals.set('error', {
            type: 'notification',
            icon: 'fas fa-exclamation-circle',
            iconClass: 'warning',
            title: 'Terjadi Kesalahan',
            subtitle: 'Silakan coba lagi dalam beberapa saat',
            buttons: [
                {
                    text: 'OK',
                    class: 'primary',
                    action: () => this.closeModal('error')
                }
            ]
        });
    }
    
    // Navigation Methods
    navigateTo(page) {
        if (this.isTransitioning || page === this.currentPage) return;
        
        const routes = {
            'data-profil': '/profile/detail',
            'keamanan': '/profile/changepass',
            'rekening': '/profile/changerekening',
            'kebijakan': '/profile/kebijakanprivasi',
            'syarat': '/profile/syaratketentuan'
        };
        
        if (routes[page]) {
            this.slideToPage(routes[page], page);
        }
    }
    
    slideToPage(url, pageKey) {
        this.isTransitioning = true;
      
        
        // Add to page stack
        this.pageStack.push(pageKey);
        
        // Update browser history
        history.pushState({ page: pageKey }, '', url);
        
        setTimeout(() => {
            window.location.href = url;
        }, 300);
    }
    
    goBack() {
        if (this.isTransitioning) return;
        
        if (this.pageStack.length > 1) {
            this.pageStack.pop();
            const previousPage = this.pageStack[this.pageStack.length - 1];
            
            if (previousPage === 'main') {
                this.slideBackToMain();
            } else {
                history.back();
            }
        }
    }
    
    slideBackToMain() {
        this.isTransitioning = true;
      
        
        setTimeout(() => {
            window.location.href = '/profile';
        }, 300);
    }
    
    // Modal Methods
    showModal(modalId, customData = {}) {
        const modalData = this.modals.get(modalId);
        if (!modalData) return;
        
        // Merge custom data
        const finalData = { ...modalData, ...customData };
        
        const modalHTML = this.createModalHTML(finalData);
        const overlay = document.createElement('div');
        overlay.className = 'modal-overlay';
        overlay.id = `modal-${modalId}`;
        overlay.innerHTML = modalHTML;
        
        document.body.appendChild(overlay);
        
        // Show modal with animation
        setTimeout(() => {
            overlay.classList.add('show');
        }, 10);
        
        // Setup button events
        this.setupModalEvents(overlay, modalId, finalData);
        
        // Focus management
        this.focusModal(overlay);
        
        // Prevent body scroll
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
                ${data.body ? `<div class="modal-body">${data.body}</div>` : ''}
                <div class="modal-actions">
                    ${buttonsHTML}
                </div>
            </div>
        `;
    }
    
    setupModalEvents(overlay, modalId, data) {
        // Close on overlay click
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) {
                this.closeModal(modalId);
            }
        });
        
        // Button actions
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
            
            // Restore body scroll
            if (!this.hasOpenModal()) {
                document.body.style.overflow = '';
            }
            
            // Restore focus
            this.restoreFocus();
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
        this.restoreFocus();
    }
    
    hasOpenModal() {
        return document.querySelectorAll('.modal-overlay.show').length > 0;
    }
    
    // Action Methods
    performLogout() {
        this.closeModal('logout');
        this.showLoadingButton('logout');
        
        // Simulate logout process
        setTimeout(() => {
            console.log('Logging out...');
            // window.location.href = '/logout';
            this.showModal('success', {
                title: 'Berhasil Logout',
                subtitle: 'Anda akan diarahkan ke halaman login'
            });
        }, 1500);
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
        this.showLoadingButton('delete');
        
        // Simulate delete process
        setTimeout(() => {
            console.log('Deleting account...');
            this.showModal('success', {
                title: 'Akun Terhapus',
                subtitle: 'Akun Anda telah berhasil dihapus'
            });
        }, 2000);
    }
    
    performSave() {
        this.closeModal('save');
        this.showLoadingButton('save');
        
        // Simulate save process
        setTimeout(() => {
            console.log('Saving changes...');
            this.showModal('success');
        }, 1000);
    }
    
    
    showLoadingButton(buttonType) {
        // Add loading state to button if needed
        console.log(`Loading ${buttonType}...`);
    }
    
    focusModal(overlay) {
        const firstButton = overlay.querySelector('.modal-button');
        if (firstButton) {
            setTimeout(() => {
                firstButton.focus();
            }, 100);
        }
    }
    
    restoreFocus() {
        // Restore focus to the element that triggered the modal
        const lastFocused = document.activeElement;
        if (lastFocused && lastFocused.blur) {
            lastFocused.blur();
        }
    }
    
    preloadPages() {
        // Preload critical pages for better performance
        const criticalPages = [
            '/profile/detail',
            '/profile/changepass'
        ];
        
        criticalPages.forEach(page => {
            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = page;
            document.head.appendChild(link);
        });
    }
    
    adjustForOrientation() {
        // Adjust modal positioning for orientation changes
        const modals = document.querySelectorAll('.modal-overlay.show');
        modals.forEach(modal => {
            // Force reflow
            modal.style.display = 'none';
            modal.offsetHeight; // trigger reflow
            modal.style.display = 'flex';
        });
    }
    
    pauseAnimations() {
        document.body.classList.add('paused-animations');
    }
    
    resumeAnimations() {
        document.body.classList.remove('paused-animations');
    }
}

// Global Navigation Functions (for backward compatibility)
let profileNavigator;

function initProfileNavigation() {
    profileNavigator = new ProfileNavigator();
    
    // Setup global functions
    window.navigateTo = (page) => profileNavigator.navigateTo(page);
    window.goBack = () => profileNavigator.goBack();
    window.showModal = (modalId, data) => profileNavigator.showModal(modalId, data);
    window.closeModal = (modalId) => profileNavigator.closeModal(modalId);
    
    // Setup page-specific functions
    window.logout = () => profileNavigator.showModal('logout');
    window.confirmDelete = () => profileNavigator.showModal('delete');
    window.saveChanges = () => profileNavigator.showModal('save');
    window.showSuccess = (title, subtitle) => profileNavigator.showModal('success', { title, subtitle });
    window.showError = (title, subtitle) => profileNavigator.showModal('error', { title, subtitle });
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
        if (deltaX > 50 && Math.abs(deltaY) < 100 && profileNavigator && profileNavigator.currentPage !== 'main') {
            profileNavigator.goBack();
        }
    });
}

// Performance Monitoring
function initPerformanceMonitoring() {
    // Monitor animation performance
    let animationFrameId;
    let lastTime = performance.now();
    
    function monitorFrame(currentTime) {
        const delta = currentTime - lastTime;
        if (delta > 20) { // More than 20ms indicates performance issues
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

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initProfileNavigation();
    initPageAnimations();
    initTouchGestures();
    initPerformanceMonitoring();
    
    // Add accessibility improvements
    document.body.setAttribute('role', 'application');
    document.body.setAttribute('aria-label', 'Profile Navigation');
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { ProfileNavigator, initProfileNavigation };
}
