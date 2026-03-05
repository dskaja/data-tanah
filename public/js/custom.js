// ==========================================
// FILE: public/js/custom.js (FINAL VERSION)
// AUTO-EXPAND NESTED MENUS FIXED!
// ==========================================

// Generate animated particles untuk halaman login
if (document.getElementById('particles-container')) {
    function createParticle() {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * 80 + 40;
        particle.style.width = size + 'px';
        particle.style.height = size + 'px';
        
        particle.style.left = Math.random() * window.innerWidth + 'px';
        particle.style.top = Math.random() * window.innerHeight + 'px';
        
        const colors = [
            'rgba(139, 0, 0, 0.2)',
            'rgba(178, 34, 34, 0.2)',
            'rgba(220, 20, 60, 0.15)',
            'rgba(218, 165, 32, 0.2)',
            'rgba(255, 255, 255, 0.1)'
        ];
        particle.style.background = colors[Math.floor(Math.random() * colors.length)];
        
        particle.style.animationDelay = Math.random() * 5 + 's';
        particle.style.animationDuration = (Math.random() * 15 + 15) + 's';
        
        document.getElementById('particles-container').appendChild(particle);
    }

    for (let i = 0; i < 12; i++) {
        createParticle();
    }
}

// Add ripple effect on button click
const loginButton = document.querySelector('.btn-login');
if (loginButton) {
    loginButton.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.5)';
        ripple.style.width = '20px';
        ripple.style.height = '20px';
        ripple.style.left = e.offsetX + 'px';
        ripple.style.top = e.offsetY + 'px';
        ripple.style.animation = 'ripple 0.6s ease-out';
        ripple.style.pointerEvents = 'none';
        
        this.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    });
}

// Add ripple animation dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        from {
            transform: scale(0);
            opacity: 1;
        }
        to {
            transform: scale(20);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Auto hide success/error messages after 5 seconds
const alerts = document.querySelectorAll('.success-message, .error-message, .alert');
alerts.forEach(alert => {
    if (alert.textContent.trim()) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    }
});

// ===== SIDEBAR MENU TOGGLE (FINAL VERSION - AUTO-EXPAND FIXED!) =====
document.addEventListener('DOMContentLoaded', function() {
    
    // ✅ FORCE CLOSE ALL MENUS FIRST (IMPORTANT!)
    function closeAllMenus() {
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('menu-open');
            const submenu = item.querySelector(':scope > .submenu');
            const arrow = item.querySelector(':scope > .menu-toggle .menu-arrow');
            if (submenu) {
                submenu.style.maxHeight = '0';
                submenu.style.overflow = 'hidden';
            }
            if (arrow) {
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    }
    
    // Helper function to get nesting depth
    function getDepth(element) {
        let depth = 0;
        let current = element;
        while (current) {
            if (current.classList?.contains('submenu')) {
                depth++;
            }
            current = current.parentElement;
        }
        return depth;
    }
    
    // Update tinggi parent submenu (IMPROVED)
    function updateParentHeights(element) {
        let parentSubmenu = element.parentElement?.closest('.submenu');
        while (parentSubmenu) {
            const parentMenuItem = parentSubmenu.parentElement;
            if (parentMenuItem?.classList.contains('menu-item') && 
                parentMenuItem.classList.contains('menu-open')) {
                // Give more height buffer for nested content
                parentSubmenu.style.maxHeight = parentSubmenu.scrollHeight + 1000 + 'px';
            }
            parentSubmenu = parentSubmenu.parentElement?.closest('.submenu');
        }
    }
    
    // Fungsi untuk toggle submenu (IMPROVED)
    function toggleSubmenu(menuItem, submenu, arrow) {
        const isOpen = menuItem.classList.contains('menu-open');
        
        if (isOpen) {
            // Tutup submenu
            menuItem.classList.remove('menu-open');
            submenu.style.maxHeight = '0px';
            if (arrow) arrow.style.transform = 'rotate(0deg)';
            
            // Tutup semua child submenu juga
            submenu.querySelectorAll('.menu-item.menu-open').forEach(child => {
                child.classList.remove('menu-open');
                const childSubmenu = child.querySelector(':scope > .submenu');
                const childArrow = child.querySelector(':scope > .menu-toggle .menu-arrow');
                if (childSubmenu) childSubmenu.style.maxHeight = '0px';
                if (childArrow) childArrow.style.transform = 'rotate(0deg)';
            });
        } else {
            // Buka submenu
            menuItem.classList.add('menu-open');
            submenu.style.maxHeight = submenu.scrollHeight + 500 + 'px';
            if (arrow) arrow.style.transform = 'rotate(180deg)';
            
            // Update parent heights
            updateParentHeights(submenu);
            
            // Recalculate after animation
            setTimeout(() => {
                if (menuItem.classList.contains('menu-open')) {
                    submenu.style.maxHeight = submenu.scrollHeight + 500 + 'px';
                    updateParentHeights(submenu);
                }
            }, 100);
        }
    }
    
    // Attach event ke semua menu-toggle
    document.querySelectorAll('.menu-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const menuItem = this.closest('.menu-item');
            const submenu = this.nextElementSibling;
            const arrow = this.querySelector('.menu-arrow');
            
            // Toggle hanya jika ada submenu
            if (submenu && submenu.classList.contains('submenu')) {
                toggleSubmenu(menuItem, submenu, arrow);
            }
        });
    });
    
    // ✅ STEP 1: CLOSE ALL MENUS FIRST
    closeAllMenus();
    
    // IMPROVED: Auto-open menu untuk halaman aktif DAN menu-open dari server
    function openAllParentMenus() {
        // 1. Buka semua menu yang sudah punya class menu-open dari server
        document.querySelectorAll('.menu-item.menu-open').forEach(item => {
            const submenu = item.querySelector(':scope > .submenu');
            const toggle = item.querySelector(':scope > .menu-toggle');
            const arrow = toggle?.querySelector('.menu-arrow');
            
            if (submenu) {
                submenu.style.maxHeight = submenu.scrollHeight + 500 + 'px';
            }
            if (arrow) {
                arrow.style.transform = 'rotate(180deg)';
            }
        });
        
        // 2. Buka semua parent dari menu yang active
        document.querySelectorAll('.menu-link.active').forEach(activeLink => {
            let currentElement = activeLink.parentElement;
            
            // Traverse ke atas sampai ke root
            while (currentElement && currentElement !== document.body) {
                // Jika ini adalah list item dalam submenu
                if (currentElement.tagName === 'LI' && currentElement.parentElement?.classList.contains('submenu')) {
                    const submenu = currentElement.parentElement;
                    const menuItem = submenu.parentElement;
                    
                    if (menuItem?.classList.contains('menu-item')) {
                        menuItem.classList.add('menu-open');
                        submenu.style.maxHeight = submenu.scrollHeight + 500 + 'px';
                        
                        const toggle = menuItem.querySelector(':scope > .menu-toggle');
                        const arrow = toggle?.querySelector('.menu-arrow');
                        if (arrow) {
                            arrow.style.transform = 'rotate(180deg)';
                        }
                    }
                }
                
                currentElement = currentElement.parentElement;
            }
        });
        
        // 3. Recalculate heights untuk nested menus (dari dalam ke luar)
        setTimeout(() => {
            const allSubmenus = Array.from(document.querySelectorAll('.submenu'));
            // Sort by nesting level (deepest first)
            allSubmenus.sort((a, b) => {
                const depthA = getDepth(a);
                const depthB = getDepth(b);
                return depthB - depthA;
            });
            
            allSubmenus.forEach(submenu => {
                if (submenu.closest('.menu-item')?.classList.contains('menu-open')) {
                    submenu.style.maxHeight = submenu.scrollHeight + 500 + 'px';
                }
            });
        }, 100);
    }
    
    // ✅ STEP 2: THEN OPEN ONLY ACTIVE MENUS
    setTimeout(() => {
        openAllParentMenus();
    }, 50);
});

// ===== CUSTOM CONFIRM DIALOG =====
function customConfirm(message, callback) {
    // Create overlay
    const overlay = document.createElement('div');
    overlay.className = 'custom-confirm-overlay';
    
    // Create confirm box
    overlay.innerHTML = `
        <div class="custom-confirm-box">
            <div class="custom-confirm-header">
                <h3 class="custom-confirm-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Konfirmasi Hapus
                </h3>
            </div>
            <div class="custom-confirm-body">
                <p class="custom-confirm-message">${message}</p>
            </div>
            <div class="custom-confirm-footer">
                <button class="custom-confirm-btn custom-confirm-btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button class="custom-confirm-btn custom-confirm-btn-confirm">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(overlay);
    
    // Handle buttons
    const btnCancel = overlay.querySelector('.custom-confirm-btn-cancel');
    const btnConfirm = overlay.querySelector('.custom-confirm-btn-confirm');
    
    btnCancel.onclick = () => {
        overlay.remove();
        if (callback) callback(false);
    };
    
    btnConfirm.onclick = () => {
        overlay.remove();
        if (callback) callback(true);
    };
    
    // Close on overlay click
    overlay.onclick = (e) => {
        if (e.target === overlay) {
            overlay.remove();
            if (callback) callback(false);
        }
    };
}

// Override all delete forms to use custom confirm
document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
    
    deleteForms.forEach(form => {
        // Remove default confirm
        form.removeAttribute('onsubmit');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            customConfirm('Yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.', (confirmed) => {
                if (confirmed) {
                    form.submit();
                }
            });
        });
    });
});

// Confirm logout
const logoutButtons = document.querySelectorAll('.btn-logout, .btn-logout-sidebar');
logoutButtons.forEach(button => {
    button.addEventListener('click', function(e) {
        if (button.tagName === 'BUTTON' && !confirm('Apakah Anda yakin ingin logout?')) {
            e.preventDefault();
        }
    });
});