/*!
 * Vuexy v1.0.0
 * Main JS file
 */

'use strict';

(function () {
    'use strict';

    // Menu active state
    const menuItems = document.querySelectorAll('.menu-item a.menu-link');
    menuItems.forEach(item => {
        item.addEventListener('click', function (e) {
            const parent = this.parentElement;
            const isActive = parent.classList.contains('active');
            
            // Remove active from all siblings
            document.querySelectorAll('.menu-item').forEach(li => {
                li.classList.remove('active');
                li.classList.remove('open');
            });
            
            if (!isActive) {
                parent.classList.add('active');
                
                // Add open to parent menu items
                let current = parent.parentElement.closest('.menu-item');
                while (current) {
                    current.classList.add('open');
                    current = current.parentElement.closest('.menu-item');
                }
            }
        });
    });

    // Mobile menu toggle
    const menuToggle = document.querySelector('.layout-menu-toggle');
    const layoutMenu = document.getElementById('layout-menu');
    const layoutOverlay = document.querySelector('.layout-overlay');
    
    if (menuToggle && layoutMenu) {
        menuToggle.addEventListener('click', function () {
            layoutMenu.classList.toggle('show');
            layoutOverlay?.classList.toggle('show');
        });
    }
    
    if (layoutOverlay) {
        layoutOverlay.addEventListener('click', function () {
            layoutMenu?.classList.remove('show');
            this.classList.remove('show');
        });
    }

    // Perfect Scrollbar for menu
    if (typeof PerfectScrollbar !== 'undefined') {
        const menuScroll = document.querySelector('.menu-inner');
        if (menuScroll) {
            new PerfectScrollbar(menuScroll, {
                wheelPropagation: false,
                suppressScrollX: true
            });
        }
    }

    // Navbar user dropdown
    const userDropdown = document.querySelector('.dropdown-user');
    if (userDropdown) {
        userDropdown.addEventListener('show.bs.dropdown', function () {
            this.querySelector('.dropdown-menu')?.classList.add('show');
        });
        userDropdown.addEventListener('hide.bs.dropdown', function () {
            this.querySelector('.dropdown-menu')?.classList.remove('show');
        });
    }

    // Auto-hide alerts
    document.querySelectorAll('.alert-dismissible').forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

})();