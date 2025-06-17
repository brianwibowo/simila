@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 h4">Edit Kurikulum</h1>

    <form action="{{ route('perusahaan-kurikulum-update', $kurikulum->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kurikulum</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $kurikulum->nama_kurikulum) }}" required>
        </div>
    
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun Ajaran</label>
            <input type="text" name="tahun" id="tahun" class="form-control" value="{{ old('tahun', $kurikulum->tahun_ajaran) }}" required>
        </div>
    
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi', $kurikulum->deskripsi) }}</textarea>
        </div>        <div class="mb-4">
            <label for="file" class="form-label">Ganti File Kurikulum (Opsional)</label>
            <input type="file" name="file" id="file" class="form-control">
            <small class="text-muted">File sebelumnya: {{ $kurikulum->file_kurikulum }}</small>
        </div>

        <div class="alert alert-warning mb-4">
            <p class="mb-0"><i class="fas fa-exclamation-triangle"></i> <strong>Perhatian:</strong> Mengedit kurikulum akan me-reset status validasi menjadi "Menunggu Validasi" dan Admin Sekolah harus memvalidasi ulang.</p>
        </div>
    
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('perusahaan-kurikulum-list-diajukan') }}" class="btn btn-secondary">Batal</a>
    </form>
    
</div>
@endsection
