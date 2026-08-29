@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 fw-bold text-primary mb-1">
                <i class="fas fa-wallet me-2"></i> Ringkasan Aktivitas & Portofolio
            </h1>
            <p class="text-muted small mb-0">Rekapitulasi kredit portofolio, keaktifan program, dan keterlibatan mitra industri.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Profil
            </a>
            <a href="{{ route('profile.settings') }}" class="btn btn-primary btn-sm px-3">
                <i class="fas fa-cog me-1"></i> Pengaturan
            </a>
        </div>
    </div>

    {{-- Top Overview KPI Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 p-3 text-center">
                <i class="fas fa-coins fa-2x text-warning mb-2"></i>
                <h3 class="fw-bold text-warning mb-0">{{ $activities['kredit_portofolio'] }}</h3>
                <small class="text-muted">Kredit Portofolio</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 p-3 text-center">
                <i class="fas fa-fire fa-2x text-danger mb-2"></i>
                <h3 class="fw-bold text-danger mb-0">{{ $activities['skor_keaktifan'] }}%</h3>
                <small class="text-muted">Skor Keaktifan</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 p-3 text-center">
                <i class="fas fa-briefcase fa-2x text-primary mb-2"></i>
                <h3 class="fw-bold text-primary mb-0">{{ $activities['program_diikuti'] }}</h3>
                <small class="text-muted">Program Diikuti</small>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 p-3 text-center">
                <i class="fas fa-check-double fa-2x text-success mb-2"></i>
                <h3 class="fw-bold text-success mb-0">Aktif</h3>
                <small class="text-muted">Status Kemitraan</small>
            </div>
        </div>
    </div>

    {{-- Activity Details --}}
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-transparent py-3 px-4">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-history me-2"></i> Riwayat Program & Modul Kemitraan
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Program / Modul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Poin / Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-bold">Praktik Kerja Lapangan (PKL)</div>
                                        <small class="text-muted">Kemitraan Industri & Dunia Kerja</small>
                                    </td>
                                    <td><span class="badge bg-primary">PKL</span></td>
                                    <td><span class="badge bg-success">Terverifikasi</span></td>
                                    <td class="fw-bold text-success">+50 Pts</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-bold">Ujian Sertifikasi Kompetensi (LSP)</div>
                                        <small class="text-muted">Standarisasi BNSP & Industri</small>
                                    </td>
                                    <td><span class="badge bg-info">Sertifikasi</span></td>
                                    <td><span class="badge bg-success">Kompeten</span></td>
                                    <td class="fw-bold text-success">+35 Pts</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-bold">Kelas Guru Tamu Industri</div>
                                        <small class="text-muted">Transfer Wawasan Praktisi</small>
                                    </td>
                                    <td><span class="badge bg-warning text-dark">Guru Tamu</span></td>
                                    <td><span class="badge bg-primary">Selesai</span></td>
                                    <td class="fw-bold text-success">+20 Pts</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-bold">Project Mitra Industri</div>
                                        <small class="text-muted">Problem-Solving Nyata</small>
                                    </td>
                                    <td><span class="badge bg-secondary">Project</span></td>
                                    <td><span class="badge bg-info">Berlangsung</span></td>
                                    <td class="fw-bold text-warning">+15 Pts</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-transparent py-3 px-4">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-award me-2"></i> Level Partisipasi
                    </h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <i class="fas fa-medal fa-3x text-warning mb-2"></i>
                        <h5 class="fw-bold mb-1">Mitra Berprestasi</h5>
                        <small class="text-muted">Tingkat kontribusi aktif dalam sistem kemitraan</small>
                    </div>
                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted d-block">80% menuju badge Keunggulan Industri</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
