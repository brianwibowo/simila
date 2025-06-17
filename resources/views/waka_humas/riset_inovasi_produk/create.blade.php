@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 h4">Ajukan Riset/Inovasi Produk</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('waka-humas-riset-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="topik" class="form-label">Topik Riset</label>
            <input type="text" name="topik" id="topik" class="form-control" value="{{ old('topik') }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required>{{ old('deskripsi') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="tim_riset" class="form-label">Anggota Tim</label>
            <select name="tim_riset[]" id="tim_riset" class="form-select" multiple required>Add commentMore actions
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ in_array($user->id, old('tim_riset', [])) ? 'selected' : '' }}>{{ $user->name }} ({{ $user->role }})</option>
                @endforeach
            </select>
            <small class="text-muted">Gunakan Ctrl+Klik (Windows) atau Cmd+Klik (Mac) untuk memilih lebih dari satu anggota</small>
        </div>
        <div class="mb-3">
            <label for="file_proposal" class="form-label">File Proposal (PDF, maks. 10MB)</label>
            <input type="file" name="file_proposal" id="file_proposal" class="form-control" accept=".pdf" required>
        </div>
        <div class="mb-3">
            <label for="dokumentasi" class="form-label">Dokumentasi (Gambar, maks. 2MB)</label>
            <input type="file" name="dokumentasi" id="dokumentasi" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan</button>
        <a href="{{ route('waka-humas-riset-index') }}" class="btn btn-secondary ms-2">Kembali</a>
    </form>
</div>
@endpush
@endsection