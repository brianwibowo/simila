@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h1 class="h4 mb-0">Tambah Modul Baru untuk: {{ $mooc->judul_pelatihan }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('perusahaan-module-store', $mooc->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="mooc_id" value="{{ $mooc->id }}">

                <h5 class="mb-3">Detail Modul</h5>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="module_name" class="form-label">Nama Modul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('module_name') is-invalid @enderror" id="module_name" name="module_name" value="{{ old('module_name') }}" required>
                        @error('module_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="link_materi" class="form-label">Link Materi (Opsional)</label>
                        <input type="url" class="form-control @error('link_materi') is-invalid @enderror" id="link_materi" name="link_materi" value="{{ old('link_materi') }}" placeholder="https://contoh.com/materi">
                        @error('link_materi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="dokumen_materi" class="form-label">Unggah Dokumen Materi (Opsional)</label>
                        <input type="file" class="form-control @error('dokumen_materi') is-invalid @enderror" id="dokumen_materi" name="dokumen_materi">
                        <div class="form-text">Tipe file yang diizinkan: PDF, DOC, DOCX, PPT. Max: 5MB.</div>
                        @error('dokumen_materi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                {{-- Bagian Kuis --}}
                <h5 class="mb-3">Kuis Modul</h5>
                <div class="mb-3">
                    <label for="question" class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('question') is-invalid @enderror" id="question" name="question" rows="3" required>{{ old('question') }}</textarea>
                    @error('question')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pilihan Jawaban --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pilihan_jawaban_1" class="form-label">Pilihan Jawaban A <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('pilihan_jawaban_1') is-invalid @enderror" id="pilihan_jawaban_1" name="pilihan_jawaban_1" value="{{ old('pilihan_jawaban_1') }}" required>
                        @error('pilihan_jawaban_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pilihan_jawaban_2" class="form-label">Pilihan Jawaban B <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('pilihan_jawaban_2') is-invalid @enderror" id="pilihan_jawaban_2" name="pilihan_jawaban_2" value="{{ old('pilihan_jawaban_2') }}" required>
                        @error('pilihan_jawaban_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pilihan_jawaban_3" class="form-label">Pilihan Jawaban C <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('pilihan_jawaban_3') is-invalid @enderror" id="pilihan_jawaban_3" name="pilihan_jawaban_3" value="{{ old('pilihan_jawaban_3') }}" required>
                        @error('pilihan_jawaban_3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pilihan_jawaban_4" class="form-label">Pilihan Jawaban D <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('pilihan_jawaban_4') is-invalid @enderror" id="pilihan_jawaban_4" name="pilihan_jawaban_4" value="{{ old('pilihan_jawaban_4') }}" required>
                        @error('pilihan_jawaban_4')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kunci Jawaban Benar --}}
                <div class="mb-4">
                    <label class="form-label">Kunci Jawaban Benar <span class="text-danger">*</span></label>
                    <div class="p-3 bg-light rounded border @error('answer') border-danger @enderror">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" id="answer_1" value="1" {{ old('answer') == '1' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="answer_1">Pilihan A</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" id="answer_2" value="2" {{ old('answer') == '2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="answer_2">Pilihan B</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" id="answer_3" value="3" {{ old('answer') == '3' ? 'checked' : '' }}>
                            <label class="form-check-label" for="answer_3">Pilihan C</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" id="answer_4" value="4" {{ old('answer') == '4' ? 'checked' : '' }}>
                            <label class="form-check-label" for="answer_4">Pilihan D</label>
                        </div>
                    </div>
                     @error('answer')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <hr>
                <input type="hidden" name="mooc_id" value="{{ $mooc->id }}">

                <div class="d-flex justify-content-end">
                    <a href="{{ route('perusahaan-mooc-show', $mooc->id) }}" class="btn btn-secondary me-2">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Modul
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection