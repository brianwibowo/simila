@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-flask text-success me-2"></i> Riset Terapan & Inovasi Produk
            </h1>
            <p class="text-muted mb-0">Riset aplikatif, hilirisasi produk inovasi, dan kolaborasi teknologi bersama dunia usaha/dunia industri.</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="card-title fw-bold text-dark mb-0">
                <i class="fas fa-microscope text-success me-2"></i> Daftar Riset & Produk Inovasi
            </h5>
        </div>
        <div class="card-body">
            @if($risets->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-flask fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada riset terapan yang dipublikasikan.</p>
                </div>
            @else
                <div class="row">
                    @foreach ($risets as $r)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 bg-light rounded-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-3">
                                        <span class="badge bg-success text-white mb-2">Inovasi Terapan</span>
                                        <h5 class="card-title font-weight-bold text-dark mb-1">{{ $r->topik }}</h5>
                                    </div>

                                    <p class="card-text small text-muted">
                                        {{ Str::limit($r->deskripsi, 110) }}
                                    </p>

                                    <div class="mt-auto pt-3 border-top small">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted"><i class="fas fa-users me-1"></i> Tim Peneliti:</span>
                                            <span class="badge bg-secondary">{{ $r->anggota->count() }} Anggota</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="text-muted">Status:</span>
                                            @if($r->status == 'disetujui')
                                                <span class="badge bg-success">Selesai / Terverifikasi</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Dalam Pengerjaan</span>
                                            @endif
                                        </div>

                                        <div class="d-flex gap-2">
                                            <a href="{{ route('siswa-riset-show', $r->id) }}" class="btn btn-sm btn-outline-success w-100 font-weight-bold">
                                                <i class="fas fa-eye me-1"></i> Detail Riset
                                            </a>
                                            @if($r->file_proposal)
                                                <a href="{{ asset('storage/' . $r->file_proposal) }}" target="_blank" class="btn btn-sm btn-primary" title="Unduh Proposal / Dokumen">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    {{ $risets->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
