@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-paper-plane text-primary me-2"></i> Pendaftaran Talent Scouting
            </h1>
            <p class="text-muted mb-0">Batch: <strong>{{ $scouting->batch }}</strong></p>
        </div>
        <a href="{{ route('siswa-scouting-index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="card-title fw-bold text-dark mb-0">Formulir Pengajuan Berkas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa-scouting-apply', $scouting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap Siswa</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="cv" class="form-label fw-bold">Curriculum Vitae (CV) & Portofolio <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" required>
                            <small class="form-text text-muted">Format: PDF (Maksimal 2MB).</small>
                        </div>

                        <div class="mb-3">
                            <label for="ijazah" class="form-label fw-bold">Ijazah / Rapor Terakhir / Sertifikat</label>
                            <input type="file" class="form-control" id="ijazah" name="ijazah" accept=".pdf">
                            <small class="form-text text-muted">Format: PDF (Maksimal 2MB).</small>
                        </div>

                        <div class="mb-4">
                            <label for="pernyataan" class="form-label fw-bold">Surat Pernyataan Komitmen / Motivasi <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="pernyataan" name="pernyataan" accept=".pdf" required>
                            <small class="form-text text-muted">Format: PDF (Maksimal 2MB).</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('siswa-scouting-index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i> Kirim Lamaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
