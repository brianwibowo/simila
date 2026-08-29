/**
 * Theme Manager for SIMILA
 * Handles light/dark theme switching with localStorage persistence & KaiAdmin sync
 */

const ThemeManager = {
    THEME_KEY: 'app-theme',
    LIGHT: 'light',
    DARK: 'dark',

    /**
     * Initialize theme on page load
     */
    init() {
        const savedTheme = this.getSavedTheme();
        const systemTheme = this.getSystemTheme();
        const themeToUse = savedTheme || systemTheme;
        
        this.setTheme(themeToUse, false);
    },

    /**
     * Get saved theme from localStorage
     */
    getSavedTheme() {
        return localStorage.getItem(this.THEME_KEY);
    },

    /**
     * Get system/OS theme preference
     */
    getSystemTheme() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return this.DARK;
        }
        return this.LIGHT;
    },

    /**
     * Set theme and update DOM
     */
    setTheme(theme, animate = true) {
        if (theme !== this.LIGHT && theme !== this.DARK) {
            theme = this.LIGHT;
        }

        // Set data attribute on html & body
        document.documentElement.setAttribute('data-theme', theme);
        if (document.body) {
            document.body.setAttribute('data-theme', theme);
        }
        
        // Synchronize KaiAdmin specific data-background-color attributes
        this.syncKaiAdmin(theme);

        // Update button/icon states
        this.updateThemeButtons(theme);
        
        // Save to localStorage
        localStorage.setItem(this.THEME_KEY, theme);

        // Dispatch custom event
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme } }));
    },

    /**
     * Sync sidebar and logo header data-background-color for KaiAdmin
     */
    syncKaiAdmin(theme) {
        const sidebars = document.querySelectorAll('.sidebar, .logo-header');
        sidebars.forEach(el => {
            if (theme === this.DARK) {
                el.setAttribute('data-background-color', 'dark');
            } else {
                el.setAttribute('data-background-color', 'white');
            }
        });
    },

    /**
     * Toggle between light and dark theme
     */
    toggle() {
        const currentTheme = document.documentElement.getAttribute('data-theme') || this.LIGHT;
        const newTheme = currentTheme === this.LIGHT ? this.DARK : this.LIGHT;
        this.setTheme(newTheme, true);
    },

    /**
     * Get current theme
     */
    getCurrentTheme() {
        return document.documentElement.getAttribute('data-theme') || this.LIGHT;
    },

    /**
     * Update theme button states
     */
    updateThemeButtons(theme) {
        const themeButtons = document.querySelectorAll('[data-toggle-theme]');
        
        themeButtons.forEach(button => {
            if (theme === this.DARK) {
                button.innerHTML = '<i class="bi bi-sun-fill text-warning fs-5"></i>';
                button.setAttribute('aria-label', 'Beralih ke Mode Terang (Light Mode)');
                button.title = 'Beralih ke Mode Terang (Light Mode)';
                button.classList.add('btn-theme-dark');
                button.classList.remove('btn-theme-light');
            } else {
                button.innerHTML = '<i class="bi bi-moon-stars-fill text-primary fs-5"></i>';
                button.setAttribute('aria-label', 'Beralih ke Mode Gelap (Dark Mode)');
                button.title = 'Beralih ke Mode Gelap (Dark Mode)';
                button.classList.add('btn-theme-light');
                button.classList.remove('btn-theme-dark');
            }
        });
    }
};

// Initialize theme on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        ThemeManager.init();
        setupToggleListeners();
    });
} else {
    ThemeManager.init();
    setupToggleListeners();
}

function setupToggleListeners() {
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-toggle-theme]');
        if (btn) {
            e.preventDefault();
            ThemeManager.toggle();
        }
    });
}

// Listen for system theme changes
if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem(ThemeManager.THEME_KEY)) {
            ThemeManager.setTheme(e.matches ? ThemeManager.DARK : ThemeManager.LIGHT);
        }
    });
}

window.ThemeManager = ThemeManager;
