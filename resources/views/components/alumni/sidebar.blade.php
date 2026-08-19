<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header d-flex align-items-center justify-content-between px-3" data-background-color="dark">
            <a href="{{ route('alumni-dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
                <span class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px; min-width: 36px; border: 2px solid rgba(255,255,255,0.25);">
                    <img src="{{ asset('template/assets/img/kaiadmin/favicon.png') }}" alt="SIMILA" style="width: 22px; height: 22px; object-fit: contain;" />
                </span>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Route::currentRouteName() == 'perusahaan-dashboard' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('alumni-scouting*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts"
                        aria-expanded="{{ request()->routeIs('alumni-scouting*') ? 'true' : 'false' }}">
                        <i class="fas fa-th-list"></i>
                        <p>Talent Scouting</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('alumni-scouting*') ? 'show' : '' }}"
                        id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'alumni-scouting-index' ? 'active' : '' }}">
                                <a href="{{ route('alumni-scouting-index') }}">
                                    <span class="sub-item">Peluang Beasiswa</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'alumni-scouting-status' ? 'active' : '' }}">
                                <a href="{{ route('alumni-scouting-status') }}">
                                    <span class="sub-item">Status Seleksi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle untuk menu Riset & Inovasi Produk
        document.querySelector('a[href="#chart"]').addEventListener('click', function(e) {
            e.preventDefault();
            const submenu = document.getElementById('submenu');
            submenu.classList.toggle('show');
        });

        // Toggle untuk menu Beasiswa Talent Scout
        document.querySelector('a[href="#char"]').addEventListener('click', function(e) {
            e.preventDefault();
            const subnav2 = document.getElementById('subnav2');
            subnav2.classList.toggle('show');
        });
    });
</script>
