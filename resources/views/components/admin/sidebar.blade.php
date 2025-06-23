<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header d-flex align-items-center justify-content-between px-3" data-background-color="dark">
            {{-- Tulisan besar SIMILA --}}
            {{-- Mengubah href agar mengarah ke admin-dashboard --}}
            <a href="{{ route('admin-dashboard') }}" class="text-white text-decoration-none">
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
        </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Route::currentRouteName() == 'admin-dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin-dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin-kurikulum*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#kurikulumAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-kurikulum*') ? 'true' : 'false' }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Kurikulum Bersama</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-kurikulum*') ? 'show' : '' }}" id="kurikulumAdminCollapse">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'admin-kurikulum-list-diajukan' ? 'active' : '' }}">
                                <a href="{{ route('admin-kurikulum-list-diajukan') }}">
                                    <span class="sub-item">Kurikulum Diajukan</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'admin-kurikulum-list-validasi' ? 'active' : '' }}">
                                <a href="{{ route('admin-kurikulum-list-validasi') }}">
                                    <span class="sub-item">Validasi Kurikulum Perusahaan</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'admin-kurikulum-list-validasi-sekolah' ? 'active' : '' }}">
                                <a href="{{ route('admin-kurikulum-list-validasi-sekolah') }}">
                                    <span class="sub-item">Validasi Kurikulum Sekolah</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('admin-project*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#projectAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-project*') ? 'true' : 'false' }}">
                        <i class="fas fa-th-list"></i>
                        <p>Project Mitra</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-project*') ? 'show' : '' }}" id="projectAdminCollapse">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'admin-project-index' ? 'active' : '' }}">
                                <a href="{{ route('admin-project-index') }}">
                                    <span class="sub-item">Manajemen Project</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->routeIs('admin-guru-tamu*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#guruTamuAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-guru-tamu*') ? 'true' : 'false' }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Guru Tamu</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-guru-tamu*') ? 'show' : '' }}" id="guruTamuAdminCollapse">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'admin-guru-tamu-index' ? 'active' : '' }}">
                                <a href="{{ route('admin-guru-tamu-index') }}">
                                    <span class="sub-item">Manajemen Guru Tamu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- PKL (pastikan rute dan IDs cocok dengan yang ada di projectmu) --}}
                <li class="nav-item {{ request()->routeIs('admin-pkl*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#pklAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-pkl*') ? 'true' : 'false' }}">
                        <i class="fas fa-table"></i>
                        <p>PKL</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-pkl*') ? 'show' : '' }}" id="pklAdminCollapse">
                        <ul class="nav nav-collapse">
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">Penilaian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Talent Scouting (pastikan rute dan IDs cocok dengan yang ada di projectmu) --}}
                <li class="nav-item {{ request()->routeIs('admin-scouting*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#scoutingAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-scouting*') ? 'true' : 'false' }}">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Talent Scouting</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-scouting*') ? 'show' : '' }}" id="scoutingAdminCollapse">
                        <ul class="nav nav-collapse">
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">List Pendaftar</span>
                                </a>
                            </li>
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">Hasil Penerimaan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- MOOC (pastikan rute dan IDs cocok dengan yang ada di projectmu) --}}
                <li class="nav-item {{ request()->routeIs('admin-mooc*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#moocAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-mooc*') ? 'true' : 'false' }}">
                        <i class="far fa-chart-bar"></i>
                        <p>MOOC</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-mooc*') ? 'show' : '' }}" id="moocAdminCollapse">
                        <ul class="nav nav-collapse">
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">Kelas</span>
                                </a>
                            </li>
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">Ujian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Riset & Inovasi Produk (pastikan rute dan IDs cocok dengan yang ada di projectmu) --}}
                <li class="nav-item {{ request()->routeIs('admin-riset*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#risetAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-riset*') ? 'true' : 'false' }}">
                        <i class="far fa-chart-bar"></i>
                        <p>Riset & Inovasi Produk</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-riset*') ? 'show' : '' }}" id="risetAdminCollapse">
                        <ul class="nav nav-collapse">
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">List Riset Inovasi</span>
                                </a>
                            </li>
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">Hasil Inovasi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Beasiswa Talent Scout (pastikan rute dan IDs cocok dengan yang ada di projectmu) --}}
                <li class="nav-item {{ request()->routeIs('admin-beasiswa*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#beasiswaAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-beasiswa*') ? 'true' : 'false' }}">
                        <i class="far fa-chart-bar"></i>
                        <p>Beasiswa Talent Scout</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-beasiswa*') ? 'show' : '' }}" id="beasiswaAdminCollapse">
                        <ul class="nav nav-collapse">
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">Daftar Pendaftar</span>
                                </a>
                            </li>
                            {{-- Sesuaikan rute ini jika ada --}}
                            <li>
                                <a href="#">
                                    <span class="sub-item">Hasil Seleksi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Sertifikasi Kompetensi (BARU UNTUK ADMIN) --}}
                <li class="nav-item {{ request()->routeIs('admin-sertifikasi*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#sertifikasiAdminCollapse"
                        aria-expanded="{{ request()->routeIs('admin-sertifikasi*') ? 'true' : 'false' }}">
                        <i class="fas fa-certificate"></i>
                        <p>Sertifikasi Kompetensi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin-sertifikasi*') ? 'show' : '' }}"
                        id="sertifikasiAdminCollapse">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'admin-sertifikasi-index' ? 'active' : '' }}">
                                <a href="{{ route('admin-sertifikasi-index') }}">
                                    <span class="sub-item">Manajemen Sertifikasi</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'admin-sertifikasi-results' ? 'active' : '' }}">
                                <a href="{{ route('admin-sertifikasi-results') }}">
                                    <span class="sub-item">Hasil Sertifikasi Siswa</span>
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
        // Hapus semua event listener lama yang tidak diperlukan lagi karena logika `show` sudah di blade
        // dan Bootstrap collapse sudah menangani toggling.
        // Biarkan kosong atau hapus jika tidak ada JS kustom yang mutlak dibutuhkan untuk sidebar.
    });
</script>