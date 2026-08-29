<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control" />
                        </div>
                    </form>
                </ul>
            </li>
            
            {{-- Theme Switcher (Light / Dark Mode) --}}
            <li class="nav-item me-3">
                <button type="button" 
                        class="btn btn-icon btn-round btn-theme-toggle shadow-sm" 
                        id="themeToggleBtn"
                        data-toggle-theme 
                        title="Beralih Mode Tema" 
                        aria-label="Toggle Theme">
                    <i class="bi bi-moon-stars-fill theme-icon-moon"></i>
                    <i class="bi bi-sun-fill theme-icon-sun d-none"></i>
                </button>
            </li>

            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                    aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="https://api.dicebear.com/9.x/miniavs/svg?seed={{ Auth::user()->name ?? 'Admin' }}" alt="..."
                            class="avatar-img rounded-circle" />
                    </div>
                    <span class="profile-username">
                        <span class="op-7">Hi,</span>
                        <span class="fw-bold">{{ Auth::user()->name ?? 'Admin' }}</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="https://api.dicebear.com/9.x/miniavs/svg?seed={{ Auth::user()->name ?? 'Admin' }}" alt="image profile"
                                        class="avatar-img rounded" />
                                </div>
                                <div class="u-text">
                                    <h4>{{ Auth::user()->name ?? 'Admin' }}</h4>
                                    <p class="text-muted">{{ Auth::user()->email ?? 'hello@example.com' }}</p>
                                    <a href="{{ route('profile.show') }}" class="btn btn-xs btn-primary btn-sm">Lihat Profil</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fas fa-user me-2 text-primary"></i> Profil Saya
                            </a>
                            <a class="dropdown-item" href="{{ route('profile.balance') }}">
                                <i class="fas fa-wallet me-2 text-warning"></i> Ringkasan & Aktivitas
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('profile.settings') }}">
                                <i class="fas fa-cog me-2 text-info"></i> Pengaturan Akun
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
