/*!
 * Vuexy v1.0.0
 * Helpers JS file
 */

'use strict';

window.helpers = {
    // Get CSS variable value
    getCssVar: function (cssVar) {
        return getComputedStyle(document.documentElement).getPropertyValue(cssVar).trim();
    },

    // Get color from CSS variable
    getColor: function (color) {
        return this.getCssVar('--bs-' + color);
    },

    // Get theme color
    getThemeColor: function (themeColor) {
        return this.getCssVar('--bs-' + themeColor);
    },

    // Is RTL
    isRtl: function () {
        return document.dir === 'rtl';
    },

    // Get layout color
    getLayoutColor: function (color) {
        return this.getCssVar('--layout-' + color);
    },

    // Get local storage item
    getStorageItem: function (key) {
        try {
            return JSON.parse(localStorage.getItem(key));
        } catch (e) {
            return localStorage.getItem(key);
        }
    },

    // Set local storage item
    setStorageItem: function (key, value) {
        localStorage.setItem(key, JSON.stringify(value));
    },

    // Remove local storage item
    removeStorageItem: function (key) {
        localStorage.removeItem(key);
    },

    // Debounce function
    debounce: function (func, wait, immediate) {
        var timeout;
        return function () {
            var context = this,
                args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    },

    // Throttle function
    throttle: function (func, limit) {
        var inThrottle;
        return function () {
            var args = arguments;
            var context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(function () {
                    inThrottle = false;
                }, limit);
            }
        };
    },

    // Generate random ID
    generateId: function (prefix) {
        return (prefix ? prefix + '-' : '') + Math.random().toString(36).substr(2, 9);
    },

    // Format number
    formatNumber: function (num, decimals) {
        return num.toLocaleString(undefined, {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        });
    },

    // Format bytes
    formatBytes: function (bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        var k = 1024;
        var dm = decimals < 0 ? 0 : decimals;
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        var i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    },

    // Check if element is in viewport
    isInViewport: function (el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    },

    // Scroll to element
    scrollTo: function (el, offset = 0) {
        var elementPosition = el.getBoundingClientRect().top;
        var offsetPosition = elementPosition + window.pageYOffset - offset;
        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
};