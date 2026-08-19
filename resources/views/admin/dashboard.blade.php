@extends('layouts.layout')

@section('content')
<div class="page-inner">
    {{-- 1. Hero Welcome Banner --}}
    <div class="card card-round bg-primary-gradient text-white mb-4 shadow-sm" style="background: linear-gradient(135deg, #1e3a8a 0%, #0284c7 100%); border: none;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-white text-primary fw-bold px-3 py-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                            <i class="fas fa-shield-alt me-1"></i> Administrator Panel
                        </span>
                        <span class="text-white-50" style="font-size: 0.85rem;">
                            <i class="far fa-calendar-alt me-1"></i> {{ date('l, d F Y') }}
                        </span>
                    </div>
                    <h2 class="fw-bold mb-1 text-white">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                        Pusat kendali operasional & pemantauan ekosistem kemitraan <strong>SIMILA</strong> (SMK & Dunia Usaha/Industri).
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin-users-index') }}" class="btn btn-light btn-round fw-bold px-4 py-2 shadow-sm text-primary">
                        <i class="fas fa-users-cog me-2"></i> Kelola Pengguna & Role
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Primary KPI Stats Cards (4 Core Metrics) --}}
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                <i class="fas fa-users" style="font-size: 1.4rem;"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category text-muted mb-0 fw-semibold" style="font-size: 0.8rem;">Total Pengguna</p>
                                <h4 class="card-title fw-bold text-dark mb-0">{{ $stats['total_users'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2 text-muted opacity-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size: 0.75rem;">Tersebar di 8 Role</span>
                        <a href="{{ route('admin-users-index') }}" class="text-primary fw-bold text-decoration-none" style="font-size: 0.75rem;">
                            Kelola User <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center bubble-shadow-small bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                <i class="fas fa-building" style="font-size: 1.4rem;"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category text-muted mb-0 fw-semibold" style="font-size: 0.8rem;">Mitra Industri (DUDI)</p>
                                <h4 class="card-title fw-bold text-dark mb-0">{{ $stats['total_perusahaan'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2 text-muted opacity-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size: 0.75rem;">Perusahaan Aktif</span>
                        <a href="{{ route('admin-pkl-select-company') }}" class="text-success fw-bold text-decoration-none" style="font-size: 0.75rem;">
                            Lihat Mitra <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center bubble-shadow-small bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                <i class="fas fa-user-graduate" style="font-size: 1.4rem;"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category text-muted mb-0 fw-semibold" style="font-size: 0.8rem;">Siswa Terdaftar</p>
                                <h4 class="card-title fw-bold text-dark mb-0">{{ $stats['total_siswa'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2 text-muted opacity-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size: 0.75rem;">{{ $stats['total_pkl'] ?? 0 }} Data PKL</span>
                        <a href="{{ route('admin-pkl-index') }}" class="text-info fw-bold text-decoration-none" style="font-size: 0.75rem;">
                            Data PKL <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center bubble-shadow-small bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                                <i class="fas fa-chalkboard-teacher" style="font-size: 1.4rem;"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category text-muted mb-0 fw-semibold" style="font-size: 0.8rem;">Guru & Pembimbing</p>
                                <h4 class="card-title fw-bold text-dark mb-0">{{ $stats['total_guru'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2 text-muted opacity-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" style="font-size: 0.75rem;">Pembimbing PKL</span>
                        <a href="{{ route('admin-pkl-assign-pembimbing-list') }}" class="text-warning fw-bold text-decoration-none" style="font-size: 0.75rem;">
                            Penugasan <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Main Row: User Management Spotlight & Activity Table --}}
    <div class="row mt-2">
        {{-- Left: User Distribution & Kelola User Action Card --}}
        <div class="col-lg-5">
            <div class="card card-round shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fw-bold text-dark mb-0">
                            <i class="fas fa-user-shield text-primary me-2"></i> Manajemen Akses & Role
                        </h5>
                        <p class="text-muted mb-0" style="font-size: 0.8rem;">Distribusi akun di seluruh peran sistem</p>
                    </div>
                    <a href="{{ route('admin-users-index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                        Buka User Manager
                    </a>
                </div>
                <div class="card-body px-4 py-3">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary rounded-circle p-2 me-3"><i class="fas fa-user-graduate"></i></span>
                                <span class="fw-medium text-dark">Siswa Vokasi</span>
                            </div>
                            <span class="badge bg-light text-dark fw-bold border px-3 py-1">{{ $stats['total_siswa'] ?? 0 }} Akun</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success rounded-circle p-2 me-3"><i class="fas fa-building"></i></span>
                                <span class="fw-medium text-dark">Mitra Industri (Perusahaan)</span>
                            </div>
                            <span class="badge bg-light text-dark fw-bold border px-3 py-1">{{ $stats['total_perusahaan'] ?? 0 }} Akun</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-warning text-white rounded-circle p-2 me-3"><i class="fas fa-chalkboard-teacher"></i></span>
                                <span class="fw-medium text-dark">Guru & Guru Produktif</span>
                            </div>
                            <span class="badge bg-light text-dark fw-bold border px-3 py-1">{{ $stats['total_guru'] ?? 0 }} Akun</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-secondary rounded-circle p-2 me-3"><i class="fas fa-user-tie"></i></span>
                                <span class="fw-medium text-dark">Waka Kurikulum & Waka Humas</span>
                            </div>
                            <span class="badge bg-light text-dark fw-bold border px-3 py-1">{{ $stats['total_waka'] ?? 0 }} Akun</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-info text-white rounded-circle p-2 me-3"><i class="fas fa-certificate"></i></span>
                                <span class="fw-medium text-dark">Lembaga Sertifikasi (LSP)</span>
                            </div>
                            <span class="badge bg-light text-dark fw-bold border px-3 py-1">{{ $stats['total_lsp'] ?? 0 }} Akun</span>
                        </div>
                        <div class="list-group-item px-0 d-flex justify-content-between align-items-center border-bottom-0 py-2">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-dark rounded-circle p-2 me-3"><i class="fas fa-briefcase"></i></span>
                                <span class="fw-medium text-dark">Alumni Pencari Kerja</span>
                            </div>
                            <span class="badge bg-light text-dark fw-bold border px-3 py-1">{{ $stats['total_alumni'] ?? 0 }} Akun</span>
                        </div>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route('admin-users-index') }}" class="btn btn-primary w-100 btn-round fw-bold py-2 shadow-sm">
                            <i class="fas fa-plus-circle me-1"></i> Tambah / Kelola Pengguna Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Recent Users Table & Quick Overview --}}
        <div class="col-lg-7">
            <div class="card card-round shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fw-bold text-dark mb-0">
                            <i class="fas fa-user-clock text-info me-2"></i> Pengguna Terdaftar Terbaru
                        </h5>
                        <p class="text-muted mb-0" style="font-size: 0.8rem;">Daftar akun yang baru saja dibuat atau aktif</p>
                    </div>
                    <a href="{{ route('admin-users-index') }}" class="btn btn-sm btn-link text-primary fw-bold text-decoration-none">
                        Lihat Semua <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover">
                            <thead class="bg-light">
                                <tr class="text-muted" style="font-size: 0.78rem;">
                                    <th class="ps-4">NAMA & EMAIL</th>
                                    <th>ROLE / PERAN</th>
                                    <th>STATUS</th>
                                    <th class="text-end pe-4">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_users'] ?? [] as $recentUser)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <span class="avatar-title rounded-circle bg-primary-gradient text-white fw-bold">
                                                    {{ strtoupper(substr($recentUser->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $recentUser->name }}</div>
                                                <div class="text-muted" style="font-size: 0.78rem;">{{ $recentUser->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($recentUser->roles as $role)
                                            <span class="badge bg-light text-primary border fw-semibold" style="font-size: 0.75rem;">
                                                {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="badge bg-success-light text-success fw-bold" style="font-size: 0.75rem; background-color: #dcfce7; padding: 4px 8px; border-radius: 4px;">
                                            <i class="fas fa-check-circle me-1"></i> Aktif
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin-users-index') }}" class="btn btn-sm btn-outline-secondary btn-icon btn-round" title="Kelola">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada pengguna terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Bottom Row: 8 Core Link & Match Modules Quick Access Grid --}}
    <div class="card card-round shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
            <h5 class="card-title fw-bold text-dark mb-0">
                <i class="fas fa-th-large text-primary me-2"></i> Akses Cepat 8 Pilar Kemitraan Vokasi
            </h5>
            <p class="text-muted mb-0" style="font-size: 0.8rem;">Pintas navigasi ke modul-modul kemitraan industri</p>
        </div>
        <div class="card-body px-4 py-4">
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin-kurikulum-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-primary mb-2"><i class="fas fa-book-open fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">Kurikulum Bersama</h6>
                        <span class="text-muted" style="font-size: 0.75rem;">{{ $stats['total_kurikulum'] ?? 0 }} Kurikulum</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin-pkl-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-success mb-2"><i class="fas fa-briefcase fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">Praktik Lapangan (PKL)</h6>
                        <span class="text-muted" style="font-size: 0.75rem;">{{ $stats['total_pkl'] ?? 0 }} Data Magang</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin-guru-tamu-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-info mb-2"><i class="fas fa-user-tie fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">Guru Tamu Industri</h6>
                        <span class="text-muted" style="font-size: 0.75rem;">Program Praktisi</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin-project-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-warning mb-2"><i class="fas fa-project-diagram fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">Project Mitra (PBL)</h6>
                        <span class="text-muted" style="font-size: 0.75rem;">{{ $stats['total_project'] ?? 0 }} Project TeFa</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin-mooc-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-danger mb-2"><i class="fas fa-graduation-cap fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">MOOC Pelatihan Guru</h6>
                        <span class="text-muted" style="font-size: 0.75rem;">{{ $stats['total_mooc'] ?? 0 }} Kursus</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin-beasiswa-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-secondary mb-2"><i class="fas fa-award fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">Beasiswa Talent Scout</h6>
                        <span class="text-muted" style="font-size: 0.75rem;">{{ $stats['total_beasiswa'] ?? 0 }} Penerima</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin-scouting-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-dark mb-2"><i class="fas fa-search-dollar fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">Talent Scouting Alumni</h6>
                        <span class="text-muted" style="font-size: 0.75rem;">{{ $stats['total_scouting'] ?? 0 }} Lamaran</span>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('admin-sertifikasi-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-primary mb-2"><i class="fas fa-stamp fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">Sertifikasi LSP BNSP</h6>
                        <span class="text-muted" style="font-size: 0.75rem;">{{ $stats['total_sertifikasi'] ?? 0 }} Paket Uji</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow {
    transition: all 0.2s ease-in-out;
}
.hover-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
    border-color: #0284c7 !important;
}
</style>
@endsection
