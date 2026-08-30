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
        setupLogoutConfirmation();
    });
} else {
    ThemeManager.init();
    setupToggleListeners();
    setupLogoutConfirmation();
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

/**
 * Global Logout Confirmation Toast/Modal Handler
 */
function setupLogoutConfirmation() {
    let pendingLogoutForm = null;

    document.addEventListener('submit', (e) => {
        const form = e.target;
        if (form && form.action && form.action.includes('logout') && !form.dataset.confirmed) {
            e.preventDefault();
            pendingLogoutForm = form;
            showLogoutModal();
        }
    });

    const confirmBtn = document.getElementById('confirmLogoutSubmitBtn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            if (pendingLogoutForm) {
                pendingLogoutForm.dataset.confirmed = 'true';
                confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Mengeluarkan...';
                confirmBtn.disabled = true;
                pendingLogoutForm.submit();
            } else {
                const fallbackForm = document.querySelector('form[action*="logout"]');
                if (fallbackForm) {
                    fallbackForm.dataset.confirmed = 'true';
                    confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Mengeluarkan...';
                    confirmBtn.disabled = true;
                    fallbackForm.submit();
                }
            }
        });
    }

    function showLogoutModal() {
        const modalEl = document.getElementById('logoutConfirmModal');
        if (modalEl && window.bootstrap && window.bootstrap.Modal) {
            const modal = window.bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        } else if (window.swal) {
            window.swal({
                title: 'Yakin ingin keluar?',
                text: 'Sesi login Anda saat ini akan diakhiri.',
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: 'Batal',
                        visible: true,
                        className: 'btn btn-light rounded-pill px-4',
                        closeModal: true,
                    },
                    confirm: {
                        text: 'Ya, Keluar',
                        className: 'btn btn-danger rounded-pill px-4',
                        closeModal: true,
                    }
                },
                dangerMode: true,
            }).then((willLogout) => {
                if (willLogout) {
                    if (pendingLogoutForm) {
                        pendingLogoutForm.dataset.confirmed = 'true';
                        pendingLogoutForm.submit();
                    } else {
                        const fallbackForm = document.querySelector('form[action*="logout"]');
                        if (fallbackForm) {
                            fallbackForm.dataset.confirmed = 'true';
                            fallbackForm.submit();
                        }
                    }
                }
            });
        } else {
            if (confirm('Apakah Anda yakin ingin keluar dari sistem SIMILA?')) {
                if (pendingLogoutForm) {
                    pendingLogoutForm.dataset.confirmed = 'true';
                    pendingLogoutForm.submit();
                }
            }
        }
    }
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

