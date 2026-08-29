/**
 * Theme Manager
 * Handles light/dark theme switching with localStorage persistence
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
        
        this.setTheme(themeToUse);
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
    setTheme(theme) {
        if (theme !== this.LIGHT && theme !== this.DARK) {
            theme = this.LIGHT;
        }

        // Set data attribute on html
        document.documentElement.setAttribute('data-theme', theme);
        
        // Update button/icon states if they exist
        this.updateThemeButtons(theme);
        
        // Save to localStorage
        localStorage.setItem(this.THEME_KEY, theme);

        // Dispatch custom event for other listeners
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme } }));
    },

    /**
     * Toggle between light and dark theme
     */
    toggle() {
        const currentTheme = document.documentElement.getAttribute('data-theme') || this.LIGHT;
        const newTheme = currentTheme === this.LIGHT ? this.DARK : this.LIGHT;
        this.setTheme(newTheme);
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
                button.innerHTML = '<i class="bi bi-sun-fill"></i>';
                button.setAttribute('aria-label', 'Switch to Light Mode');
                button.title = 'Switch to Light Mode';
            } else {
                button.innerHTML = '<i class="bi bi-moon-fill"></i>';
                button.setAttribute('aria-label', 'Switch to Dark Mode');
                button.title = 'Switch to Dark Mode';
            }
        });
    }
};

// Initialize theme on page load
document.addEventListener('DOMContentLoaded', () => {
    ThemeManager.init();
});

// Setup theme toggle buttons
document.addEventListener('DOMContentLoaded', () => {
    const themeButtons = document.querySelectorAll('[data-toggle-theme]');
    
    themeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            ThemeManager.toggle();
        });
    });
});

// Listen for system theme changes
if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        // Only apply system theme if user hasn't saved a preference
        if (!localStorage.getItem(ThemeManager.THEME_KEY)) {
            ThemeManager.setTheme(e.matches ? ThemeManager.DARK : ThemeManager.LIGHT);
        }
    });
}
