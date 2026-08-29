@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3">Penugasan Pembimbing PKL</h1>
            <p class="text-muted">Kelola penugasan guru pembimbing ke program PKL</p>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="card">
        <div class="card-header">
            <h5>Daftar Program PKL</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Program</th>
                            <th>Perusahaan</th>
                            <th>Tanggal</th>
                            <th>Pembimbing</th>
                            <th>Jumlah Siswa</th>
                            <th class="text-center" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pkls as $index => $pkl)
                            <tr>
                                <td>{{ $index + 1 + ($pkls->currentPage() - 1) * $pkls->perPage() }}</td>
                                <td>{{ $pkl->nama }}</td>
                                <td>{{ $pkl->perusahaan->name ?? 'Tidak ada' }}</td>
                                <td>
                                    {{ $pkl->tanggal_mulai->format('d/m/Y') }} - 
                                    {{ $pkl->tanggal_selesai->format('d/m/Y') }}
                                </td>
                                <td>
                                    @if($pkl->pembimbing)
                                        <span class="badge bg-success">{{ $pkl->pembimbing->name }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum ditugaskan</span>
                                    @endif
                                </td>
                                <td>{{ $pkl->siswas->count() }} siswa</td>
                                <td class="text-center" style="white-space: nowrap;">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('waka-humas-pkl-assign-show', $pkl->id) }}"
                                           class="btn btn-sm btn-outline-info"
                                           title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('waka-humas-pkl-assign-form', $pkl->id) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="{{ $pkl->pembimbing ? 'Ganti Pembimbing' : 'Tugaskan Pembimbing' }}">
                                            <i class="bi bi-person-fill-add"></i>
                                        </a>
                                        @if($pkl->pembimbing)
                                            <form action="{{ route('waka-humas-pkl-assign-remove', $pkl->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Hapus Penugasan"
                                                        onclick="return confirm('Anda yakin ingin menghapus penugasan pembimbing ini?')">
                                                    <i class="bi bi-person-dash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada program PKL yang tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{ $pkls->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
