@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-chalkboard-teacher text-info me-2"></i> Program Guru Tamu Industri
            </h1>
            <p class="text-muted mb-0">Jadwal kuliah praktisi, workshop kejuruan, dan transfer pengetahuan dari pakar industri.</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="card-title fw-bold text-dark mb-0">
                <i class="fas fa-calendar-alt text-info me-2"></i> Sesi Guru Tamu Industri
            </h5>
        </div>
        <div class="card-body">
            @if($guruTamus->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-user-tie fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada agenda guru tamu yang dijadwalkan.</p>
                </div>
            @else
                <div class="row">
                    @foreach ($guruTamus as $gt)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 bg-light rounded-3">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-3" style="width: 46px; height: 46px; min-width: 46px;">
                                            <i class="fas fa-user-tie fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0">{{ $gt->nama_karyawan }}</h6>
                                            <small class="text-muted">{{ $gt->jabatan ?? 'Praktisi Industri' }}</small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <span class="badge bg-white text-dark border mb-2">
                                            <i class="fas fa-tools text-primary me-1"></i> Keahlian: {{ $gt->keahlian ?? '-' }}
                                        </span>
                                        <p class="card-text small text-muted">
                                            {{ Str::limit($gt->deskripsi, 100) }}
                                        </p>
                                    </div>

                                    <div class="mt-auto pt-3 border-top small">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted"><i class="fas fa-calendar me-1"></i> Jadwal:</span>
                                            <span class="fw-bold text-dark">{{ $gt->formatted_jadwal }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="text-muted">Status:</span>
                                            @if($gt->status == 'disetujui')
                                                <span class="badge bg-success">Terkonfirmasi</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Direncanakan</span>
                                            @endif
                                        </div>

                                        <div class="d-flex gap-2">
                                            <a href="{{ route('siswa-guru-tamu-show', $gt->id) }}" class="btn btn-sm btn-outline-info w-100">
                                                <i class="fas fa-eye me-1"></i> Detail Sesi
                                            </a>
                                            @if($gt->file_materi)
                                                <a href="{{ asset('storage/' . $gt->file_materi) }}" target="_blank" class="btn btn-sm btn-primary" title="Unduh Materi">
                                                    <i class="fas fa-download"></i>
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
                    {{ $guruTamus->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
