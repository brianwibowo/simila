@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-book-open text-primary me-2"></i> Kurikulum Bersama Vokasi
            </h1>
            <p class="text-muted mb-0">Penyelarasan kurikulum kejuruan SMKN 1 Rembang bersama mitra Dunia Usaha & Dunia Industri (DUDI).</p>
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
                <i class="fas fa-list-alt text-primary me-2"></i> Daftar Dokumen Kurikulum Terpadu
            </h5>
        </div>
        <div class="card-body">
            @if($kurikulums->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">Belum ada dokumen kurikulum bersama yang dipublikasikan.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>Nama Kurikulum & Konsentrasi</th>
                                <th>Mitra Industri</th>
                                <th>Tahun Ajaran</th>
                                <th>Status Validasi</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kurikulums as $index => $k)
                                <tr>
                                    <td>{{ $kurikulums->firstItem() + $index }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $k->nama_kurikulum }}</div>
                                        <small class="text-muted">{{ Str::limit($k->deskripsi, 60) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-building text-primary me-1"></i>
                                            {{ $k->perusahaan->nama_perusahaan ?? $k->perusahaan->name ?? 'Mitra Industri' }}
                                        </span>
                                    </td>
                                    <td><span class="badge bg-secondary">{{ $k->tahun_ajaran ?? '-' }}</span></td>
                                    <td>
                                        @if($k->validasi_sekolah == 'disetujui' && $k->validasi_perusahaan == 'disetujui')
                                            <span class="badge bg-success"><i class="fas fa-check-double me-1"></i> Tervalidasi 2 Arah</span>
                                        @elseif($k->validasi_sekolah == 'disetujui' || $k->validasi_perusahaan == 'disetujui')
                                            <span class="badge bg-info"><i class="fas fa-check me-1"></i> Tervalidasi Parsial</span>
                                        @else
                                            <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Dalam Penelaahan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('siswa-kurikulum-show', $k->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                        @if($k->file_kurikulum)
                                            <a href="{{ asset('storage/' . $k->file_kurikulum) }}" target="_blank" class="btn btn-sm btn-primary" title="Unduh Silabus">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $kurikulums->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
