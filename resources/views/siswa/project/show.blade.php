@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-project-diagram text-warning me-2"></i> Detail Project Mitra
            </h1>
            <p class="text-muted mb-0">Rincian spesifikasi project industri, timeline, dan dokumen brief.</p>
        </div>
        <a href="{{ route('siswa-project-index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <span class="badge bg-warning text-dark mb-1">Project Berbasis Industri (PBL)</span>
                    <h4 class="card-title fw-bold text-dark mb-0">{{ $project->nama_project }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold text-secondary">Deskripsi & Ruang Lingkup Pengerjaan:</h6>
                        <p class="text-muted" style="line-height: 1.8;">
                            {{ $project->deskripsi ?? 'Belum ada deskripsi lengkap project.' }}
                        </p>
                    </div>

                    @if($project->file_brief)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">Dokumen Project Brief / TOR</div>
                                    <small class="text-muted">Unduh panduan teknis dan deliverable yang diharapkan</small>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $project->file_brief) }}" target="_blank" class="btn btn-warning text-dark font-weight-bold">
                                <i class="fas fa-download me-1"></i> Unduh Brief
                            </a>
                        </div>
                    @endif

                    @if($project->file_laporan)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-alt text-success fa-2x me-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">Laporan Akhir Project Mitra</div>
                                    <small class="text-muted">Dokumen hasil akhir dan evaluasi project</small>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $project->file_laporan) }}" target="_blank" class="btn btn-outline-success">
                                <i class="fas fa-file-download me-1"></i> Unduh Laporan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="card-title fw-bold text-dark mb-0">Informasi Kemitraan & Jadwal</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Mitra Industri:</span>
                            <span class="fw-bold text-dark">{{ $project->perusahaan->nama_perusahaan ?? $project->perusahaan->name ?? 'Mitra Industri' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Tanggal Mulai:</span>
                            <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('d F Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Batas Selesai:</span>
                            <span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($project->tanggal_selesai)->format('d F Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
