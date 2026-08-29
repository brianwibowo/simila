@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 fw-bold text-primary mb-1">
                <i class="fas fa-user-circle me-2"></i> Profil Pengguna
            </h1>
            <p class="text-muted small mb-0">Informasi identitas akun dan hak akses Anda pada SIMILA.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('profile.settings') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                <i class="fas fa-cog me-1"></i> Pengaturan Akun
            </a>
            <a href="{{ route('profile.balance') }}" class="btn btn-outline-primary btn-sm px-3 shadow-sm">
                <i class="fas fa-wallet me-1"></i> Ringkasan & Aktivitas
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Left Column: User Card --}}
        <div class="col-lg-4 col-md-5">
            <div class="card shadow-sm border-0 text-center p-4">
                <div class="position-relative d-inline-block mx-auto mb-3">
                    <img src="https://api.dicebear.com/9.x/miniavs/svg?seed={{ urlencode($user->name) }}" 
                         alt="{{ $user->name }}" 
                         class="rounded-circle shadow-sm border border-3 border-primary" 
                         style="width: 110px; height: 110px; object-fit: cover;">
                    <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-success border border-2 border-white p-2" title="Akun Aktif">
                        <span class="visually-hidden">Aktif</span>
                    </span>
                </div>
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-muted small mb-2">{{ $user->email }}</p>

                <div class="d-flex flex-wrap justify-content-center gap-1 mb-3">
                    @forelse($user->roles as $role)
                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                            <i class="fas fa-shield-alt me-1"></i> {{ ucwords(str_replace('_', ' ', $role->name)) }}
                        </span>
                    @empty
                        <span class="badge bg-secondary px-3 py-2 rounded-pill">User</span>
                    @endforelse
                </div>

                <hr class="my-3 opacity-25">

                <div class="text-start small">
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted"><i class="fas fa-id-card me-2"></i> User ID</span>
                        <span class="fw-semibold">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted"><i class="fas fa-calendar-alt me-2"></i> Bergabung</span>
                        <span class="fw-semibold">{{ $stats['created_at'] }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted"><i class="fas fa-check-circle me-2"></i> Status</span>
                        <span class="badge bg-success">Aktif</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('profile.settings') }}" class="btn btn-outline-primary w-100 btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit Data Akun
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Column: Detailed Info & Roles Permissions --}}
        <div class="col-lg-8 col-md-7">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-transparent py-3 px-4">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-info-circle me-2"></i> Detail Informasi Akun
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block mb-1">Nama Lengkap</small>
                                <span class="fw-bold">{{ $user->name }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block mb-1">Alamat Email</small>
                                <span class="fw-bold">{{ $user->email }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block mb-1">Nomor Induk Siswa (NIS) / NIP</small>
                                <span class="fw-bold">{{ $user->nis ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block mb-1">Kompetensi Keahlian / Jurusan</small>
                                <span class="fw-bold">{{ $user->kompetensi_keahlian ?? '-' }}</span>
                            </div>
                        </div>
                        @if($user->jenis_guru)
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block mb-1">Jenis Guru</small>
                                <span class="fw-bold text-capitalize">{{ $user->jenis_guru }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Portal Cards --}}
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3 px-4">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-compass me-2"></i> Akses Cepat Navigasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('profile.settings') }}" class="card bg-light text-decoration-none p-3 text-center border h-100 hover-lift">
                                <i class="fas fa-user-cog fa-2x text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1">Pengaturan Profil</h6>
                                <small class="text-muted">Ubah nama, email, dan kata sandi</small>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('profile.balance') }}" class="card bg-light text-decoration-none p-3 text-center border h-100 hover-lift">
                                <i class="fas fa-chart-line fa-2x text-success mb-2"></i>
                                <h6 class="fw-bold mb-1">Aktivitas & Kredit</h6>
                                <small class="text-muted">Lihat statistik dan rekapitulasi</small>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('logout') }}" method="POST" class="h-100">
                                @csrf
                                <button type="submit" class="card bg-light text-decoration-none p-3 text-center border w-100 h-100 hover-lift btn-link text-start" style="border: 1px solid var(--border-color) !important;">
                                    <div class="w-100 text-center">
                                        <i class="fas fa-sign-out-alt fa-2x text-danger mb-2"></i>
                                        <h6 class="fw-bold text-danger mb-1">Keluar Akun</h6>
                                        <small class="text-muted">Logout dari sesi SIMILA</small>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
