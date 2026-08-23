@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-book-open text-primary me-2"></i> Detail Kurikulum Bersama
            </h1>
            <p class="text-muted mb-0">Informasi penyelarasan kompetensi kejuruan dan industri.</p>
        </div>
        <a href="{{ route('siswa-kurikulum-index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="card-title fw-bold text-dark mb-0">{{ $kurikulum->nama_kurikulum }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold text-secondary">Deskripsi & Ruang Lingkup Kompetensi:</h6>
                        <p class="text-muted" style="line-height: 1.7;">
                            {{ $kurikulum->deskripsi ?? 'Belum ada deskripsi khusus.' }}
                        </p>
                    </div>

                    @if($kurikulum->komentar)
                        <div class="alert alert-info border-0 shadow-none">
                            <h6 class="fw-bold mb-1"><i class="fas fa-comment-dots me-1"></i> Catatan Penyelarasan Industri:</h6>
                            <p class="mb-0 small">{{ $kurikulum->komentar }}</p>
                        </div>
                    @endif

                    @if($kurikulum->file_kurikulum)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">Berkas Silabus / Dokumen Kurikulum</div>
                                    <small class="text-muted">Unduh file kurikulum resmi yang telah diselaraskan</small>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $kurikulum->file_kurikulum) }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-download me-1"></i> Unduh Berkas
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="card-title fw-bold text-dark mb-0">Informasi Kemitraan</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Mitra Industri:</span>
                            <span class="fw-bold text-dark">{{ $kurikulum->perusahaan->nama_perusahaan ?? $kurikulum->perusahaan->name ?? 'Mitra Industri' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Tahun Ajaran:</span>
                            <span class="fw-bold text-dark">{{ $kurikulum->tahun_ajaran ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Validasi Sekolah:</span>
                            <span>
                                @if($kurikulum->validasi_sekolah == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-warning text-dark">Proses</span>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Validasi Industri:</span>
                            <span>
                                @if($kurikulum->validasi_perusahaan == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-warning text-dark">Proses</span>
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
