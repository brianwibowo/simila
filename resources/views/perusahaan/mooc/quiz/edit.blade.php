@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        {{-- Judul disesuaikan untuk edit --}}
                        <h5 class="mb-0">Edit Soal Evaluasi</h5>
                        {{-- Link kembali tetap sama, ke detail MOOC --}}
                        <a href="{{ route('perusahaan-mooc-show', $mooc->id) }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Action menunjuk ke route update, dengan menyertakan ID kuis --}}
                    {{-- Asumsi nama route: perusahaan-quiz-update --}}
                    <form action="{{ route('perusahaan-quiz-update', ['quiz' => $quiz->id]) }}" method="POST">
                        @csrf
                        {{-- Method spoofing untuk memberitahu Laravel ini adalah request PUT --}}
                        @method('PUT')

                        {{-- Soal: Menggunakan old() dengan parameter kedua sebagai default value --}}
                        <div class="mb-3">
                            <label for="soal" class="form-label">Soal</label>
                            <textarea class="form-control @error('soal') is-invalid @enderror" id="soal" name="soal" rows="4" required>{{ old('soal', $quiz->soal) }}</textarea>
                            @error('soal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- Pilihan Jawaban 1 --}}
                        <div class="mb-3">
                            <label for="pilihan_jawaban_1" class="form-label">Pilihan Jawaban 1</label>
                            <input type="text" class="form-control @error('pilihan_jawaban_1') is-invalid @enderror" id="pilihan_jawaban_1" name="pilihan_jawaban_1" value="{{ old('pilihan_jawaban_1', $quiz->pilihan_jawaban_1) }}" required>
                            @error('pilihan_jawaban_1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilihan Jawaban 2 --}}
                        <div class="mb-3">
                            <label for="pilihan_jawaban_2" class="form-label">Pilihan Jawaban 2</label>
                            <input type="text" class="form-control @error('pilihan_jawaban_2') is-invalid @enderror" id="pilihan_jawaban_2" name="pilihan_jawaban_2" value="{{ old('pilihan_jawaban_2', $quiz->pilihan_jawaban_2) }}" required>
                            @error('pilihan_jawaban_2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilihan Jawaban 3 --}}
                        <div class="mb-3">
                            <label for="pilihan_jawaban_3" class="form-label">Pilihan Jawaban 3</label>
                            <input type="text" class="form-control @error('pilihan_jawaban_3') is-invalid @enderror" id="pilihan_jawaban_3" name="pilihan_jawaban_3" value="{{ old('pilihan_jawaban_3', $quiz->pilihan_jawaban_3) }}" required>
                            @error('pilihan_jawaban_3')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilihan Jawaban 4 --}}
                        <div class="mb-3">
                            <label for="pilihan_jawaban_4" class="form-label">Pilihan Jawaban 4</label>
                            <input type="text" class="form-control @error('pilihan_jawaban_4') is-invalid @enderror" id="pilihan_jawaban_4" name="pilihan_jawaban_4" value="{{ old('pilihan_jawaban_4', $quiz->pilihan_jawaban_4) }}" required>
                            @error('pilihan_jawaban_4')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-4">

                    {{-- Jawaban Benar: Memeriksa mana yang harus 'checked' --}}
                    <div class="mb-3">
                        <label class="form-label">Pilih Jawaban yang Benar</label>
                        @error('jawaban_benar')
                            {{-- Tampilkan error di atas agar lebih terlihat --}}
                            <div class="alert alert-danger py-2 small">{{ $message }}</div>
                        @enderror

                        {{-- 1. Perbaikan pada 'value' dan 'checked' --}}
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_benar" id="radio_jawaban_1" 
                                value="pilihan_jawaban_1" {{ old('jawaban_benar', $quiz->jawaban_benar) == 'pilihan_jawaban_1' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="radio_jawaban_1">
                                Pilihan Jawaban 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_benar" id="radio_jawaban_2" 
                                value="pilihan_jawaban_2" {{ old('jawaban_benar', $quiz->jawaban_benar) == 'pilihan_jawaban_2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="radio_jawaban_2">
                                Pilihan Jawaban 2
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_benar" id="radio_jawaban_3" 
                                value="pilihan_jawaban_3" {{ old('jawaban_benar', $quiz->jawaban_benar) == 'pilihan_jawaban_3' ? 'checked' : '' }}>
                            <label class="form-check-label" for="radio_jawaban_3">
                                Pilihan Jawaban 3
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jawaban_benar" id="radio_jawaban_4" 
                                value="pilihan_jawaban_4" {{ old('jawaban_benar', $quiz->jawaban_benar) == 'pilihan_jawaban_4' ? 'checked' : '' }}>
                            <label class="form-check-label" for="radio_jawaban_4">
                                Pilihan Jawaban 4
                            </label>
                        </div>

                        {{-- 2. Perbaikan untuk menampilkan teks jawaban yang benar --}}
                        @php
                            // Ambil kunci jawaban yang benar (contoh: 'pilihan_jawaban_2')
                            $kunciJawabanBenar = old('jawaban_benar', $quiz->jawaban_benar);

                            // Ambil teks jawaban dari model quiz menggunakan kunci tersebut
                            // old($kunciJawabanBenar, $quiz[$kunciJawabanBenar]) digunakan agar jika user mengedit teks jawaban dan validasi gagal, teks yang baru akan ditampilkan.
                            $teksJawabanBenar = old($kunciJawabanBenar, $quiz[$kunciJawabanBenar]);
                        @endphp

                        <p class="mt-3 form-text">Jawaban Benar saat ini: <strong class="text-success">{{ $teksJawabanBenar }}</strong></p>
                    </div>

                        {{-- Tombol Submit disesuaikan --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection