@extends('layouts.layout')

@section('content')
<style>
    .video-responsive {
        overflow: hidden; padding-bottom: 56.25%; position: relative;
        height: 0; border-radius: 0.5rem; background-color: #000;
    }
    .video-responsive iframe {
        left: 0; top: 0; height: 100%; width: 100%; position: absolute;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-graduation-cap text-danger me-2"></i> {{ $mooc->judul_pelatihan }}
            </h1>
            <p class="text-muted mb-0">{{ $mooc->deskripsi }}</p>
        </div>
        <a href="{{ route('siswa-mooc-index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <h4 class="fw-bold mb-3"><i class="fas fa-play-circle text-danger me-2"></i> Materi Pembelajaran</h4>

            <div class="accordion mb-4" id="moduleAccordion">
                @forelse ($modules as $index => $module)
                    <div class="accordion-item shadow-sm border-0 mb-3 rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="heading{{ $module->id }}">
                            <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} bg-white fw-bold text-dark py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $module->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                <span class="badge bg-danger text-white me-2">Modul {{ $index + 1 }}</span>
                                {{ $module->module_name }}
                            </button>
                        </h2>
                        <div id="collapse{{ $module->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#moduleAccordion">
                            <div class="accordion-body bg-light">
                                @if ($module->link_materi)
                                    <div class="mb-3">
                                        <h6 class="fw-bold text-secondary mb-2"><i class="fas fa-video me-1"></i> Video Pembelajaran:</h6>
                                        <div class="video-responsive mb-2">
                                            <iframe src="{{ $module->link_materi }}" title="Materi Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                        <a href="{{ $module->link_materi }}" target="_blank" class="small text-primary">
                                            <i class="fas fa-external-link-alt me-1"></i> Buka video di tab baru
                                        </a>
                                    </div>
                                @endif

                                @if ($module->dokumen_materi)
                                    <div class="mt-3 p-3 bg-white rounded border d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger fa-2x me-3"></i>
                                            <div>
                                                <div class="fw-bold text-dark">Bahan Bacaan Modul</div>
                                                <small class="text-muted">Unduh file referensi modul ini</small>
                                            </div>
                                        </div>
                                        <a href="{{ asset('storage/' . $module->dokumen_materi) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">Belum ada modul yang ditambahkan untuk pelatihan ini.</div>
                @endforelse
            </div>

            {{-- Form Refleksi Belajar --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="card-title fw-bold text-dark mb-0">
                        <i class="fas fa-pen-alt text-primary me-2"></i> Refleksi & Catatan Belajar Siswa
                    </h5>
                </div>
                <div class="card-body">
                    @if($reflections->isNotEmpty())
                        <div class="alert alert-success border-0 mb-3">
                            <h6 class="fw-bold mb-1"><i class="fas fa-check-circle me-1"></i> Refleksi Terakhir Anda:</h6>
                            <p class="mb-0 small">{{ $reflections->last()->reflection }}</p>
                        </div>
                    @endif

                    <form action="{{ route('siswa-mooc-reflection', $mooc->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="reflectionText" class="form-label small text-muted">Tuliskan pemahaman, rangkuman, atau insight yang Anda dapatkan:</label>
                            <textarea class="form-control" id="reflectionText" name="reflection_text" rows="4" placeholder="Tuliskan refleksi pembelajaran Anda di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-paper-plane me-1"></i> Kirim Refleksi Belajar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="card-title fw-bold text-dark mb-0">Informasi Pelatihan</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Penyedia Modul:</span>
                            <span class="fw-bold text-dark">{{ $mooc->user->nama_perusahaan ?? $mooc->user->name ?? 'Mitra Industri' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Jumlah Materi:</span>
                            <span class="fw-bold text-dark">{{ $modules->count() }} Modul</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Status Evaluasi:</span>
                            <span>
                                @if($nilai)
                                    <span class="badge bg-success">Skor: {{ round($nilai->score) }}</span>
                                @else
                                    <span class="badge bg-secondary">Belum Tes</span>
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
