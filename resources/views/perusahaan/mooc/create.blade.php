@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 h4">Tambah Pelatihan MOOC Baru</h1>

    {{-- Form untuk menambahkan MOOC baru --}}
    <form action="{{ route('perusahaan-mooc-store') }}" method="POST" enctype="multipart/form-data">
        @csrf {{-- Token CSRF untuk keamanan --}}

        <div class="mb-3">
            <label for="judul_pelatihan" class="form-label">Judul Pelatihan</label>
            <input type="text" name="judul_pelatihan" id="judul_pelatihan" class="form-control @error('judul_pelatihan') is-invalid @enderror" value="{{ old('judul_pelatihan') }}" required>
            @error('judul_pelatihan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Pelatihan</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link_materi" class="form-label">Link Materi (Opsional)</label>
            <input type="url" name="link_materi" id="link_materi" class="form-control @error('link_materi') is-invalid @enderror" value="{{ old('link_materi') }}" placeholder="Contoh: https://youtube.com/link-video">
            @error('link_materi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="dokumen_materi" class="form-label">Dokumen Materi (PDF)</label>
            <input type="file" name="dokumen_materi" id="dokumen_materi" class="form-control @error('dokumen_materi') is-invalid @enderror" required>
            <div class="form-text">Maksimal ukuran file: 2MB</div>
            @error('dokumen_materi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-primary">Simpan Pelatihan</button>
            <a href="{{ route('perusahaan-mooc-index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection