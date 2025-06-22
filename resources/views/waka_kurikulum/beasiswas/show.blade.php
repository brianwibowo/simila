@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tinjau Pengajuan Beasiswa: {{ $beasiswa->nama_siswa }}</h3>

    @if ($beasiswa->direkomendasikan)
        <div class="alert alert-success">
            Anda telah merekomendasikan siswa ini pada
            {{ $beasiswa->tanggal_rekomendasi ? \Carbon\Carbon::parse($beasiswa->tanggal_rekomendasi)->translatedFormat('d F Y H:i') : '-' }}
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <strong>Dokumen Pengajuan</strong>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between">
                    Rapor
                    <a href="{{ Storage::url($beasiswa->raport) }}" class="btn btn-sm btn-outline-primary" target="_blank">Lihat</a>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    Surat Rekomendasi
                    <a href="{{ Storage::url($beasiswa->surat_rekomendasi) }}" class="btn btn-sm btn-outline-primary" target="_blank">Lihat</a>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    Surat Motivasi
                    <a href="{{ Storage::url($beasiswa->surat_motivasi) }}" class="btn btn-sm btn-outline-primary" target="_blank">Lihat</a>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    Portofolio
                    <a href="{{ Storage::url($beasiswa->portofolio) }}" class="btn btn-sm btn-outline-primary" target="_blank">Lihat</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Rekomendasi Waka Kurikulum</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('waka-rekomendasi-submit', $beasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Catatan</label>
                    <textarea name="catatan" rows="4" class="form-control" placeholder="Tulis catatan atau alasan rekomendasi...">{{ old('catatan', $beasiswa->catatan) }}</textarea>
                </div>

                <div class="form-check mb-3">
                    <input type="hidden" name="direkomendasikan" value="0">
                    <input type="checkbox" name="direkomendasikan" value="1" class="form-check-input" id="rekomCheckbox"
                        {{ old('direkomendasikan', $beasiswa->direkomendasikan) ? 'checked' : '' }}>
                    <label class="form-check-label" for="rekomCheckbox">
                        Saya merekomendasikan siswa ini kepada pihak perusahaan
                    </label>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('waka-rekomendasi-index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Rekomendasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
