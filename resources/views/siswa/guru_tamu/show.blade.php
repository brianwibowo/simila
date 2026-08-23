@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-chalkboard-teacher text-info me-2"></i> Detail Sesi Guru Tamu
            </h1>
            <p class="text-muted mb-0">Informasi materi dan praktisi pengajar tamu industri.</p>
        </div>
        <a href="{{ route('siswa-guru-tamu-index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="card-title fw-bold text-dark mb-0">{{ $guru_tamu->nama_karyawan }}</h5>
                    <small class="text-muted">{{ $guru_tamu->jabatan ?? 'Praktisi Industri' }}</small>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold text-secondary">Bidang Keahlian:</h6>
                        <span class="badge bg-info text-white p-2">{{ $guru_tamu->keahlian ?? '-' }}</span>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold text-secondary">Silabus / Deskripsi Pembelajaran:</h6>
                        <p class="text-muted" style="line-height: 1.7;">
                            {{ $guru_tamu->deskripsi ?? 'Belum ada deskripsi lengkap.' }}
                        </p>
                    </div>

                    @if($guru_tamu->file_materi)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-powerpoint text-warning fa-2x me-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">Slide / Modul Presentasi Guru Tamu</div>
                                    <small class="text-muted">Unduh bahan ajar untuk dipelajari mandiri</small>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $guru_tamu->file_materi) }}" target="_blank" class="btn btn-info text-white">
                                <i class="fas fa-download me-1"></i> Unduh Materi
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="card-title fw-bold text-dark mb-0">Informasi Pelaksanaan</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Jadwal Sesi:</span>
                            <span class="fw-bold text-dark">{{ $guru_tamu->formatted_jadwal }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Status Konfirmasi:</span>
                            <span>
                                @if($guru_tamu->status == 'disetujui')
                                    <span class="badge bg-success">Terkonfirmasi</span>
                                @else
                                    <span class="badge bg-warning text-dark">Dalam Proses</span>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Diajukan Oleh:</span>
                            <span class="fw-bold text-dark">{{ $guru_tamu->submitter->name ?? '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
