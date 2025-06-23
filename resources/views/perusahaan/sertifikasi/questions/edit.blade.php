@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>Edit Soal untuk Ujian: {{ $certificationExam->nama_ujian }}</h2> {{-- Nama variabel disesuaikan --}}

    <div class="card">
        <div class="card-header">Form Edit Soal</div>
        <div class="card-body">
            <form action="{{ route('perusahaan-sertifikasi-questions.update', [$certificationExam->id, $question->id]) }}" method="POST"> {{-- Nama variabel disesuaikan --}}
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="soal" class="form-label">Soal</label>
                    <textarea class="form-control @error('soal') is-invalid @enderror" id="soal" name="soal" rows="3" required>{{ old('soal', $question->soal) }}</textarea>
                    @error('soal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pilihan_jawaban_1" class="form-label">Pilihan Jawaban 1 (A)</label>
                    <input type="text" class="form-control @error('pilihan_jawaban_1') is-invalid @enderror" id="pilihan_jawaban_1" name="pilihan_jawaban_1" value="{{ old('pilihan_jawaban_1', $question->pilihan_jawaban_1) }}" required>
                    @error('pilihan_jawaban_1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pilihan_jawaban_2" class="form-label">Pilihan Jawaban 2 (B)</label>
                    <input type="text" class="form-control @error('pilihan_jawaban_2') is-invalid @enderror" id="pilihan_jawaban_2" name="pilihan_jawaban_2" value="{{ old('pilihan_jawaban_2', $question->pilihan_jawaban_2) }}" required>
                    @error('pilihan_jawaban_2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pilihan_jawaban_3" class="form-label">Pilihan Jawaban 3 (C)</label>
                    <input type="text" class="form-control @error('pilihan_jawaban_3') is-invalid @enderror" id="pilihan_jawaban_3" name="pilihan_jawaban_3" value="{{ old('pilihan_jawaban_3', $question->pilihan_jawaban_3) }}" required>
                    @error('pilihan_jawaban_3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pilihan_jawaban_4" class="form-label">Pilihan Jawaban 4 (D)</label>
                    <input type="text" class="form-control @error('pilihan_jawaban_4') is-invalid @enderror" id="pilihan_jawaban_4" name="pilihan_jawaban_4" value="{{ old('pilihan_jawaban_4', $question->pilihan_jawaban_4) }}" required>
                    @error('pilihan_jawaban_4')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                    <select class="form-control @error('jawaban_benar') is-invalid @enderror" id="jawaban_benar" name="jawaban_benar" required>
                        <option value="">Pilih Jawaban Benar</option>
                        <option value="1" {{ old('jawaban_benar', $question->jawaban_benar) == '1' ? 'selected' : '' }}>Pilihan 1 (A)</option>
                        <option value="2" {{ old('jawaban_benar', $question->jawaban_benar) == '2' ? 'selected' : '' }}>Pilihan 2 (B)</option>
                        <option value="3" {{ old('jawaban_benar', $question->jawaban_benar) == '3' ? 'selected' : '' }}>Pilihan 3 (C)</option>
                        <option value="4" {{ old('jawaban_benar', $question->jawaban_benar) == '4' ? 'selected' : '' }}>Pilihan 4 (D)</option>
                    </select>
                    @error('jawaban_benar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nilai_akhir" class="form-label">Nilai Soal Ini</label>
                    <input type="number" class="form-control @error('nilai_akhir') is-invalid @enderror" id="nilai_akhir" name="nilai_akhir" value="{{ old('nilai_akhir', $question->nilai_akhir) }}" required min="0">
                    @error('nilai_akhir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Perbarui Soal</button>
                <a href="{{ route('perusahaan-sertifikasi-show', $certificationExam->id) }}" class="btn btn-secondary">Batal</a> {{-- Nama variabel disesuaikan --}}
            </form>
        </div>
    </div>
</div>
@endsection