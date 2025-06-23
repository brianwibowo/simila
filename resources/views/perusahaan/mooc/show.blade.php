@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    {{-- Existing Training Detail Section --}}
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

    {{-- Module List Section --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Modul</h5>
                {{-- Make sure you have a route named 'perusahaan-module-create' --}}
                <a href="{{ route('perusahaan-module-create', $mooc->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Modul Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($modules && $modules->count() > 0)
                <div class="list-group">
                    @foreach($modules as $module)
                        <a href="{{ route('perusahaan-module-show', ['mooc' => $mooc->id, 'module' => $module->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">{{ $module->module_name }}</h6>
                            </div>
                            <form action="{{ route('perusahaan-module-destroy', ['module' => $module->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center p-4">
                    <p class="text-muted">Belum ada modul untuk pelatihan ini.</p>
                    <p>Silakan tambahkan modul baru untuk memulai.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- New Final Evaluation Section --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Evaluasi Akhir</h5>
                {{-- Make sure you have a route named 'perusahaan-quiz-create' for the final evaluation --}}
                <a href="{{ route('perusahaan-quiz-create', $mooc->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Soal Baru
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($quizzes && $quizzes->count() > 0)
                <div class="list-group">
                    @foreach($quizzes as $quiz)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $quiz->soal }}</h6>
                                <div>
                                    {{-- Make sure you have a route named 'perusahaan-quiz-edit' --}}
                                    <a href="{{ route('perusahaan-quiz-edit', ['mooc' => $mooc->id, 'quiz' => $quiz->id]) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    {{-- Make sure you have a route named 'perusahaan-quiz-destroy' --}}
                                    <form action="{{ route('perusahaan-quiz-destroy', ['quiz' => $quiz->id]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center p-4">
                    <p class="text-muted">Belum ada soal evaluasi akhir untuk pelatihan ini.</p>
                    <p>Silakan tambahkan soal baru untuk memulai evaluasi.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection