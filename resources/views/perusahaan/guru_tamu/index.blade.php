@extends('layouts.layout')

@section('content')
<div class="container-fluid px-0">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Pengajuan Guru Tamu Saya</h4>
                    <a href="{{ route('perusahaan-guru-tamu-create') }}" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1">
                        <i class="fa fa-plus"></i>
                        <span>Ajukan Guru Tamu</span>
                    </a>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="filter-date" class="form-label text-muted small">Filter Berdasarkan Jadwal</label>
                            <input type="date" id="filter-date" class="form-control" placeholder="Filter tanggal jadwal">
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="gurutamu-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Keahlian</th>
                                    <th>Deskripsi</th>
                                    <th>Jadwal</th>
                                    <th>Status</th>
                                    <th>Dokumen</th>
                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gurutamus as $gurutamu)
                                    <tr>
                                        <td class="fw-semibold">{{ $gurutamu->nama_karyawan }}</td>
                                        <td>{{ $gurutamu->jabatan }}</td>
                                        <td><span class="badge bg-secondary">{{ $gurutamu->keahlian }}</span></td>
                                        <td class="text-truncate" style="max-width: 200px;">{{ $gurutamu->deskripsi }}</td>
                                        <td class="jadwal-date">{{ \Carbon\Carbon::parse($gurutamu->jadwal)->format('Y-m-d') }}</td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'proses' => 'badge bg-warning',
                                                    'disetujui' => 'badge bg-success',
                                                ];
                                                $statusLabels = App\Models\GuruTamu::getStatusOptions();
                                            @endphp
                                            <span class="{{ $statusClasses[$gurutamu->status] ?? 'badge bg-secondary' }}">
                                                {{ $statusLabels[$gurutamu->status] ?? $gurutamu->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                @if ($gurutamu->file_cv)
                                                    <a href="{{ asset('storage/' . $gurutamu->file_cv) }}" target="_blank" class="small text-primary text-decoration-none d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-file-earmark-person"></i> CV
                                                    </a>
                                                @else
                                                    <span class="text-muted small">Tanpa CV</span>
                                                @endif

                                                @if ($gurutamu->file_materi)
                                                    <a href="{{ asset('storage/' . $gurutamu->file_materi) }}" target="_blank" class="small text-primary text-decoration-none d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-file-earmark-slides"></i> Materi
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($gurutamu->status !== 'disetujui')
                                                <x-table-actions
                                                    :editRoute="route('perusahaan-guru-tamu-edit', ['guru_tamu' => $gurutamu->id])"
                                                    :deleteRoute="route('perusahaan-guru-tamu-destroy', ['guru_tamu' => $gurutamu->id])"
                                                    deleteMessage="Yakin ingin menghapus pengajuan guru tamu ini?"
                                                />
                                            @else
                                                <span class="badge bg-info">Telah Disetujui</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            <i class="fa fa-folder-open fa-2x mb-2 d-block opacity-50"></i>
                                            Belum ada data pengajuan guru tamu.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('filter-date')?.addEventListener('input', function () {
        const selectedDate = this.value;
        const rows = document.querySelectorAll('#gurutamu-table tbody tr');
    
        rows.forEach(row => {
            const jadwalEl = row.querySelector('.jadwal-date');
            if (jadwalEl) {
                const jadwalDate = jadwalEl.textContent.trim();
                if (!selectedDate || jadwalDate.startsWith(selectedDate)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });
</script>
@endsection
