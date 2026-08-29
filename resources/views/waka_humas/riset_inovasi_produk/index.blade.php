@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Daftar Riset/Inovasi Produk</h1>
        <a href="{{ route('waka-humas-riset-create') }}" class="btn btn-primary">
            + Ajukan Riset
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Topik</th>
                <th>Deskripsi</th>
                <th>Anggota</th>
                <th class="text-center" style="width: 120px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($risets as $riset)
                <tr>
                    <td>{{ $riset->topik }}</td>
                    <td>{{ $riset->deskripsi }}</td>
                    <td>
                        @foreach($riset->anggota as $anggota)
                            <span class="badge bg-secondary">{{ $anggota->user->name }}</span>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <x-table-actions
                            :viewRoute="route('waka-humas-riset-show', $riset)"
                            :editRoute="route('waka-humas-riset-edit', $riset)"
                            :deleteRoute="route('waka-humas-riset-destroy', $riset)"
                            deleteMessage="Yakin ingin menghapus riset ini?"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data riset</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $risets->links() }}
    </div>
</div>
@endsection
