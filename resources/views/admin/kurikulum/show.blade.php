@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h1 class="h4 mb-1">Detail Kurikulum</h1>
                                <p class="text-muted mb-0">Informasi lengkap kurikulum</p>
                            </div>
                            @if($source == 'validasi')
                                <a href="{{ route('admin-kurikulum-list-validasi') }}" class="btn btn-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                            @elseif($source == 'validasi-sekolah')
                                <a href="{{ route('admin-kurikulum-list-validasi-sekolah') }}" class="btn btn-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                            @else
                                <a href="{{ route('admin-kurikulum-list-diajukan') }}" class="btn btn-secondary d-flex align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali
                                </a>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">{{ $kurikulum->nama_kurikulum }}</h5>

                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 30%">Nama Kurikulum</th>
                                                    <td>{{ $kurikulum->nama_kurikulum }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tahun Ajaran</th>
                                                    <td>{{ $kurikulum->tahun_ajaran }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pengirim</th>
                                                    <td>
                                                        @if($kurikulum->pengirim->hasRole('waka_kurikulum'))
                                                            {{ $kurikulum->pengirim->name }} (Waka Kurikulum)
                                                        @elseif($kurikulum->pengirim->hasRole('perusahaan'))
                                                            {{ $kurikulum->pengirim->name }} (Perusahaan)
                                                        @elseif($kurikulum->pengirim->hasRole('admin'))
                                                            Admin 
                                                            @if($kurikulum->perusahaan_id)
                                                                (untuk Sekolah)
                                                            @else
                                                                (untuk Perusahaan)
                                                            @endif
                                                        @else
                                                            {{ $kurikulum->pengirim->name }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    @if($kurikulum->pengirim->hasRole('perusahaan') || ($kurikulum->pengirim->hasRole('admin') && !$kurikulum->perusahaan_id))
                                                        <th>Diajukan Kepada</th>
                                                        <td>Sekolah</td>
                                                    @else
                                                        <th>Perusahaan Tujuan</th>
                                                        <td>
                                                            @if($kurikulum->perusahaan_id && $perusahaan)
                                                                {{ $perusahaan->name }}
                                                            @else
                                                                <span class="text-muted">Semua Perusahaan</span>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Pengajuan</th>
                                                    <td>{{ \Carbon\Carbon::parse($kurikulum->created_at)->format('d F Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>File Kurikulum</th>
                                                    <td>
                                                        <a href="{{ asset('storage/'.$kurikulum->file_kurikulum) }}" target="_blank" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-download me-1"></i> Unduh File
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Deskripsi Kurikulum</h5>
                                        <div class="mb-0">
                                            <p>{{ $kurikulum->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Status Validasi</h5>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span>Validasi Sekolah:</span>
                                            <span class="badge {{ $kurikulum->validasi_sekolah == 'disetujui' ? 'bg-success' : ($kurikulum->validasi_sekolah == 'tidak_disetujui' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ $kurikulum->validasi_sekolah == 'disetujui' ? 'Disetujui' : ($kurikulum->validasi_sekolah == 'tidak_disetujui' ? 'Ditolak' : 'Menunggu') }}
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Validasi Perusahaan:</span>
                                            <span class="badge {{ $kurikulum->validasi_perusahaan == 'disetujui' ? 'bg-success' : ($kurikulum->validasi_perusahaan == 'tidak_disetujui' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ $kurikulum->validasi_perusahaan == 'disetujui' ? 'Disetujui' : ($kurikulum->validasi_perusahaan == 'tidak_disetujui' ? 'Ditolak' : 'Menunggu') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if($kurikulum->komentar)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Komentar</h5>
                                        <div class="mb-0">
                                            <p>{{ $kurikulum->komentar }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Aksi</h5>
                                        <div class="d-grid gap-2">
                                            @if($source == 'validasi')
                                                @if($kurikulum->validasi_sekolah == 'proses')
                                                    <form action="{{ route('admin-kurikulum-setuju', $kurikulum) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success w-100 mb-1">
                                                            <i class="bi bi-check-lg me-1"></i> Setujui Kurikulum (Sebagai Sekolah)
                                                        </button>
                                                    </form>
                                                    <button type="button" 
                                                            class="btn btn-danger w-100"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#tolakModal" 
                                                            data-kurikulum-id="{{ $kurikulum->id }}">
                                                        <i class="bi bi-x-lg me-1"></i> Tolak Kurikulum (Sebagai Sekolah)
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary" disabled>
                                                        <i class="bi bi-lock me-1"></i> Sudah Divalidasi oleh Sekolah
                                                    </button>
                                                @endif
                                            @elseif($source == 'validasi-sekolah')
                                                @if($kurikulum->validasi_perusahaan == 'proses')
                                                    <form action="{{ route('admin-kurikulum-setuju', $kurikulum) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success w-100 mb-1">
                                                            <i class="bi bi-check-lg me-1"></i> Setujui Kurikulum (Sebagai Perusahaan)
                                                        </button>
                                                    </form>
                                                    <button type="button" 
                                                            class="btn btn-danger w-100"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#tolakSekolahModal" 
                                                            data-kurikulum-id="{{ $kurikulum->id }}">
                                                        <i class="bi bi-x-lg me-1"></i> Tolak Kurikulum (Sebagai Perusahaan)
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary" disabled>
                                                        <i class="bi bi-lock me-1"></i> Sudah Divalidasi oleh Perusahaan
                                                    </button>
                                                @endif
                                            @else
                                                @if($kurikulum->validasi_sekolah != 'disetujui' || $kurikulum->validasi_perusahaan != 'disetujui')
                                                    <a href="{{ route('admin-kurikulum-edit', $kurikulum) }}" class="btn btn-warning mb-1">
                                                        <i class="bi bi-pencil me-1"></i> Edit Kurikulum
                                                    </a>
                                                    <form action="{{ route('admin-kurikulum-destroy', $kurikulum) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kurikulum ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger w-100">
                                                            <i class="bi bi-trash me-1"></i> Hapus Kurikulum
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-secondary" disabled>
                                                        <i class="bi bi-lock me-1"></i> Kurikulum Sudah Disetujui
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($source == 'validasi')
    <!-- Modal untuk menolak kurikulum (sebagai sekolah) -->
    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tolakModalLabel">Tolak Kurikulum (Sebagai Sekolah)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="tolakForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="komentar" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="komentar" name="komentar" rows="4" required></textarea>
                            <div class="form-text">Berikan alasan mengapa kurikulum ini ditolak. Alasan akan ditampilkan kepada pengirim.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Kurikulum</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @elseif($source == 'validasi-sekolah')
    <!-- Modal untuk menolak kurikulum (sebagai perusahaan) -->
    <div class="modal fade" id="tolakSekolahModal" tabindex="-1" aria-labelledby="tolakSekolahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tolakSekolahModalLabel">Tolak Kurikulum (Sebagai Perusahaan)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="tolakSekolahForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="komentar" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="komentar" name="komentar" rows="4" required></textarea>
                            <div class="form-text">Berikan alasan mengapa kurikulum ini ditolak. Alasan akan ditampilkan kepada pengirim.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Kurikulum</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configure the reject modal
        const tolakModal = document.getElementById('tolakModal');
        if (tolakModal) {
            const tolakForm = document.getElementById('tolakForm');
            
            tolakModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const kurikulumId = button.getAttribute('data-kurikulum-id');
                tolakForm.action = `/admin/kurikulum/${kurikulumId}/tolak`;
            });
        }
        
        // Configure the reject sekolah modal
        const tolakSekolahModal = document.getElementById('tolakSekolahModal');
        if (tolakSekolahModal) {
            const tolakSekolahForm = document.getElementById('tolakSekolahForm');
            
            tolakSekolahModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const kurikulumId = button.getAttribute('data-kurikulum-id');
                tolakSekolahForm.action = `/admin/kurikulum/${kurikulumId}/tolak-sekolah`;
            });
        }
    });
    </script>
@endsection
