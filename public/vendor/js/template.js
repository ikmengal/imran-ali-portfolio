/*!
 * Vuexy v1.0.0
 * Template JS file
 */

'use strict';

(function () {
    'use strict';

    // Initialize Perfect Scrollbar for menu
    const initMenuScrollbar = () => {
        if (typeof PerfectScrollbar !== 'undefined') {
            const menuInner = document.querySelector('.menu-inner');
            if (menuInner) {
                new PerfectScrollbar(menuInner, {
                    wheelPropagation: false,
                    suppressScrollX: true
                });
            }
        }
    };

    // Menu collapsed state
    const initMenuCollapsed = () => {
        const layoutMenu = document.getElementById('layout-menu');
        const layoutWrapper = document.querySelector('.layout-wrapper');
        
        if (!layoutMenu || !layoutWrapper) return;

        // Check localStorage for collapsed state
        const isCollapsed = localStorage.getItem('menuCollapsed') === 'true';
        if (isCollapsed) {
            layoutWrapper.classList.add('layout-menu-collapsed');
        }

        // Toggle collapsed state
        const menuToggle = document.querySelector('.layout-menu-toggle');
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                layoutWrapper.classList.toggle('layout-menu-collapsed');
                localStorage.setItem('menuCollapsed', layoutWrapper.classList.contains('layout-menu-collapsed'));
            });
        }
    };

    // Menu hover state for collapsed menu
    const initMenuHover = () => {
        const layoutWrapper = document.querySelector('.layout-wrapper');
        const layoutMenu = document.getElementById('layout-menu');
        
        if (!layoutWrapper || !layoutMenu) return;

        layoutMenu.addEventListener('mouseenter', () => {
            if (layoutWrapper.classList.contains('layout-menu-collapsed')) {
                layoutWrapper.classList.add('layout-menu-hover');
            }
        });

        layoutMenu.addEventListener('mouseleave', () => {
            layoutWrapper.classList.remove('layout-menu-hover');
        });
    };

    // Initialize all template functionality
    const initTemplate = () => {
        initMenuScrollbar();
        initMenuCollapsed();
        initMenuHover();
    };

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTemplate);
    } else {
        initTemplate();
    }

    // Expose for manual initialization
    window.Template = {
        init: initTemplate,
        initMenuScrollbar,
        initMenuCollapsed,
        initMenuHover
    };

})();