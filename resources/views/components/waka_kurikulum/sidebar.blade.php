<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header d-flex align-items-center justify-content-between px-3" data-background-color="dark">
            <a href="{{ route('waka-kurikulum-dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
                <span class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px; min-width: 36px; border: 2px solid rgba(255,255,255,0.25);">
                    <img src="{{ asset('template/assets/img/kaiadmin/favicon.png') }}" alt="SIMILA" style="width: 22px; height: 22px; object-fit: contain;" />
                </span>
            </a>
            <div class="nav-toggle d-flex align-items-center">
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
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Route::currentRouteName() == 'waka-kurikulum-dashboard' ? 'active' : '' }}">
                    <a href="{{ route('waka-kurikulum-dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('waka-kurikulum-list*') || request()->routeIs('waka-kurikulum-create') || request()->routeIs('waka-kurikulum-edit') || request()->routeIs('waka-kurikulum-store') || request()->routeIs('waka-kurikulum-update') || request()->routeIs('waka-kurikulum-destroy') || request()->routeIs('waka-kurikulum-setuju') || request()->routeIs('waka-kurikulum-tolak') || request()->routeIs('waka-kurikulum-show') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Kurikulum Bersama</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('waka-kurikulum-list*') || request()->routeIs('waka-kurikulum-create') || request()->routeIs('waka-kurikulum-edit') || request()->routeIs('waka-kurikulum-store') || request()->routeIs('waka-kurikulum-update') || request()->routeIs('waka-kurikulum-destroy') || request()->routeIs('waka-kurikulum-setuju') || request()->routeIs('waka-kurikulum-tolak') || request()->routeIs('waka-kurikulum-show') ? 'show' : '' }}"
                        id="base">
                        <ul class="nav nav-collapse">
                            <li
                                class="{{ request()->routeIs('waka-kurikulum-list-diajukan') || request()->routeIs('waka-kurikulum-create') || request()->routeIs('waka-kurikulum-edit') || request()->routeIs('waka-kurikulum-store') || request()->routeIs('waka-kurikulum-update') || request()->routeIs('waka-kurikulum-destroy') || (request()->routeIs('waka-kurikulum-show') && request()->query('source') !== 'validasi') ? 'active' : '' }}">
                                <a href="{{ route('waka-kurikulum-list-diajukan') }}">
                                    <span class="sub-item">Kurikulum Diajukan</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('waka-kurikulum-list-validasi') || (request()->routeIs('waka-kurikulum-show') && request()->query('source') === 'validasi') ? 'active' : '' }}">
                                <a href="{{ route('waka-kurikulum-list-validasi') }}">
                                    <span class="sub-item">Kurikulum Perusahaan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Route::is('waka_kurikulum.beasiswas.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#subnav2"
                        aria-expanded="{{ Route::is('waka_kurikulum.beasiswas.*') ? 'true' : 'false' }}">
                        <i class="far fa-chart-bar"></i>
                        <p>Beasiswa Talent Scout</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Route::is('waka_kurikulum.beasiswas.*') ? 'show' : '' }}" id="subnav2">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::is('waka_kurikulum.beasiswas.batches.list') ? 'active' : '' }}">
                                <a href="{{ route('waka_kurikulum.beasiswas.batches.list') }}">
                                    <i class="fas fa-list-alt"></i>
                                    <p>Beasiswa Aktif</p>
                                </a>
                            </li>
                            <li class="{{ Route::is('waka_kurikulum.beasiswas.index') ? 'active' : '' }}">
                                <a href="{{ route('waka_kurikulum.beasiswas.index') }}">
                                    <i class="fas fa-check-circle"></i>
                                    <p>Rekomendasi Beasiswa</p>
                                </a>
                            </li>
                            <li class="{{ Route::is('waka_kurikulum.beasiswas.hasil') ? 'active' : '' }}">
                                <a href="{{ route('waka_kurikulum.beasiswas.hasil') }}">
                                    <i class="fas fa-clipboard-check"></i>
                                    <p>Hasil Seleksi Beasiswa</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
{{-- Sub-menu collapses handled by Bootstrap data-bs-toggle="collapse" --}}
