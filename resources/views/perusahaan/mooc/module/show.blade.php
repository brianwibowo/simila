@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    {{-- Breadcrumb Navigation --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('perusahaan-mooc-show', ['mooc'=>$module->mooc_id]) }}">{{ $module->mooc->judul_pelatihan }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Modul</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Modul: {{ $module->module_name }}</h1>
        <div>
            {{-- Pastikan route 'perusahaan-module-edit' sudah ada --}}
            <a href="{{ route('perusahaan-module-edit', ['mooc'=>$module->mooc_id,'module'=>$module->id]) }}" class="btn btn-warning me-2">
                <i class="bi bi-pencil"></i> Edit Modul
            </a>
            <a href="{{ route('perusahaan-mooc-show', $module->mooc_id) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Pelatihan
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            {{-- Section Materi Pembelajaran --}}
            <h5 class="card-title mb-3">Materi Pembelajaran</h5>
            <div class="p-3 bg-light rounded border mb-4">
                @if($module->link_materi)
                    <div class="mb-3">
                        <strong>Link Materi Eksternal:</strong><br>
                        <a href="{{ $module->link_materi }}" class="btn btn-outline-primary btn-sm mt-1" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-link-45deg"></i> Buka Link
                        </a>
                    </div>
                @endif

                @if($module->link_eval)
                    <div class="mb-3">
                        <strong>Link Evaluasi:</strong><br>
                        <a href="{{ $module->link_eval }}" class="btn btn-outline-primary btn-sm mt-1" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-link-45deg"></i> Buka Link
                        </a>
                    </div>
                @endif

                @if($module->dokumen_materi)
                    <div>
                        <strong>Dokumen Materi:</strong><br>
                        {{-- Link ini mengasumsikan file ada di storage/app/public dan Anda sudah run `php artisan storage:link` --}}
                        <a href="{{ asset('storage/' . $module->dokumen_materi) }}" class="btn btn-outline-success btn-sm mt-1" download>
                            <i class="bi bi-download"></i> Unduh Dokumen
                        </a>
                    </div>
                @endif

                @if(!$module->link_materi && !$module->dokumen_materi)
                    <p class="text-muted mb-0">Tidak ada materi link atau dokumen yang dilampirkan untuk modul ini.</p>
                @endif
            </div>

            <hr class="my-4">

        </div>
        <div class="card-footer text-muted small bg-white">
            <div class="d-flex justify-content-between">
                <span>Dibuat pada: {{ $module->created_at->format('d F Y, H:i') }}</span>
                <span>Terakhir diperbarui: {{ $module->updated_at->format('d F Y, H:i') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection