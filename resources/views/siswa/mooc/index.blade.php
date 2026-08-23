@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-graduation-cap text-danger me-2"></i> Modul Belajar Mandiri (MOOC)
            </h1>
            <p class="text-muted mb-0">Platform pembelajaran daring vokasi yang disusun bersama industri mitra untuk pengayaan kompetensi kejuruan.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="card-title fw-bold text-dark mb-0">
                <i class="fas fa-book text-danger me-2"></i> Kursus & Modul Tersedia
            </h5>
        </div>
        <div class="card-body">
            @if($moocs->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-video-slash fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada modul pelatihan online yang tersedia.</p>
                </div>
            @else
                <div class="row">
                    @foreach ($moocs as $m)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 bg-light rounded-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-3">
                                        <span class="badge bg-danger text-white mb-2">MOOC Vokasi</span>
                                        <h5 class="card-title font-weight-bold text-dark mb-1">{{ $m->judul_pelatihan }}</h5>
                                        <small class="text-muted">
                                            <i class="fas fa-building text-primary me-1"></i> {{ $m->user->nama_perusahaan ?? $m->user->name ?? 'Mitra Industri' }}
                                        </small>
                                    </div>

                                    <p class="card-text small text-muted">
                                        {{ Str::limit($m->deskripsi, 100) }}
                                    </p>

                                    <div class="mt-auto pt-3 border-top small">
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="text-muted"><i class="fas fa-layer-group me-1"></i> Total Modul:</span>
                                            <span class="badge bg-secondary">{{ $m->modules->count() }} Modul</span>
                                        </div>

                                        <a href="{{ route('siswa-mooc-show', $m->id) }}" class="btn btn-sm btn-outline-danger w-100 font-weight-bold">
                                            <i class="fas fa-play-circle me-1"></i> Mulai Belajar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
