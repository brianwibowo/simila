<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header d-flex align-items-center justify-content-between px-3" data-background-color="dark">
            <a href="{{ route('siswa-dashboard') }}" class="logo d-flex align-items-center text-decoration-none">
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
                {{-- Dashboard --}}
                <li class="nav-item {{ Route::is('siswa-dashboard') ? 'active' : '' }}">
                    <a href="{{ route('siswa-dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">8 Pilar Vokasi</h4>
                </li>

                {{-- 1. Kurikulum Bersama --}}
                <li class="nav-item {{ request()->routeIs('siswa-kurikulum*') ? 'active' : '' }}">
                    <a href="{{ route('siswa-kurikulum-index') }}">
                        <i class="fas fa-book-open"></i>
                        <p>Kurikulum Bersama</p>
                    </a>
                </li>

                {{-- 2. PKL & Logbook --}}
                <li class="nav-item {{ Route::is('siswa-pkl*') || Route::is('siswa-logbook*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#pklCollapse"
                        aria-expanded="{{ Route::is('siswa-pkl*') || Route::is('siswa-logbook*') ? 'true' : 'false' }}">
                        <i class="fas fa-briefcase"></i>
                        <p>Praktik Lapangan (PKL)</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Route::is('siswa-pkl*') || Route::is('siswa-logbook*') ? 'show' : '' }}" id="pklCollapse">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::is('siswa-pkl-index') ? 'active' : '' }}">
                                <a href="{{ route('siswa-pkl-index') }}">
                                    <span class="sub-item">Pendaftaran PKL</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('siswa-pkl-show') ? 'active' : '' }}">
                                <a href="{{ route('siswa-pkl-show') }}">
                                    <span class="sub-item">PKL Berjalan</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('siswa-logbook*') ? 'active' : '' }}">
                                <a href="{{ route('siswa-logbook-index') }}">
                                    <span class="sub-item">LogBook Harian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- 3. Guru Tamu Industri --}}
                <li class="nav-item {{ request()->routeIs('siswa-guru-tamu*') ? 'active' : '' }}">
                    <a href="{{ route('siswa-guru-tamu-index') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Guru Tamu Industri</p>
                    </a>
                </li>

                {{-- 4. Project Mitra (PBL / TeFa) --}}
                <li class="nav-item {{ request()->routeIs('siswa-project*') ? 'active' : '' }}">
                    <a href="{{ route('siswa-project-index') }}">
                        <i class="fas fa-project-diagram"></i>
                        <p>Project Mitra (PBL)</p>
                    </a>
                </li>

                {{-- 5. Modul Belajar (MOOC) --}}
                <li class="nav-item {{ request()->routeIs('siswa-mooc*') ? 'active' : '' }}">
                    <a href="{{ route('siswa-mooc-index') }}">
                        <i class="fas fa-graduation-cap"></i>
                        <p>Modul Belajar (MOOC)</p>
                    </a>
                </li>

                {{-- 6. Beasiswa & Talent Scouting --}}
                <li class="nav-item {{ Route::is('siswa-beasiswa-*') || Route::is('siswa-scouting*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#tsBeasiswa"
                        aria-expanded="{{ Route::is('siswa-beasiswa-*') || Route::is('siswa-scouting*') ? 'true' : 'false' }}">
                        <i class="fas fa-medal"></i>
                        <p>Beasiswa & Scouting</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse {{ Route::is('siswa-beasiswa-*') || Route::is('siswa-scouting*') ? 'show' : '' }}" id="tsBeasiswa">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::is('siswa-beasiswa-index') ? 'active' : '' }}">
                                <a href="{{ route('siswa-beasiswa-index') }}">
                                    <span class="sub-item">Peluang Beasiswa</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('siswa-beasiswa-status') ? 'active' : '' }}">
                                <a href="{{ route('siswa-beasiswa-status') }}">
                                    <span class="sub-item">Status Beasiswa</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('siswa-scouting-index') ? 'active' : '' }}">
                                <a href="{{ route('siswa-scouting-index') }}">
                                    <span class="sub-item">Talent Scouting</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('siswa-scouting-status') ? 'active' : '' }}">
                                <a href="{{ route('siswa-scouting-status') }}">
                                    <span class="sub-item">Status Scouting</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- 7. Sertifikasi Kompetensi (LSP) --}}
                <li class="nav-item {{ request()->routeIs('siswa-sertifikasi*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#sertifikasiSiswaCollapse"
                        aria-expanded="{{ request()->routeIs('siswa-sertifikasi*') ? 'true' : 'false' }}">
                        <i class="fas fa-certificate"></i>
                        <p>Sertifikasi BNSP (LSP)</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('siswa-sertifikasi*') ? 'show' : '' }}"
                        id="sertifikasiSiswaCollapse">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'siswa-sertifikasi-index' ? 'active' : '' }}">
                                <a href="{{ route('siswa-sertifikasi-index') }}">
                                    <span class="sub-item">Daftar Sertifikasi</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'siswa-sertifikasi-status' ? 'active' : '' }}">
                                <a href="{{ route('siswa-sertifikasi-status') }}">
                                    <span class="sub-item">Status & Sertifikat Saya</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- 8. Riset & Inovasi Produk --}}
                <li class="nav-item {{ request()->routeIs('siswa-riset*') ? 'active' : '' }}">
                    <a href="{{ route('siswa-riset-index') }}">
                        <i class="fas fa-flask"></i>
                        <p>Riset & Inovasi Produk</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
