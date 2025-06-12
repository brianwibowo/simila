@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 h4">Ajukan Guru Tamu</h1>

    <form action="{{ route('perusahaan-guru-tamu-store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="keahlian" class="form-label">Keahlian</label>
            <input type="text" name="keahlian" id="keahlian" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="jadwal" class="form-label">Jadwal</label>
            <input type="date" name="jadwal" id="jadwal" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="file_cv" class="form-label">File CV (opsional) </label>
            <input type="file" name="file_cv" id="file_cv" class="form-control">
        </div>

        <div class="mb-4">
            <label for="file_materi" class="form-label">File Materi (pdf) </label>
            <input type="file" name="file_materi" id="file_materi" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>
</div>
@endsection
