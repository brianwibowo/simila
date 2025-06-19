@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Detail Pelatihan MOOC: {{ $mooc->judul_pelatihan }}</h1>
        <div>
            <a href="{{ route('perusahaan-mooc-edit', $mooc->id) }}" class="btn btn-warning me-2">
                <i class="bi bi-pencil"></i> Edit Pelatihan
            </a>
            <a href="{{ route('perusahaan-mooc-index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h5>Judul Pelatihan</h5>
                    <p class="text-muted">{{ $mooc->judul_pelatihan }}</p>
                </div>
                <div class="col-md-12 mb-3">
                    <h5>Deskripsi Pelatihan</h5>
                    <div class="p-3 bg-light rounded border">
                        <p class="mb-0">{{ $mooc->deskripsi }}</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <h5>Link Materi</h5>
                    @if($mooc->link_materi)
                        <p><a href="{{ $mooc->link_materi }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-box-arrow-up-right"></i> Buka Link Materi
                        </a></p>
                        <small class="text-muted">{{ $mooc->link_materi }}</small>
                    @else
                        <p class="text-muted">Tidak ada link materi.</p>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <h5>Dokumen Materi</h5>
                    @if($mooc->dokumen_materi)
                        <p><a href="{{ asset('storage/'.$mooc->dokumen_materi)}}" target="_blank" class="btn btn-info btn-sm">
                            <i class="bi bi-download"></i> Download Dokumen
                        </a></p>
                        <small class="text-muted">{{ basename($mooc->dokumen_materi) }}</small>
                    @else
                        <p class="text-muted">Tidak ada dokumen materi.</p>
                    @endif
                </div>
            </div>

            <hr class="my-4">

            <div class="row text-muted small">
                <div class="col-md-6">
                    <p class="mb-1">Dibuat pada: {{ $mooc->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-1">Terakhir diperbarui: {{ $mooc->updated_at->format('d F Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection