@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>Buat Ujian Sertifikasi Baru</h2>

    <div class="card">
        <div class="card-header">Form Ujian</div>
        <div class="card-body">
            <form action="{{ route('perusahaan-sertifikasi-store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_ujian" class="form-label">Nama Ujian</label>
                    <input type="text" class="form-control @error('nama_ujian') is-invalid @enderror" id="nama_ujian" name="nama_ujian" value="{{ old('nama_ujian') }}" required>
                    @error('nama_ujian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kompetensi_terkait" class="form-label">Kompetensi Terkait (Opsional)</label>
                    <input type="text" class="form-control @error('kompetensi_terkait') is-invalid @enderror" id="kompetensi_terkait" name="kompetensi_terkait" value="{{ old('kompetensi_terkait') }}">
                    @error('kompetensi_terkait')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="durasi_menit" class="form-label">Durasi Ujian (Menit, Opsional)</label>
                    <input type="number" class="form-control @error('durasi_menit') is-invalid @enderror" id="durasi_menit" name="durasi_menit" value="{{ old('durasi_menit') }}">
                    @error('durasi_menit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nilai_minimum_lulus" class="form-label">Nilai Minimum Lulus</label>
                    <input type="number" class="form-control @error('nilai_minimum_lulus') is-invalid @enderror" id="nilai_minimum_lulus" name="nilai_minimum_lulus" value="{{ old('nilai_minimum_lulus') }}" required>
                    @error('nilai_minimum_lulus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan Ujian</button>
                <a href="{{ route('perusahaan-sertifikasi-index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection