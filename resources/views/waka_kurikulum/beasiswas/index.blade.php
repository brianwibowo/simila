@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4">Daftar Pengajuan Beasiswa dari Siswa</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Nama Batch</th>
                            <th>Perusahaan</th>
                            <th>Status Rekomendasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftar as $index => $beasiswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $beasiswa->nama_siswa }}</td>
                                <td>{{ $beasiswa->batch->batch }}</td>
                                <td>{{ optional($beasiswa->batch->perusahaan)->nama_perusahaan ?? '-' }}</td>
                                <td>
                                    @if ($beasiswa->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif ($beasiswa->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif ($beasiswa->direkomendasikan)
                                        <span class="badge bg-primary">Direkomendasikan</span>
                                    @else
                                        <span class="badge bg-secondary">Belum</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('waka-rekomendasi-show', $beasiswa->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> Tinjau
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada pendaftar dari sekolah Anda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
