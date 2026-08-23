@extends('layouts.layout')

@section('content')
<div class="container-fluid px-4 py-4">
    {{-- 1. Top Welcome Banner --}}
    <div class="card card-round border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white;">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <span class="badge bg-white text-primary fw-bold mb-2 px-3 py-2 rounded-pill">
                        <i class="fas fa-user-graduate me-1"></i> Dashboard Siswa SMK
                    </span>
                    <h2 class="fw-bold mb-2 text-white">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                        Aplikasi SIMILA menghubungkan Anda dengan seluruh program kemitraan Dunia Usaha & Dunia Industri (DUDI) SMKN 1 Rembang.
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="d-inline-flex align-items-center bg-white bg-opacity-10 border border-white border-opacity-25 rounded-3 p-3 text-start">
                        <i class="fas fa-id-card fa-2x text-white me-3"></i>
                        <div>
                            <div class="text-white fw-bold" style="font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                            <div class="text-white-50 small">{{ Auth::user()->email }}</div>
                            <span class="badge bg-success mt-1" style="font-size: 0.7rem;">Siswa Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. 8 Pilar Penyelarasan Vokasi Grid Cards --}}
    <div class="card card-round shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="card-title fw-bold text-dark mb-0">
                        <i class="fas fa-th-large text-primary me-2"></i> 8 Pilar Kemitraan & Penyelarasan Vokasi
                    </h5>
                    <p class="text-muted mb-0" style="font-size: 0.85rem;">Pintas cepat akses modul pembelajaran dan kemitraan industri untuk siswa</p>
                </div>
                <span class="badge bg-primary px-3 py-2 rounded-pill">8 Modul Lengkap</span>
            </div>
        </div>
        <div class="card-body px-4 py-4">
            <div class="row g-3">
                {{-- Pilar 1: Kurikulum Bersama --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('siswa-kurikulum-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-primary mb-2"><i class="fas fa-book-open fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">1. Kurikulum Bersama</h6>
                        <p class="text-muted small mb-2">Penyelarasan kurikulum 2 arah dengan DUDI</p>
                        <span class="badge bg-white text-primary border mt-auto py-1">{{ $stats['total_kurikulum'] ?? 0 }} Kurikulum</span>
                    </a>
                </div>

                {{-- Pilar 2: PKL & Logbook --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('siswa-pkl-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-success mb-2"><i class="fas fa-briefcase fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">2. PKL & Logbook Digital</h6>
                        <p class="text-muted small mb-2">Pendaftaran magang & jurnal harian berfoto</p>
                        <span class="badge bg-white text-success border mt-auto py-1">Katalog & Jurnal Harian</span>
                    </a>
                </div>

                {{-- Pilar 3: Guru Tamu Industri --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('siswa-guru-tamu-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-info mb-2"><i class="fas fa-chalkboard-teacher fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">3. Guru Tamu Industri</h6>
                        <p class="text-muted small mb-2">Jadwal kuliah praktisi & materi pakar</p>
                        <span class="badge bg-white text-info border mt-auto py-1">{{ $stats['total_guru_tamu'] ?? 0 }} Sesi Terjadwal</span>
                    </a>
                </div>

                {{-- Pilar 4: Project Mitra (PBL / TeFa) --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('siswa-project-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-warning mb-2"><i class="fas fa-project-diagram fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">4. Project Mitra (PBL)</h6>
                        <p class="text-muted small mb-2">Project riil industri & Teaching Factory</p>
                        <span class="badge bg-white text-warning text-dark border mt-auto py-1">{{ $stats['total_project'] ?? 0 }} Project TeFa</span>
                    </a>
                </div>

                {{-- Pilar 5: MOOC Pelatihan Mandiri --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('siswa-mooc-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-danger mb-2"><i class="fas fa-graduation-cap fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">5. Modul Belajar (MOOC)</h6>
                        <p class="text-muted small mb-2">Pelatihan mandiri daring & video materi</p>
                        <span class="badge bg-white text-danger border mt-auto py-1">{{ $stats['total_mooc'] ?? 0 }} Kursus Tersedia</span>
                    </a>
                </div>

                {{-- Pilar 6: Beasiswa & Talent Scouting --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('siswa-beasiswa-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-secondary mb-2"><i class="fas fa-medal fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">6. Beasiswa & Scouting</h6>
                        <p class="text-muted small mb-2">Beasiswa industri & rekruitmen talenta</p>
                        <span class="badge bg-white text-secondary border mt-auto py-1">Peluang Karir & Beasiswa</span>
                    </a>
                </div>

                {{-- Pilar 7: Uji Sertifikasi LSP BNSP --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('siswa-sertifikasi-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-primary mb-2"><i class="fas fa-certificate fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">7. Sertifikasi BNSP (LSP)</h6>
                        <p class="text-muted small mb-2">Uji kompetensi profesi & sertifikat resmi</p>
                        <span class="badge bg-white text-primary border mt-auto py-1">Uji Kompetensi</span>
                    </a>
                </div>

                {{-- Pilar 8: Riset Terapan & Inovasi Produk --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('siswa-riset-index') }}" class="card card-body h-100 text-decoration-none border shadow-none bg-light hover-shadow text-center p-3 rounded-3">
                        <div class="text-success mb-2"><i class="fas fa-flask fa-2x"></i></div>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">8. Riset & Inovasi Produk</h6>
                        <p class="text-muted small mb-2">Kolaborasi inovasi produk dengan DUDI</p>
                        <span class="badge bg-white text-success border mt-auto py-1">{{ $stats['total_riset'] ?? 0 }} Inovasi Produk</span>
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
    border-color: #2563eb !important;
}
</style>
@endsection