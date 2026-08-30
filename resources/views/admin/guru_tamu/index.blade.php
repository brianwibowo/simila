@extends('layouts.layout')

@section('content')
{{-- 1. Standard Page Header --}}
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">
            <i class="fas fa-chalkboard-teacher text-primary me-2"></i> Manajemen Guru Tamu
        </h3>
        <p class="text-muted mb-0" style="font-size: 0.85rem;">Kelola program kehadiran praktisi industri dan guru tamu DUDI untuk pengajaran vokasi.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <a href="{{ route('admin-guru-tamu-create') }}" class="btn btn-primary rounded-pill fw-bold px-3.5 py-1.5 shadow-sm d-inline-flex align-items-center gap-1.5" style="font-size: 0.82rem;">
            <i class="fas fa-plus-circle"></i>
            <span>Ajukan Guru Tamu</span>
        </a>
    </div>
</div>

{{-- 2. Alerts --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- 3. Main Data Card --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Keahlian</th>
                                    <th>Jadwal</th>
                                    <th>Diajukan Oleh</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($guruTamus as $guru)
                                    <tr>
                                        <td class="fw-semibold">{{ $guru->nama_karyawan }}</td>
                                        <td>{{ $guru->jabatan }}</td>
                                        <td><span class="badge bg-secondary">{{ $guru->keahlian }}</span></td>
                                        <td>{{ $guru->formatted_jadwal }}</td>
                                        <td>{{ $guru->submitter ? $guru->submitter->name : 'Tidak diketahui' }}</td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'proses' => 'badge bg-warning',
                                                    'disetujui' => 'badge bg-success'
                                                ];
                                                $statusLabels = \App\Models\GuruTamu::getStatusOptions();
                                            @endphp
                                            <span class="{{ $statusClasses[$guru->status] ?? 'badge bg-secondary' }}">
                                                {{ $statusLabels[$guru->status] ?? $guru->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <x-table-actions
                                                :viewRoute="route('admin-guru-tamu-show', $guru->id)"
                                                :editRoute="route('admin-guru-tamu-edit', $guru->id)"
                                                :approveRoute="$guru->status === 'proses' ? route('admin-guru-tamu-approve', $guru->id) : null"
                                                :deleteRoute="route('admin-guru-tamu-destroy', $guru->id)"
                                                deleteMessage="Apakah Anda yakin ingin menghapus data ini?"
                                                approveMessage="Apakah Anda yakin ingin menyetujui pengajuan ini?"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Tidak ada data guru tamu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($guruTamus->hasPages())
                    <div class="card-footer py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="small text-muted">
                            Menampilkan <strong>{{ $guruTamus->firstItem() }}</strong> - <strong>{{ $guruTamus->lastItem() }}</strong> dari <strong>{{ $guruTamus->total() }}</strong> data
                        </div>
                        <div>
                            {{ $guruTamus->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
@endsection
