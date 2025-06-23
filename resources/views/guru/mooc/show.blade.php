{{-- Menggunakan layout utama aplikasi Anda, sesuaikan jika perlu --}}
@extends('layouts.layout') 

@section('styles')
{{-- Menambahkan library ikon untuk mempercantik tampilan --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    .accordion-button:not(.collapsed) {
        background-color: #e7f1ff;
        color: #0d6efd;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
    .video-responsive {
        overflow: hidden; padding-bottom: 56.25%; position: relative;
        height: 0; border-radius: 0.5rem; background-color: #f0f0f0;
    }
    .video-responsive iframe {
        left: 0; top: 0; height: 100%; width: 100%; position: absolute;
    }
    .mini-quiz-container.is-correct .card-body {
        background-color: #d1e7dd;
        border-left: 5px solid #0f5132;
    }
    .mini-quiz-container.is-incorrect .card-body {
        background-color: #f8d7da;
        border-left: 5px solid #842029;
    }
    .correct-answer-label {
        font-weight: bold;
        color: #0f5132;
    }
    .correct-answer-label::after {
        content: ' (Jawaban Benar)';
        font-style: italic;
        font-size: 0.9em;
    }
    /* Style untuk Ikon Centang di Judul Modul */
    .module-status-icon {
        color: #198754; /* Warna hijau success Bootstrap */
        font-size: 1.1rem;
        transition: all 0.3s ease-in-out;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h1 class="display-6 fw-bold">{{ $mooc->judul_pelatihan }}</h1>
        <p class="text-muted fs-5">{{ $mooc->deskripsi }}</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <h3 class="mb-3">Materi Pembelajaran</h3>
            <div class="accordion" id="moduleAccordion">
                @forelse ($modules as $index => $module)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $module->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $module->id }}" aria-expanded="false" aria-controls="collapse{{ $module->id }}">
                                {{-- IKON CENTANG DITAMBAHKAN DI SINI --}}
                                <span class="module-status-icon d-none me-2">
                                    <i class="bi bi-check-circle-fill"></i>
                                </span>
                                <span class="fw-bold">Modul {{ $index + 1 }}: {{ $module->module_name }}</span>
                            </button>
                        </h2>
                        <div id="collapse{{ $module->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $module->id }}" data-bs-parent="#moduleAccordion">
                            <div class="accordion-body">
                                
                                @if ($module->link_materi)
                                    <h5 class="mb-2">Video Materi</h5>
                                    <div class="video-responsive mb-3 d-flex flex-column gap-2">
                                        <iframe src="{{ $module->link_materi }}" title="Materi Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <a href="{{ $module->link_materi }}" target="_blank">Buka video di tab baru</a>
                                    </div>
                                @endif

                                @if ($module->dokumen_materi)
                                    <h5 class="mt-4 mb-2">Dokumen Pendukung</h5>
                                    <a href="{{ asset('storage/' . $module->dokumen_materi) }}" target="_blank" class="btn btn-outline-primary mb-4">
                                        <i class="bi bi-download me-2"></i>Unduh Dokumen Materi
                                    </a>
                                @endif

                                <hr>

                                <div class="mt-4">
                                    <h5 class="mb-3">Pengecekan Pemahaman</h5>
                                    <div class="card bg-light border-0 mini-quiz-container">
                                        <div class="card-body" style="transition: all 0.3s ease-in-out;">
                                            <p class="fw-bold">{{ $module->question }}</p>
                                            <form class="quiz-form" data-correct-answer="{{ $module->answer }}">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" value="1" name="answer_{{ $module->id }}" id="q{{ $module->id }}_1">
                                                    <label class="form-check-label" for="q{{ $module->id }}_1">{{ $module->pilihan_jawaban_1 }}</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" value="2" name="answer_{{ $module->id }}" id="q{{ $module->id }}_2">
                                                    <label class="form-check-label" for="q{{ $module->id }}_2">{{ $module->pilihan_jawaban_2 }}</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" value="3" name="answer_{{ $module->id }}" id="q{{ $module->id }}_3">
                                                    <label class="form-check-label" for="q{{ $module->id }}_3">{{ $module->pilihan_jawaban_3 }}</label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" value="4" name="answer_{{ $module->id }}" id="q{{ $module->id }}_4">
                                                    <label class="form-check-label" for="q{{ $module->id }}_4">{{ $module->pilihan_jawaban_4 }}</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm">Kirim Jawaban</button>
                                                <div class="quiz-feedback mt-3">
                                                    <div class="alert alert-success d-none fw-bold" role="alert"><i class="bi bi-check-circle-fill me-2"></i>Benar! Jawaban Anda tepat.</div>
                                                    <div class="alert alert-danger d-none fw-bold" role="alert"><i class="bi bi-x-circle-fill me-2"></i>Salah! Silakan coba lagi.</div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">Belum ada modul yang ditambahkan untuk pelatihan ini.</div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-body">
                    @if ($nilai !== null)
                        <h4 class="card-title mb-3">Nilai Anda</h4>
                        <p class="lead fw-bold">{{ $nilai->score }} <span class="text-muted">/ 100</span></p>
                    @endif
                    <h4 class="card-title mb-3">Informasi Pelatihan</h4>
                    <p class="mb-1"><strong class="d-block text-muted">Penyelenggara:</strong> {{ $mooc->user->name ?? 'Tidak diketahui' }}</p>
                    <hr>
                    <h5 class="mt-3">Progress Anda</h5>
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                    <div class="mt-4 pt-2">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <h5 class="card-title">Evaluasi Akhir</h5>
                                <p class="card-text">Selesaikan pelatihan ini dengan mengerjakan kuis akhir.</p>
                                <a href="{{ route('guru-mooc-eval', $mooc->id) }}" class="btn btn-primary w-100 fw-bold">
                                    <i class="bi bi-pencil-square me-2"></i>Mulai Kuis Akhir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const moduleQuizForms = document.querySelectorAll('.quiz-form');

    moduleQuizForms.forEach(form => {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.addEventListener('click', function(event) {
            event.preventDefault();

            const container = form.closest('.mini-quiz-container');
            const selectedRadio = form.querySelector('input[type="radio"]:checked');
            const successAlert = form.querySelector('.alert-success');
            const errorAlert = form.querySelector('.alert-danger');
            
            successAlert.classList.add('d-none');
            errorAlert.classList.add('d-none');
            container.classList.remove('is-correct', 'is-incorrect');
            form.querySelectorAll('.form-check-label').forEach(label => label.classList.remove('correct-answer-label'));

            if (!selectedRadio) {
                alert('Silakan pilih salah satu jawaban terlebih dahulu.');
                return;
            }

            const userAnswer = selectedRadio.value;
            const correctAnswer = form.dataset.correctAnswer;

            if (userAnswer === correctAnswer) {
                // Jawaban Benar
                container.classList.add('is-correct');
                successAlert.classList.remove('d-none');
                form.querySelectorAll('input[type="radio"]').forEach(radio => radio.disabled = true);
                submitButton.disabled = true;
                submitButton.innerHTML = 'Benar';

                // Tampilkan ikon centang di header modul
                const accordionItem = form.closest('.accordion-item');
                if (accordionItem) {
                    const statusIcon = accordionItem.querySelector('.module-status-icon');
                    if (statusIcon) {
                        statusIcon.classList.remove('d-none');
                    }
                }

            } else {
                // Jawaban Salah
                container.classList.add('is-incorrect');
                errorAlert.classList.remove('d-none');
                const correctRadio = form.querySelector(`input[value="${correctAnswer}"]`);
                if (correctRadio) {
                    correctRadio.nextElementSibling.classList.add('correct-answer-label');
                }
            }
        });
    });
});
</script>
@endsection