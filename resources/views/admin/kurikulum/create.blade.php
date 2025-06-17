@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 h4">Ajukan Kurikulum</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin-kurikulum-store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kurikulum</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun Ajaran</label>
            <input type="text" name="tahun" id="tahun" class="form-control" value="{{ old('tahun') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="file" class="form-label">File Kurikulum (PDF)</label>
            <input type="file" name="file" id="file" class="form-control" required>
            <small class="text-muted">File harus dalam format PDF</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajukan Kurikulum</button>
        <a href="{{ route('admin-kurikulum-list-diajukan') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
