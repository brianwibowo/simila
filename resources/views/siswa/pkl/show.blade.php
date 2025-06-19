@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Status PKL Saya</h1>
    </div>

    @php
        $isPklValidated = false;
        $validationStatusText = 'Menunggu Validasi';
        $validationBadgeClass = 'bg-warning text-dark';

        if (auth()->user()->pkl_status === 'disetujui') {
            $isPklValidated = true;
            $validationStatusText = 'Tervalidasi';
            $validationBadgeClass = 'bg-success';
        } elseif (auth()->user()->pkl_status === 'tidak_disetujui') {
            $validationStatusText = 'Ditolak';
            $validationBadgeClass = 'bg-danger';
        } elseif (auth()->user()->pkl_status === 'proses') {
            $validationStatusText = 'Menunggu Validasi Perusahaan';
            $validationBadgeClass = 'bg-warning text-dark';
        }

    @endphp

    @if ($pkl && !$isPklValidated)
        {{-- Tampilan saat PKL menunggu validasi atau ditolak --}}
        <div class="card shadow-sm mb-4 border-{{ $validationBadgeClass === 'bg-warning text-dark' ? 'warning' : 'danger' }}">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                Status Pendaftaran PKL
                <span class="badge {{ $validationBadgeClass }}">{{ $validationStatusText }}</span>
            </div>
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    @if($validationStatusText === 'Tervalidasi')
                        <i class="bi bi-check-circle text-success" style="font-size: 4rem;"></i>
                    @elseif($validationStatusText === 'Ditolak')
                        <i class="bi bi-x-circle text-danger" style="font-size: 4rem;"></i>
                    @else
                        <i class="bi bi-hourglass-split text-warning" style="font-size: 4rem;"></i>
                    @endif
                </div>
                <h5 class="card-title text-muted">Anda telah mendaftar untuk PKL: <strong>{{ $pkl->nama ?? '-' }}</strong></h5>
                <p class="card-text text-muted">
                    @if($validationStatusText === 'Ditolak')
                        Pendaftaran Anda ditolak. Silakan hubungi admin atau pembimbing untuk informasi lebih lanjut.
                    @else
                        Pendaftaran Anda saat ini **{{ strtolower($validationStatusText) }}**. Silakan tunggu konfirmasi dari pihak berwenang.
                    @endif
                </p>
                <p class="text-muted small mt-3">
                    Perusahaan: <strong>{{ $pkl->perusahaan->name ?? 'N/A' }}</strong><br>
                </p>
            </div>
        </div>
    @elseif ($pkl && $isPklValidated)
        {{-- Tampilan saat PKL sudah tervalidasi --}}
        <div class="card shadow-sm mb-4 border-success">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                Detail PKL Anda
                <span class="badge {{ $validationBadgeClass }}">{{ $validationStatusText }}</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5>Judul PKL</h5>
                        <p class="text-muted">{{ $pkl->judul ?? '-' }}</p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <h5>Deskripsi</h5>
                        <div class="p-3 bg-light rounded border">
                            <p class="mb-0">{{ $pkl->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <h5>Perusahaan</h5>
                        <p class="text-muted">{{ $pkl->perusahaan->name ?? 'Perusahaan tidak ditemukan' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5>Lokasi</h5>
                        <p class="text-muted">{{ $pkl->lokasi ?? 'Tidak ada informasi lokasi' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5>Kuota Tersedia</h5>
                        <p class="text-muted">{{ $pkl->kuota ?? 'N/A' }} peserta</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5>Status Pendaftaran PKL (Umum)</h5>
                        <span class="badge {{ $pklRegistrationStatusBadgeClass }}">{{ $pklRegistrationStatusText }}</span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 mb-3">
                        <h5>Periode Pendaftaran</h5>
                        <p class="text-muted">
                            {{ \Carbon\Carbon::parse($pkl->tanggal_mulai)->format('d F Y') }}
                            sampai
                            {{ \Carbon\Carbon::parse($pkl->tanggal_selesai)->format('d F Y') }}
                        </p>
                    </div>
                </div>
                
                {{-- Detail Tambahan Setelah Tervalidasi --}}
                <h5 class="mt-4">Informasi Validasi & Penempatan</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Status Validasi Pembimbing:
                        <span class="badge {{ $pkl->status_pembimbing === 'disetujui' ? 'bg-success' : ($pkl->status_pembimbing === 'revisi' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                            {{ ucfirst($pkl->status_pembimbing ?? 'proses') }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Status Validasi Waka Humas:
                        <span class="badge {{ $pkl->status_waka_humas === 'disetujui' ? 'bg-success' : ($pkl->status_waka_humas === 'ditolak' ? 'bg-danger' : 'bg-secondary') }}">
                            {{ ucfirst($pkl->status_waka_humas ?? 'proses') }}
                        </span>
                    </li>
                    @if($pkl->tanggal_validasi_waka_humas)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Tanggal Validasi Waka Humas:
                        <span class="text-muted">{{ \Carbon\Carbon::parse($pkl->tanggal_validasi_waka_humas)->format('d F Y, H:i') }}</span>
                    </li>
                    @endif
                    @if($pkl->pembimbing)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pembimbing Lapangan:
                        <span class="text-muted">{{ $pkl->pembimbing->name }}</span>
                    </li>
                    @endif
                    {{-- Tambahkan info lain yang hanya relevan setelah tervalidasi --}}
                    {{-- Misal: Alamat lengkap perusahaan, kontak PIC, jadwal bimbingan, dll. --}}
                </ul>

                <hr class="my-4">

                <div class="row text-muted small">
                    <div class="col-md-6">
                        <p class="mb-1">Dibuat pada: {{ $pkl->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-1">Terakhir diperbarui: {{ $pkl->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Tampilan jika $pkl adalah null (misal ada masalah di controller) --}}
        <div class="card shadow-sm mb-4 border-danger">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 4rem;"></i>
                </div>
                <h5 class="card-title text-muted">Terjadi kesalahan atau data PKL tidak ditemukan.</h5>
                <p class="card-text text-muted">
                    Mohon kembali ke daftar PKL dan coba lagi, atau hubungi administrator jika masalah berlanjut.
                </p>
            </div>
        </div>
    @endif
</div>
@endsection

<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .badge {
        font-size: 0.75rem;
    }
    
    .card-footer {
        border-top: 1px solid #dee2e6;
    }

    .card-footer .btn {
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .card-footer .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    .card-footer .btn-secondary,
    .card-footer .btn-info {
        cursor: not-allowed;
        opacity: 0.8;
    }
</style>