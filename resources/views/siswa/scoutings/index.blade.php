@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-user-friends text-dark me-2"></i> Talent Scouting Siswa & Lulusan
            </h1>
            <p class="text-muted mb-0">Perekrutan talenta vokasi, magang kerja lanjutan, dan penyerapan lulusan oleh mitra industri.</p>
        </div>
        <a href="{{ route('siswa-scouting-status') }}" class="btn btn-outline-dark">
            <i class="fas fa-history me-1"></i> Status Lamaran Saya
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse ($batches as $batch)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 bg-light rounded-3">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3">
                            <span class="badge bg-dark text-white mb-2">Talent Scouting</span>
                            <h5 class="card-title font-weight-bold text-dark mb-1">{{ $batch->batch }}</h5>
                            @if($batch->perusahaan)
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fas fa-building text-primary me-1"></i> {{ $batch->perusahaan->nama_perusahaan ?? $batch->perusahaan->name }}
                                </h6>
                            @endif
                        </div>
                        
                        <p class="card-text small text-muted">
                            <i class="fas fa-calendar-times me-1"></i> Batas Akhir: {{ \Carbon\Carbon::parse($batch->tanggal_selesai)->format('d F Y') }}
                        </p>

                        <div class="mt-auto pt-3 border-top text-end">
                            @if (in_array($batch->id, $appliedBatchIds))
                                <button class="btn btn-sm btn-success w-100" disabled>
                                    <i class="fas fa-check"></i> Sudah Mendaftar
                                </button>
                            @else
                                <a href="{{ route('siswa-scouting-register', ['scouting' => $batch->id]) }}" class="btn btn-sm btn-primary w-100">
                                    <i class="fas fa-paper-plane me-1"></i> Daftar Talent Scouting
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card text-center py-5 shadow-sm border-0">
                    <div class="card-body">
                        <i class="fas fa-search-minus fa-3x text-muted mb-3"></i>
                        <p class="card-text">Saat ini belum ada batch talent scouting yang dibuka.</p>
                        <p class="text-muted small">Silakan periksa kembali di lain waktu.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
