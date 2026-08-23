@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-flask text-success me-2"></i> Detail Riset Terapan
            </h1>
            <p class="text-muted mb-0">Informasi proyek inovasi produk kejuruan dan kemitraan industri.</p>
        </div>
        <a href="{{ route('siswa-riset-index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <span class="badge bg-success text-white mb-1">Inovasi Produk Bersama</span>
                    <h4 class="card-title fw-bold text-dark mb-0">{{ $riset->topik }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold text-secondary">Latar Belakang & Deskripsi Riset:</h6>
                        <p class="text-muted" style="line-height: 1.8;">
                            {{ $riset->deskripsi ?? 'Belum ada deskripsi lengkap.' }}
                        </p>
                    </div>

                    @if($riset->file_proposal)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">Dokumen Proposal / Desain Produk</div>
                                    <small class="text-muted">Unduh rancangan dan metodologi riset</small>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $riset->file_proposal) }}" target="_blank" class="btn btn-success">
                                <i class="fas fa-download me-1"></i> Unduh Proposal
                            </a>
                        </div>
                    @endif

                    @if($riset->dokumentasi)
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-images text-primary fa-2x me-3"></i>
                                <div>
                                    <div class="fw-bold text-dark">Dokumentasi Produk & Hasil Uji Coba</div>
                                    <small class="text-muted">Foto dan laporan hasil implementasi inovasi</small>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $riset->dokumentasi) }}" target="_blank" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> Lihat Dokumentasi
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="card-title fw-bold text-dark mb-0">Tim Peneliti & Pelaksana</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="text-muted small">Status Riset:</span>
                        <div class="mt-1">
                            @if($riset->status == 'disetujui')
                                <span class="badge bg-success">Selesai / Terverifikasi</span>
                            @else
                                <span class="badge bg-warning text-dark">Dalam Pengerjaan</span>
                            @endif
                        </div>
                    </div>

                    <h6 class="fw-bold text-dark small mb-2">Anggota Tim:</h6>
                    <ul class="list-group list-group-flush small">
                        @forelse($riset->anggota as $anggota)
                            <li class="list-group-item px-0 py-2 d-flex align-items-center">
                                <i class="fas fa-user-circle text-secondary me-2 fa-lg"></i>
                                <div>
                                    <div class="fw-bold text-dark">{{ $anggota->user->name ?? 'Pengguna' }}</div>
                                    <small class="text-muted">{{ $anggota->user->getRoleNames()->first() ?? 'Anggota' }}</small>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item px-0 text-muted">Belum ada data anggota tim tercatat.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
