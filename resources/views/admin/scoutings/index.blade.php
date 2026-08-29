@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Batch Talent Scouting</h1>
        <a href="{{ route('admin-scouting-create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Ajukan Batch Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Batch Aktif dan Selesai</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Batch</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($batches as $index => $batch)
                        <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $batch->batch }}</td>
                                <td>{{ \Carbon\Carbon::parse($batch->tanggal_mulai)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($batch->tanggal_selesai)->format('d M Y') }}</td>
                                <td>
                                    @if (\Carbon\Carbon::now()->lt($batch->tanggal_selesai))
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Selesai</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <x-table-actions
                                        :viewRoute="route('admin-scouting-show', ['scouting' => $batch->id])"
                                        :editRoute="route('admin-scouting-edit', ['scouting' => $batch->id])"
                                        :deleteRoute="route('admin-scouting-destroy', ['scouting' => $batch->id])"
                                        deleteMessage="Apakah Anda yakin ingin menghapus batch: {{ addslashes($batch->batch) }}?"
                                    />
                                </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada batch yang diajukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- TIDAK ADA LAGI MODAL ATAU BLOK @push('scripts') DI SINI --}}