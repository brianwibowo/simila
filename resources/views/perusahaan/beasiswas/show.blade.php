@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Detail Batch Beasiswa</h1>
            <p class="mb-0 text-muted">{{ $beasiswa->batch }}</p>
        </div>
        <a href="{{ route('perusahaan-beasiswa-index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Batch</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="text-muted mb-1">Nama Batch</p>
                    <p class="font-weight-bold h5">{{ $beasiswa->batch }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted mb-1">Status</p>
                    @if (\Carbon\Carbon::now()->lt($beasiswa->tanggal_selesai))
                        <span class="badge bg-success p-2">Aktif</span>
                    @else
                        <span class="badge bg-secondary p-2">Selesai</span>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted mb-1">Periode Pendaftaran</p>
                    <p class="font-weight-bold">
                        {{ \Carbon\Carbon::parse($beasiswa->tanggal_mulai)->format('d F Y') }} - 
                        {{ \Carbon\Carbon::parse($beasiswa->tanggal_selesai)->format('d F Y') }}
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted mb-1">Jumlah Pendaftar</p>
                    <p class="font-weight-bold">{{ $pendaftar->count() }} Orang</p>
                </div>
            </div>

            <hr>
            <div class="text-end">
                <a href="{{ route('perusahaan-beasiswa-edit', $beasiswa->id) }}" class="btn btn-warning shadow-sm">
                    <i class="fas fa-edit fa-sm"></i> Edit Batch
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pendaftar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Status Seleksi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaftar as $index => $siswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->nama_siswa }}</td>
                                <td class="text-center">
                                    @if($siswa->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($siswa->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu Review</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('perusahaan-beasiswa-siswa', ['user' => $siswa->id]) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Belum ada pendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
