@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-history text-dark me-2"></i> Status Lamaran Talent Scouting
            </h1>
            <p class="text-muted mb-0">Riwayat pengajuan berkas talent scouting dan hasil seleksi industri.</p>
        </div>
        <a href="{{ route('siswa-scouting-index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Lowongan
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            @if ($talents->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Anda belum pernah mendaftar pada program Talent Scouting manapun.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Batch / Program</th>
                                <th>Mitra Industri</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Berkas</th>
                                <th>Status Seleksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($talents as $index => $talent)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-bold text-dark">{{ $talent->batch->batch ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-building text-primary me-1"></i>
                                            {{ $talent->batch->perusahaan->nama_perusahaan ?? $talent->batch->perusahaan->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td>{{ $talent->created_at->format('d F Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            @if($talent->file_cv)
                                                <a href="{{ asset('storage/' . $talent->file_cv) }}" target="_blank" class="btn btn-outline-primary" title="Lihat CV">
                                                    <i class="fas fa-file-pdf"></i> CV
                                                </a>
                                            @endif
                                            @if($talent->file_pernyataan)
                                                <a href="{{ asset('storage/' . $talent->file_pernyataan) }}" target="_blank" class="btn btn-outline-secondary" title="Pernyataan">
                                                    <i class="fas fa-file-alt"></i> Surat
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($talent->status_seleksi == 'lolos')
                                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Lolos Seleksi</span>
                                        @elseif ($talent->status_seleksi == 'tidak lolos')
                                            <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Tidak Lolos</span>
                                        @else
                                            <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Dalam Peninjauan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
