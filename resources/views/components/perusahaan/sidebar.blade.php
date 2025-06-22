<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header d-flex align-items-center justify-content-between px-3" data-background-color="dark">
            {{-- Tulisan besar SIMILA --}}
            <a href="{{ route('waka-kurikulum-dashboard') }}" class="text-white text-decoration-none">
                <h3 class="m-0 fw-bold text-uppercase" style="letter-spacing: 1px;">SIMILA</h3>
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
                <li class="nav-item {{ Route::currentRouteName() == 'perusahaan-dashboard' ? 'active' : '' }}">
                    <a href="{{ route('perusahaan-dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('perusahaan-kurikulum*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Kurikulum Bersama</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li
                                class="{{ Route::currentRouteName() == 'perusahaan-kurikulum-list-diajukan' ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-kurikulum-list-diajukan') }}">
                                    <span class="sub-item">Kurikulum diajukan</span>
                                </a>
                            </li>
                            <li
                                class="{{ Route::currentRouteName() == 'perusahaan-kurikulum-list-validasi' ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-kurikulum-list-validasi') }}">
                                    <span class="sub-item">Kurikulum Sekolah</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('perusahaan-project*') ? 'active' : '' }} ">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Project Mitra</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'perusahaan-project-index' ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-project-index') }}">
                                    <span class="sub-item">List Projek</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('perusahaan-guru-tamu*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Guru Tamu</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li
                                class="{{ Route::currentRouteName() == 'perusahaan-guru-tamu-index' ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-guru-tamu-index') }}">
                                    <span class="sub-item">Pengajuan Guru Tamu</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'perusahaan-guru-tamu-list' ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-guru-tamu-list') }}">
                                    <span class="sub-item">Guru Tamu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('perusahaan-pkl*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>PKL</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'perusahaan-pkl-index' ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-pkl-index') }}">
                                    <span class="sub-item">PKL</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'perusahaan-pkl-list' ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-pkl-list') }}">
                                    <span class="sub-item">Pelamar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('perusahaan-scouting*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Talent Scouting</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('perusahaan-scouting*') ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-scouting-index') }}">
                                    <span class="sub-item">Talent Scouting</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('perusahaan-mooc*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>MOOC</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'perusahaan-mooc-index' ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-mooc-index') }}">
                                    <span class="sub-item">Kelas</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Ujian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#chart">
                        <i class="far fa-chart-bar"></i>
                        <p>Riset & Inovasi Produk</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">List Riset Inovasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Hasil Inovasi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('perusahaan-beasiswa-*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#subnav2"
                       aria-expanded="{{ request()->routeIs('perusahaan-beasiswa-*') ? 'true' : 'false' }}">
                        <i class="far fa-chart-bar"></i>
                        <p>Beasiswa Talent Scout</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('perusahaan-beasiswa-*') ? 'show' : '' }}" id="subnav2">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('perusahaan-beasiswa-*') ? 'active' : '' }}">
                                <a href="{{ route('perusahaan-beasiswa-index') }}">
                                    <span class="sub-item">Daftar Batch Beasiswa</span>
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
