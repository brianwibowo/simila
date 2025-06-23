@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Daftar Pelamar PKL</h1>
        {{-- Tombol aksi tambahan (misal: export, dll) bisa ditambahkan di sini jika diperlukan --}}
    </div>

    <p class="text-muted">Total: <strong class="text-primary">{{ $siswas->count() }}</strong> pelamar</p>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center">#</th>                            <th scope="col">Nama Pelamar</th>
                            <th scope="col">Email</th>
                            <th scope="col">Program PKl</th>
                            <th scope="col">Pembimbing</th>
                            <th scope="col" class="text-center">Status Aplikasi</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $siswa)
                            @php
                                $statusAplikasi = $siswa->pkl_status;
                                $badgeClass = '';
                                switch ($statusAplikasi) {
                                    case 'disetujui':
                                        $badgeClass = 'bg-success';
                                        break;
                                    case 'tidak_disetujui':
                                        $badgeClass = 'bg-danger';
                                        break;
                                    case 'proses':
                                    default:
                                        $badgeClass = 'bg-warning text-dark';
                                        break;
                                }
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>                                <td>{{ $siswa->name ?? '-' }}</td>
                                <td>{{ $siswa->email ?? '-' }}</td>
                                <td>{{ $siswa->pklSiswa->nama ?? 'Belum Terdaftar' }}</td>
                                <td>{{ $siswa->pklSiswa && $siswa->pklSiswa->pembimbing ? $siswa->pklSiswa->pembimbing->name : 'Belum Ditentukan' }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($statusAplikasi) }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        @if ($statusAplikasi === 'proses')
                                            <form action="{{ route('perusahaan-pkl-terima', $siswa->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Terima Pelamar">
                                                    <i class="bi bi-check-circle"></i> Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('perusahaan-pkl-tolak', $siswa->id) }}" method="POST" class="d-inline ms-1">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" title="Tolak Pelamar">
                                                    <i class="bi bi-x-circle"></i> Tolak
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                {{ ucfirst($statusAplikasi) }}
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="mb-2">
                                        <i class="bi bi-people" style="font-size: 3rem; color: #6c757d;"></i>
                                    </div>
                                    <p class="text-muted mb-0">Belum ada pelamar yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Jika $siswas adalah hasil pagination, tambahkan link pagination di sini --}}
            @if (isset($siswas) && method_exists($siswas, 'links'))
                <div class="d-flex justify-content-center mt-3">
                    {{ $siswas->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    .table th, .table td {
        white-space: nowrap; /* Prevent text wrapping in table cells */
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .table td:nth-child(2), .table td:nth-child(3) { /* Nama Pelamar, Email */
        max-width: 150px; /* Limit width for text-truncate */
    }
    .table td:nth-child(4) { /* Perusahaan PKL */
        max-width: 120px; /* Limit width */
    }
    .table td:nth-child(6) .btn-group {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection