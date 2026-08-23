@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-project-diagram text-warning me-2"></i> Project Mitra (PBL / Teaching Factory)
            </h1>
            <p class="text-muted mb-0">Project riil pesanan industri yang dikerjakan melalui model Project-Based Learning dan TeFa.</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="card-title fw-bold text-dark mb-0">
                <i class="fas fa-tasks text-warning me-2"></i> Daftar Project Industri Aktif
            </h5>
        </div>
        <div class="card-body">
            @if($projects->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-laptop-code fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada project mitra yang terdaftar.</p>
                </div>
            @else
                <div class="row">
                    @foreach ($projects as $proj)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 bg-light rounded-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-3">
                                        <span class="badge bg-warning text-dark mb-2">Project Mitra</span>
                                        <h5 class="card-title font-weight-bold text-dark mb-1">{{ $proj->nama_project }}</h5>
                                        <small class="text-muted">
                                            <i class="fas fa-building text-primary me-1"></i> {{ $proj->perusahaan->nama_perusahaan ?? $proj->perusahaan->name ?? 'Mitra Industri' }}
                                        </small>
                                    </div>

                                    <p class="card-text small text-muted">
                                        {{ Str::limit($proj->deskripsi, 100) }}
                                    </p>

                                    <div class="mt-auto pt-3 border-top small">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Periode:</span>
                                            <span class="fw-bold text-dark">
                                                {{ \Carbon\Carbon::parse($proj->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($proj->tanggal_selesai)->format('d M Y') }}
                                            </span>
                                        </div>

                                        <div class="d-flex gap-2 mt-3">
                                            <a href="{{ route('siswa-project-show', $proj->id) }}" class="btn btn-sm btn-outline-warning text-dark w-100 font-weight-bold">
                                                <i class="fas fa-eye me-1"></i> Detail Project
                                            </a>
                                            @if($proj->file_brief)
                                                <a href="{{ asset('storage/' . $proj->file_brief) }}" target="_blank" class="btn btn-sm btn-primary" title="Unduh Project Brief">
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
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
