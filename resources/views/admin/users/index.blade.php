@extends('layouts.layout')

@section('content')
<div class="container-fluid px-4 py-4">
    {{-- 1. Header & Title --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-users-cog text-primary me-2"></i> Manajemen Akun & Role Pengguna
            </h1>
            <p class="text-muted mb-0">Kelola dan pantau seluruh akun terdaftar berdasarkan pembagian hak akses (role) dalam ekosistem SIMILA.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary px-3 py-2 rounded-pill fs-6">
                <i class="fas fa-database me-1"></i> Total: {{ $totalAll }} Akun
            </span>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 2. Role Overview KPI Cards (Pill-Shaped Quick Filter Capsules) --}}
    @php
        $roleMeta = [
            'all' => ['title' => 'Semua Akun', 'icon' => 'fa-users', 'bg' => '#eff6ff', 'text' => '#1d4ed8', 'border' => '#bfdbfe'],
            'perusahaan' => ['title' => 'Perusahaan (DUDI)', 'icon' => 'fa-building', 'bg' => '#f0fdf4', 'text' => '#15803d', 'border' => '#bbf7d0'],
            'siswa' => ['title' => 'Siswa Peserta', 'icon' => 'fa-user-graduate', 'bg' => '#f0f9ff', 'text' => '#0369a1', 'border' => '#bae6fd'],
            'guru' => ['title' => 'Guru Pembimbing', 'icon' => 'fa-chalkboard-teacher', 'bg' => '#faf5ff', 'text' => '#7e22ce', 'border' => '#e9d5ff'],
            'waka_humas' => ['title' => 'Waka Humas', 'icon' => 'fa-handshake', 'bg' => '#fffbeb', 'text' => '#b45309', 'border' => '#fde68a'],
            'waka_kurikulum' => ['title' => 'Waka Kurikulum', 'icon' => 'fa-book-open', 'bg' => '#f0fdfa', 'text' => '#0f766e', 'border' => '#99f6e4'],
            'lsp' => ['title' => 'LSP / Asesor', 'icon' => 'fa-certificate', 'bg' => '#eef2ff', 'text' => '#4338ca', 'border' => '#c7d2fe'],
            'alumni' => ['title' => 'Alumni', 'icon' => 'fa-user-tie', 'bg' => '#f8fafc', 'text' => '#334155', 'border' => '#cbd5e1'],
            'admin' => ['title' => 'Administrator', 'icon' => 'fa-shield-alt', 'bg' => '#fef2f2', 'text' => '#b91c1c', 'border' => '#fecaca'],
        ];

        // Filter out 'user' role from display cards if redundant, or keep standard roles
        $displayRoles = $roles->filter(fn($r) => $r->name !== 'user');
    @endphp

    <div class="d-flex flex-wrap gap-2 mb-4">
        {{-- Pill Semua --}}
        @php
            $isAllActive = $selectedRole === 'all';
        @endphp
        <a href="{{ route('admin-users-index', ['role' => 'all', 'search' => $search, 'per_page' => $perPage]) }}"
           class="role-kpi-pill text-decoration-none d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill border transition-all {{ $isAllActive ? 'active-role-pill shadow-sm' : '' }}"
           style="background-color: {{ $isAllActive ? '#0284c7' : $roleMeta['all']['bg'] }}; border-color: {{ $isAllActive ? '#0284c7' : $roleMeta['all']['border'] }} !important; color: {{ $isAllActive ? '#ffffff' : $roleMeta['all']['text'] }};">
            <span class="role-icon-circle d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 22px; height: 22px; background-color: {{ $isAllActive ? 'rgba(255,255,255,0.25)' : 'rgba(2, 132, 199, 0.15)' }}; color: {{ $isAllActive ? '#ffffff' : $roleMeta['all']['text'] }}; font-size: 0.7rem;">
                <i class="fas {{ $roleMeta['all']['icon'] }}"></i>
            </span>
            <span class="fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.02em;">Semua</span>
            <span class="badge rounded-pill fw-bold"
                  style="font-size: 0.72rem; background-color: {{ $isAllActive ? '#ffffff' : 'rgba(2, 132, 199, 0.12)' }}; color: {{ $isAllActive ? '#0284c7' : $roleMeta['all']['text'] }};">
                {{ $totalAll }}
            </span>
        </a>

        {{-- Role Pills --}}
        @foreach($displayRoles as $r)
            @php
                $meta = $roleMeta[$r->name] ?? ['title' => ucfirst($r->name), 'icon' => 'fa-user', 'bg' => '#f8fafc', 'text' => '#475569', 'border' => '#e2e8f0'];
                $count = $roleCounts[$r->name] ?? 0;
                $isActive = $selectedRole === $r->name;
            @endphp
            <a href="{{ route('admin-users-index', ['role' => $r->name, 'search' => $search, 'per_page' => $perPage]) }}"
               class="role-kpi-pill text-decoration-none d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill border transition-all {{ $isActive ? 'active-role-pill shadow-sm' : '' }}"
               style="background-color: {{ $isActive ? $meta['text'] : $meta['bg'] }}; border-color: {{ $isActive ? $meta['text'] : $meta['border'] }} !important; color: {{ $isActive ? '#ffffff' : $meta['text'] }};">
                <span class="role-icon-circle d-flex align-items-center justify-content-center rounded-circle"
                      style="width: 22px; height: 22px; background-color: {{ $isActive ? 'rgba(255,255,255,0.25)' : 'rgba(0,0,0,0.06)' }}; color: {{ $isActive ? '#ffffff' : $meta['text'] }}; font-size: 0.7rem;">
                    <i class="fas {{ $meta['icon'] }}"></i>
                </span>
                <span class="fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.02em;">{{ strtoupper(str_replace('_', ' ', $r->name)) }}</span>
                <span class="badge rounded-pill fw-bold"
                      style="font-size: 0.72rem; background-color: {{ $isActive ? '#ffffff' : 'rgba(0,0,0,0.06)' }}; color: {{ $isActive ? $meta['text'] : $meta['text'] }};">
                    {{ $count }}
                </span>
            </a>
        @endforeach
    </div>

    {{-- 3. Main Data Card --}}
    <div class="card shadow-sm border-0 mb-4">
        {{-- Card Header: Nav-Pills Tabs + Search & Filters --}}
        <div class="card-header bg-white border-0 pt-4 px-4 pb-3">
            <div class="row align-items-center g-3">
                {{-- Search Box --}}
                <div class="col-md-6 col-lg-5">
                    <form method="GET" action="{{ route('admin-users-index') }}" class="d-flex gap-2">
                        <input type="hidden" name="role" value="{{ $selectedRole }}">
                        <input type="hidden" name="per_page" value="{{ $perPage }}">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control bg-light border-start-0 ps-0"
                                   placeholder="Cari nama, email, NISN, atau keahlian..."
                                   value="{{ $search }}">
                            @if(!empty($search))
                                <a href="{{ route('admin-users-index', ['role' => $selectedRole, 'per_page' => $perPage]) }}"
                                   class="input-group-text bg-light border-start-0 text-muted" title="Hapus pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary px-3">
                            Cari
                        </button>
                    </form>
                </div>

                {{-- Rows Per Page & Active Role Filter Info --}}
                <div class="col-md-6 col-lg-7 text-md-end">
                    <div class="d-inline-flex align-items-center gap-2 flex-wrap justify-content-md-end">
                        @if($selectedRole !== 'all')
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill" style="font-size: 0.75rem;">
                                Filter Aktif: <strong>{{ strtoupper(str_replace('_', ' ', $selectedRole)) }}</strong>
                                <a href="{{ route('admin-users-index', ['role' => 'all', 'search' => $search, 'per_page' => $perPage]) }}" class="text-danger ms-2 text-decoration-none" title="Reset filter role">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </span>
                        @endif

                        <div class="d-flex align-items-center gap-1">
                            <span class="small text-muted" style="font-size: 0.78rem;">Tampilkan:</span>
                            <select class="form-select form-select-sm" style="width: 80px; font-size: 0.78rem;" onchange="window.location.href=this.value">
                                @foreach([10, 25, 50, 100] as $p)
                                    <option value="{{ route('admin-users-index', ['role' => $selectedRole, 'search' => $search, 'per_page' => $p]) }}" {{ $perPage == $p ? 'selected' : '' }}>
                                        {{ $p }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Role Tab Pills --}}
            <div class="mt-3 pt-3 border-top overflow-auto">
                <ul class="nav nav-pills flex-nowrap gap-1 pb-1" style="min-width: 600px;">
                    <li class="nav-item">
                        <a class="nav-link py-1 px-3 rounded-pill {{ $selectedRole === 'all' ? 'active' : 'bg-light text-dark' }}"
                           style="font-size: 0.75rem; font-weight: 600; border-radius: 50px !important;"
                           href="{{ route('admin-users-index', ['role' => 'all', 'search' => $search, 'per_page' => $perPage]) }}">
                            <i class="fas fa-list me-1" style="font-size: 0.7rem;"></i> Semua ({{ $totalAll }})
                        </a>
                    </li>
                    @foreach($displayRoles as $r)
                        @php
                            $meta = $roleMeta[$r->name] ?? ['title' => ucfirst($r->name), 'icon' => 'fa-user'];
                            $count = $roleCounts[$r->name] ?? 0;
                            $isActive = $selectedRole === $r->name;
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link py-1 px-3 rounded-pill {{ $isActive ? 'active' : 'bg-light text-dark' }}"
                               style="font-size: 0.75rem; font-weight: 600; border-radius: 50px !important;"
                               href="{{ route('admin-users-index', ['role' => $r->name, 'search' => $search, 'per_page' => $perPage]) }}">
                                <i class="fas {{ $meta['icon'] }} me-1" style="font-size: 0.7rem;"></i> {{ ucwords(str_replace('_', ' ', $r->name)) }} ({{ $count }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Table Body --}}
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;" class="text-center">No</th>
                            <th style="width: 26%;">Pengguna & Identitas</th>
                            <th style="width: 22%;">Email & Kontak</th>
                            <th style="width: 15%;">Peran (Role)</th>
                            <th style="width: 14%;">Keterangan Khusus</th>
                            <th style="width: 18%;" class="text-center">Aksi / Ubah Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            @php
                                $userRoles = $user->getRoleNames()->toArray();
                                $currentRole = !empty($userRoles) ? (count($userRoles) > 1 && in_array('user', $userRoles) ? (collect($userRoles)->first(fn($r) => $r !== 'user') ?? 'user') : $userRoles[0]) : 'user';
                                $meta = $roleMeta[$currentRole] ?? ['title' => ucfirst($currentRole), 'icon' => 'fa-user', 'bg' => '#f8fafc', 'text' => '#475569', 'border' => '#e2e8f0'];
                            @endphp
                            <tr>
                                <td class="text-center text-muted small">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3 flex-shrink-0">
                                            <img src="https://api.dicebear.com/9.x/initials/svg?seed={{ urlencode($user->name) }}&backgroundColor=2563eb,3b82f6,0284c7"
                                                 alt="{{ $user->name }}" class="avatar-img rounded-circle border" style="width: 38px; height: 38px; object-fit: cover;" />
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            @if($user->nis)
                                                <small class="text-muted"><i class="fas fa-id-badge me-1"></i> NISN: {{ $user->nis }}</small>
                                            @elseif($user->kompetensi_keahlian)
                                                <small class="text-muted"><i class="fas fa-graduation-cap me-1"></i> {{ $user->kompetensi_keahlian }}</small>
                                            @else
                                                <small class="text-muted">ID: #{{ $user->id }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark small d-block">{{ $user->email }}</span>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        <i class="fas fa-calendar-alt me-1"></i> Daftar: {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2"
                                          style="background-color: {{ $meta['bg'] }}; color: {{ $meta['text'] }}; border: 1px solid {{ $meta['border'] }};">
                                        <i class="fas {{ $meta['icon'] }} me-1"></i>
                                        {{ strtoupper(str_replace('_', ' ', $currentRole)) }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->hasRole('guru'))
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-chalkboard me-1 text-primary"></i>
                                            {{ $user->jenis_guru ? ucwords($user->jenis_guru) : 'Belum Ditentukan' }}
                                        </span>
                                    @elseif($user->hasRole('siswa'))
                                        @if($user->pkl_status)
                                            <span class="badge bg-success"><i class="fas fa-check me-1"></i> PKL: {{ ucwords($user->pkl_status) }}</span>
                                        @else
                                            <span class="badge bg-light text-muted border">Belum PKL</span>
                                        @endif
                                    @elseif($user->hasRole('perusahaan'))
                                        <span class="badge bg-light text-success border">
                                            <i class="fas fa-building me-1"></i> Mitra Industri
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($user->id == auth()->id())
                                        <span class="badge bg-info text-white px-3 py-2 rounded-pill">
                                            <i class="fas fa-user-shield me-1"></i> Akun Anda (Aktif)
                                        </span>
                                    @else
                                        <form action="{{ route('admin-users-update-role', $user) }}" method="POST" class="d-inline-flex align-items-center justify-content-center gap-2">
                                            @csrf
                                            <select name="role" class="form-select form-select-sm role-select" data-user-id="{{ $user->id }}" style="min-width: 140px; width: auto;">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->name }}" {{ $currentRole == $role->name ? 'selected' : '' }}>
                                                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div id="jenis-guru-options-{{ $user->id }}" class="jenis-guru-options" style="{{ $user->hasRole('guru') ? 'display: inline-block;' : 'display: none;' }}">
                                                <select name="jenis_guru" class="form-select form-select-sm" style="min-width: 110px; width: auto;">
                                                    <option value="">Pilih Jenis</option>
                                                    <option value="guru pembimbing" {{ $user->jenis_guru == 'guru pembimbing' ? 'selected' : '' }}>Pembimbing</option>
                                                    <option value="guru produktif" {{ $user->jenis_guru == 'guru produktif' ? 'selected' : '' }}>Produktif</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-action btn-primary" title="Simpan Perubahan Role">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                    <h6 class="fw-bold text-dark">Tidak ada data pengguna yang sesuai</h6>
                                    <p class="text-muted small mb-3">
                                        @if(!empty($search))
                                            Pencarian dengan kata kunci "<strong>{{ $search }}</strong>" tidak ditemukan pada role <strong>{{ $selectedRole }}</strong>.
                                        @else
                                            Belum ada pengguna terdaftar untuk role <strong>{{ $selectedRole }}</strong>.
                                        @endif
                                    </p>
                                    <a href="{{ route('admin-users-index', ['role' => 'all']) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-undo me-1"></i> Tampilkan Semua Akun
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Card Footer: Pagination --}}
        @if($users->hasPages() || $users->total() > 0)
            <div class="card-footer py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="small text-muted d-flex align-items-center gap-1">
                    <i class="fas fa-list-ol text-primary opacity-75"></i>
                    <span>Menampilkan <strong>{{ $users->firstItem() ?? 0 }}</strong> - <strong>{{ $users->lastItem() ?? 0 }}</strong> dari <strong>{{ $users->total() }}</strong> pengguna</span>
                    @if($selectedRole !== 'all')
                        <span class="badge bg-light text-primary border ms-1">{{ strtoupper(str_replace('_', ' ', $selectedRole)) }}</span>
                    @endif
                </div>
                <div>
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.role-kpi-card {
    transition: all 0.2s ease-in-out;
    cursor: pointer;
}
.role-kpi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
}
.active-role-card {
    box-shadow: 0 0 0 2px #2563eb !important;
    transform: translateY(-2px);
}
.avatar-sm {
    width: 38px;
    height: 38px;
}
.nav-pills .nav-link.active {
    background-color: #2563eb !important;
    color: #ffffff !important;
    font-weight: 600;
}
.form-select-sm {
    font-size: 0.8rem;
    padding: 0.3rem 0.6rem;
}
.table > :not(caption) > * > * {
    padding: 0.85rem 0.75rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelects = document.querySelectorAll('.role-select');
    
    roleSelects.forEach(select => {
        const userId = select.getAttribute('data-user-id');
        const jenisGuruOptions = document.getElementById(`jenis-guru-options-${userId}`);
        
        select.addEventListener('change', function() {
            if (this.value === 'guru') {
                jenisGuruOptions.style.display = 'block';
            } else {
                jenisGuruOptions.style.display = 'none';
            }
        });
    });
});
</script>
@endsection