<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('waka-humas-dashboard') }}" class="logo">
                <img src="{{ asset('template/assets/img/kaiadmin/favicon.png') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
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
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Kurikulum Bersama</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Ajukan Kurikulum</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item">List Kurikulum</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Project Mitra</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-2.html">
                                    <span class="sub-item">List Projek</span>
                                </a>
                            </li>
                            <li>
                                <a href="icon-menu.html">
                                    <span class="sub-item">Buat Projek Baru</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Guru Tamu</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Ajukan Guru Tamu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>PKL</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Penilaian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Talent Scouting</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/googlemaps.html">
                                    <span class="sub-item">List Pendaftar</span>
                                </a>
                            </li>
                            <li>
                                <a href="maps/jsvectormap.html">
                                    <span class="sub-item">Hasil Penerimaan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>MOOC</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
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
                <li class="nav-item {{ request()->routeIs('riset.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#risetInovasi" class="{{ request()->routeIs('riset.*') ? 'active' : '' }}">
                        <i class="fas fa-flask"></i>
                        <p>Riset & Inovasi Produk</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('riset.*') ? 'show' : '' }}" id="risetInovasi">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('riset.index') || request()->routeIs('riset.show') ? 'active' : '' }}">
                                <a href="{{ route('riset.index') }}">
                                    <span class="sub-item">Daftar Riset</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('riset.create') ? 'active' : '' }}">
                                <a href="{{ route('riset.create') }}">
                                    <span class="sub-item">Tambah Riset Baru</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#char">
                        <i class="far fa-chart-bar"></i>
                        <p>Beasiswa Talent Scout</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="subnav2">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Daftar Pendaftar</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Hasil Seleksi</span>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle untuk menu Riset & Inovasi Produk
        document.querySelector('a[href="#chart"]').addEventListener('click', function (e) {
            e.preventDefault();
            const submenu = document.getElementById('submenu');
            submenu.classList.toggle('show');
        });

        // Toggle untuk menu Beasiswa Talent Scout
        document.querySelector('a[href="#char"]').addEventListener('click', function (e) {
            e.preventDefault();
            const subnav2 = document.getElementById('subnav2');
            subnav2.classList.toggle('show');
        });
    });
</script>

