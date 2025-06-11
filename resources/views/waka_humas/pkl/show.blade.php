@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4">Detail Laporan PKL</h1>
        <a href="{{ route('waka-humas.pkl.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Informasi PKL</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Nama Siswa</div>
                <div class="col-md-9">{{ $pkl->siswa->name ?? '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Pembimbing</div>
                <div class="col-md-9">{{ $pkl->pembimbing->name ?? '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Perusahaan</div>
                <div class="col-md-9">{{ $pkl->perusahaan->name ?? '-' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Status Pembimbing</div>
                <div class="col-md-9">
                    <span class="badge bg-{{ $pkl->status_pembimbing == 'disetujui' ? 'success' : 'warning' }}">
                        {{ ucfirst($pkl->status_pembimbing) }}
                    </span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Status Waka Humas</div>
                <div class="col-md-9">
                    <span class="badge bg-{{ $pkl->status_waka_humas == 'disetujui' ? 'success' : ($pkl->status_waka_humas == 'ditolak' ? 'danger' : 'warning') }}">
                        {{ ucfirst($pkl->status_waka_humas) }}
                    </span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Nilai</div>
                <div class="col-md-9">{{ $pkl->nilai ?? 'Belum dinilai' }}</div>
            </div>
            @if($pkl->catatan_waka_humas)
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Catatan Waka Humas</div>
                <div class="col-md-9">{{ $pkl->catatan_waka_humas }}</div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-3 fw-bold">Laporan Akhir</div>
                <div class="col-md-9">
                    <a href="{{ route('waka-humas.pkl.download', $pkl) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-download"></i> Unduh Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if($pkl->status_waka_humas == 'proses')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Validasi Laporan PKL</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('waka-humas.pkl.validate', $pkl) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="status" class="form-label">Status Validasi</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="disetujui">Setujui</option>
                        <option value="ditolak">Tolak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan (Opsional)</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Validasi</button>
            </form>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    // Menampilkan/menyembunyikan catatan berdasarkan status yang dipilih
    document.getElementById('status').addEventListener('change', function() {
        const catatanField = document.getElementById('catatan');
        if (this.value === 'ditolak') {
            catatanField.required = true;
        } else {
            catatanField.required = false;
        }
    });
</script>
@endpush
@endsection
