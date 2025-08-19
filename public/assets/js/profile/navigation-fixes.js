/**
 * NAVIGATION DEBUGGING AND FIXES
 * Additional JavaScript to fix click and scroll issues
 */

// Debug function to test back button functionality
function debugBackButton() {
    console.log('🔧 Debugging back button...');
    
    const backButton = document.querySelector('.back-button');
    if (!backButton) {
        console.error('❌ Back button not found!');
        return;
    }
    
    console.log('✅ Back button found:', backButton);
    console.log('📊 Button styles:', window.getComputedStyle(backButton));
    console.log('📊 Button position:', backButton.getBoundingClientRect());
    console.log('📊 Pointer events:', window.getComputedStyle(backButton).pointerEvents);
    console.log('📊 Z-index:', window.getComputedStyle(backButton).zIndex);
    
    // Test if button is clickable
    const rect = backButton.getBoundingClientRect();
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;
    const elementAtCenter = document.elementFromPoint(centerX, centerY);
    
    console.log('📊 Element at button center:', elementAtCenter);
    
    if (elementAtCenter !== backButton && !backButton.contains(elementAtCenter)) {
        console.warn('⚠️ Something is blocking the back button!');
        console.log('🚫 Blocking element:', elementAtCenter);
        
        // Try to fix by adjusting z-index
        backButton.style.zIndex = '99999';
        backButton.style.position = 'relative';
        console.log('🔧 Applied emergency z-index fix');
    }
}

// Fix scroll issues
function fixScrolling() {
    console.log('🔧 Fixing scroll issues...');
    
    // Remove any height restrictions
    const containers = document.querySelectorAll('.page-container, .page-content, .profile-detail-container, .changepass-container, .changerekening-container, .kebijakan-privasi-container, .syarat-ketentuan-container');
    
    containers.forEach(container => {
        if (container) {
            container.style.height = 'auto';
            container.style.maxHeight = 'none';
            container.style.overflow = 'visible';
            container.style.overflowY = 'auto';
            container.style.position = 'relative';
        }
    });
    
    // Ensure body can scroll
    document.body.style.overflow = 'auto';
    document.body.style.height = 'auto';
    document.documentElement.style.overflow = 'auto';
    document.documentElement.style.height = 'auto';
    
    console.log('✅ Scroll fixes applied');
}

// Enhanced back button click handler
function enhancedGoBack() {
    console.log('🔙 Enhanced go back triggered');
    
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
    
    // Multiple fallback methods
    try {
        if (window.profileNavigator && typeof window.profileNavigator.goBack === 'function') {
            console.log('🔙 Using profileNavigator.goBack()');
            window.profileNavigator.goBack();
        } else if (window.history.length > 1) {
            console.log('🔙 Using window.history.back()');
            window.location.href = '/profile';
        } else {
            console.log('🔙 Redirecting to profile main');
            window.location.href = '/profile';
        }
    } catch (error) {
        console.error('❌ Error in goBack:', error);
        window.location.href = '/profile';
    }
}

// Force click handler attachment
function forceAttachClickHandlers() {
    console.log('🔧 Force attaching click handlers...');
    
    const backButtons = document.querySelectorAll('.back-button');
    
    backButtons.forEach((button, index) => {
        console.log(`🔧 Processing back button ${index + 1}:`, button);
        
        // Remove existing listeners
        button.removeEventListener('click', enhancedGoBack);
        
        // Add multiple event listeners for maximum compatibility
        button.addEventListener('click', enhancedGoBack, { passive: false });
        button.addEventListener('touchstart', function(e) {
            console.log('👆 Touch start on back button');
            button.style.transform = 'scale(0.95)';
        }, { passive: false });
        
        button.addEventListener('touchend', function(e) {
            console.log('👆 Touch end on back button');
            e.preventDefault();
            button.style.transform = '';
            enhancedGoBack();
        }, { passive: false });
        
        // Mouse events
        button.addEventListener('mousedown', function(e) {
            console.log('🖱️ Mouse down on back button');
            button.style.transform = 'scale(0.95)';
        });
        
        button.addEventListener('mouseup', function(e) {
            console.log('🖱️ Mouse up on back button');
            button.style.transform = '';
        });
        
        // Keyboard support
        button.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                enhancedGoBack();
            }
        });
        
        // Make sure button is focusable
        button.tabIndex = 0;
        button.setAttribute('role', 'button');
        button.setAttribute('aria-label', 'Kembali');
        
        console.log('✅ Enhanced click handlers attached to button', index + 1);
    });
}

// Emergency click fix
function emergencyClickFix() {
    console.log('🚨 Applying emergency click fix...');
    
    const backButtons = document.querySelectorAll('.back-button');
    
    backButtons.forEach((button, index) => {
        // Force styles
        button.style.cssText += `
            position: relative !important;
            z-index: 99999 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        `;
        
        // Create click overlay if needed
        if (!button.querySelector('.click-overlay')) {
            const overlay = document.createElement('div');
            overlay.className = 'click-overlay';
            overlay.style.cssText = `
                position: absolute;
                top: -10px;
                left: -10px;
                right: -10px;
                bottom: -10px;
                cursor: pointer;
                z-index: 1;
            `;
            
            overlay.addEventListener('click', enhancedGoBack);
            button.appendChild(overlay);
            
            console.log(`🚨 Emergency click overlay added to button ${index + 1}`);
        }
    });
}

// Test function to verify functionality
function testBackButtonFunctionality() {
    console.log('🧪 Testing back button functionality...');
    
    const backButton = document.querySelector('.back-button');
    if (!backButton) {
        console.error('❌ No back button found for testing');
        return false;
    }
    
    // Test 1: Element exists
    console.log('✅ Test 1 passed: Back button exists');
    
    // Test 2: Is visible
    const rect = backButton.getBoundingClientRect();
    const isVisible = rect.width > 0 && rect.height > 0;
    console.log(`${isVisible ? '✅' : '❌'} Test 2: Back button is visible (${rect.width}x${rect.height})`);
    
    // Test 3: Has click handler
    const hasClickHandler = backButton.onclick !== null || backButton.getAttribute('onclick') !== null;
    console.log(`${hasClickHandler ? '✅' : '❌'} Test 3: Back button has click handler`);
    
    // Test 4: Is not blocked
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;
    const elementAtCenter = document.elementFromPoint(centerX, centerY);
    const isNotBlocked = elementAtCenter === backButton || backButton.contains(elementAtCenter);
    console.log(`${isNotBlocked ? '✅' : '❌'} Test 4: Back button is not blocked by other elements`);
    
    if (!isNotBlocked) {
        console.log('🚫 Blocking element:', elementAtCenter);
    }
    
    // Test 5: Can receive focus
    try {
        backButton.focus();
        const canFocus = document.activeElement === backButton;
        console.log(`${canFocus ? '✅' : '❌'} Test 5: Back button can receive focus`);
    } catch (e) {
        console.log('❌ Test 5: Back button cannot receive focus:', e);
    }
    
    return isVisible && isNotBlocked;
}

// Auto-fix function
function autoFixBackButton() {
    console.log('🔧 Auto-fixing back button issues...');
    
    // Step 1: Debug current state
    debugBackButton();
    
    // Step 2: Fix scrolling
    fixScrolling();
    
    // Step 3: Force attach handlers
    forceAttachClickHandlers();
    
    // Step 4: Test functionality
    const isWorking = testBackButtonFunctionality();
    
    // Step 5: Apply emergency fix if needed
    if (!isWorking) {
        console.log('🚨 Back button not working, applying emergency fix...');
        emergencyClickFix();
    }
    
    console.log('✅ Auto-fix complete');
}

// Initialize fixes when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Navigation fixes initializing...');
    
    // Apply fixes after a short delay to ensure all elements are rendered
    setTimeout(() => {
        autoFixBackButton();
    }, 100);
    
    // Add debug command to console
    window.debugBackButton = debugBackButton;
    window.fixScrolling = fixScrolling;
    window.autoFixBackButton = autoFixBackButton;
    window.testBackButtonFunctionality = testBackButtonFunctionality;
    
    console.log('🔧 Debug functions available: debugBackButton(), fixScrolling(), autoFixBackButton(), testBackButtonFunctionality()');
});

// Re-apply fixes on window resize
window.addEventListener('resize', function() {
    setTimeout(autoFixBackButton, 100);
});

// Override global goBack function
window.goBack = enhancedGoBack;

// Add global error handler
window.addEventListener('error', function(e) {
    if (e.message.includes('goBack') || e.message.includes('back-button')) {
        console.error('❌ Navigation error detected:', e);
        console.log('🔧 Attempting auto-fix...');
        autoFixBackButton();
    }
});

// Console message
console.log('🔧 Navigation fixes loaded. Use autoFixBackButton() if issues persist.');
