@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Soal Evaluasi Baru</h5>
                        {{-- Asumsi route detail mooc adalah 'perusahaan-mooc-show' --}}
                        <a href="{{ route('perusahaan-mooc-show', $mooc->id) }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Asumsi route untuk menyimpan adalah 'perusahaan-quiz-store' --}}
                    <form action="{{ route('perusahaan-quiz-store', $mooc->id) }}" method="POST">
                        @csrf
                        {{-- Input tersembunyi untuk mooc_id --}}
                        <input type="hidden" name="mooc_id" value="{{ $mooc->id }}">

                        {{-- Soal --}}
                        <div class="mb-3">
                            <label for="soal" class="form-label">Soal</label>
                            <textarea class="form-control @error('soal') is-invalid @enderror" id="soal" name="soal" rows="4" required>{{ old('soal') }}</textarea>
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
                            <input type="text" class="form-control @error('pilihan_jawaban_1') is-invalid @enderror" id="pilihan_jawaban_1" name="pilihan_jawaban_1" value="{{ old('pilihan_jawaban_1') }}" required>
                            @error('pilihan_jawaban_1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilihan Jawaban 2 --}}
                        <div class="mb-3">
                            <label for="pilihan_jawaban_2" class="form-label">Pilihan Jawaban 2</label>
                            <input type="text" class="form-control @error('pilihan_jawaban_2') is-invalid @enderror" id="pilihan_jawaban_2" name="pilihan_jawaban_2" value="{{ old('pilihan_jawaban_2') }}" required>
                            @error('pilihan_jawaban_2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilihan Jawaban 3 --}}
                        <div class="mb-3">
                            <label for="pilihan_jawaban_3" class="form-label">Pilihan Jawaban 3</label>
                            <input type="text" class="form-control @error('pilihan_jawaban_3') is-invalid @enderror" id="pilihan_jawaban_3" name="pilihan_jawaban_3" value="{{ old('pilihan_jawaban_3') }}" required>
                            @error('pilihan_jawaban_3')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilihan Jawaban 4 --}}
                        <div class="mb-3">
                            <label for="pilihan_jawaban_4" class="form-label">Pilihan Jawaban 4</label>
                            <input type="text" class="form-control @error('pilihan_jawaban_4') is-invalid @enderror" id="pilihan_jawaban_4" name="pilihan_jawaban_4" value="{{ old('pilihan_jawaban_4') }}" required>
                            @error('pilihan_jawaban_4')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- Jawaban Benar --}}
                        <div class="mb-3">
                            <label class="form-label">Pilih Jawaban yang Benar</label>
                            <div class="form-check">
                                <input class="form-check-input @error('jawaban_benar') is-invalid @enderror" type="radio" name="jawaban_benar" id="radio_jawaban_1" value="pilihan_jawaban_1" {{ old('jawaban_benar') == 'pilihan_jawaban_1' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="radio_jawaban_1">
                                    Pilihan Jawaban 1
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('jawaban_benar') is-invalid @enderror" type="radio" name="jawaban_benar" id="radio_jawaban_2" value="pilihan_jawaban_2" {{ old('jawaban_benar') == 'pilihan_jawaban_2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="radio_jawaban_2">
                                    Pilihan Jawaban 2
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('jawaban_benar') is-invalid @enderror" type="radio" name="jawaban_benar" id="radio_jawaban_3" value="pilihan_jawaban_3" {{ old('jawaban_benar') == 'pilihan_jawaban_3' ? 'checked' : '' }}>
                                <label class="form-check-label" for="radio_jawaban_3">
                                    Pilihan Jawaban 3
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('jawaban_benar') is-invalid @enderror" type="radio" name="jawaban_benar" id="radio_jawaban_4" value="pilihan_jawaban_4" {{ old('jawaban_benar') == 'pilihan_jawaban_4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="radio_jawaban_4">
                                    Pilihan Jawaban 4
                                </label>
                            </div>
                            @error('jawaban_benar')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Soal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection