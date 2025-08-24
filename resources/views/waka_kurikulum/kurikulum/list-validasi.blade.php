@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="h4 mb-1">Validasi Kurikulum dari Perusahaan</h1>
                            <p class="text-muted mb-0">Kelola dan validasi kurikulum yang diajukan oleh perusahaan</p>
                        </div>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-info-circle-fill"></i>
                        Pada halaman ini, Anda dapat memvalidasi kurikulum yang diajukan oleh Perusahaan dan melihat riwayat validasi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-calendar3"></i>
                                </span>
                                <input type="date" id="filter-date" class="form-control" placeholder="Filter berdasarkan tanggal mulai">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-tag"></i>
                                </span>
                                <select id="filter-status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="menunggu">Menunggu</option>
                                    <option value="disetujui">Disetujui</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="search-input" class="form-control" placeholder="Cari berdasarkan nama...">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="kurikulum-table">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Pengirim</th>
                                    <th class="border-0">Nama Kurikulum</th>
                                    <th class="border-0">Tahun Ajaran</th>
                                    <th class="border-0">File</th>
                                    <th class="border-0">Tanggal Update</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Aksi</th>
                                    <th class="border-0">Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kurikulums as $kurikulum)
                                    <tr class="kurikulum-row" 
                                        data-status="{{ $kurikulum->validasi_sekolah == 'proses' ? 'menunggu' : ($kurikulum->validasi_sekolah == 'disetujui' ? 'disetujui' : 'ditolak') }}">
                                        <td>{{ $kurikulum->pengirim->name }}</td>
                                        <td>{{ $kurikulum->nama_kurikulum }}</td>
                                        <td>{{ $kurikulum->tahun_ajaran }}</td>
                                        <td>
                                            <a href="{{ asset('storage/'.$kurikulum->file_kurikulum) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-download me-1"></i> Unduh
                                            </a>
                                        </td>
                                        <td class="created-date">{{ \Carbon\Carbon::parse($kurikulum->updated_at)->format('Y-m-d') }}</td> {{-- Tanggal pengajuan atau update terbaru --}}
                                        <td>
                                            @if($kurikulum->validasi_sekolah == 'disetujui')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif($kurikulum->validasi_sekolah == 'tidak_disetujui')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning">Menunggu</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('waka-kurikulum-show', ['kurikulum' => $kurikulum, 'source' => 'validasi']) }}" 
                                                   class="btn btn-sm btn-outline-primary me-1" 
                                                   data-bs-toggle="tooltip" 
                                                   title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                
                                                @if($kurikulum->validasi_sekolah == 'proses')
                                                    <form action="{{ route('waka-kurikulum-setuju', $kurikulum) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-success me-1" data-bs-toggle="tooltip" title="Setuju">
                                                            <i class="bi bi-check-lg"></i>
                                                        </button>
                                                    </form>
                                                    <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#tolakModal" 
                                                        data-kurikulum-id="{{ $kurikulum->id }}"
                                                        data-bs-toggle="tooltip"
                                                        title="Tolak">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($kurikulum->komentar)
                                                <span class="text-muted">{{ Str::limit($kurikulum->komentar, 50) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                Belum ada kurikulum dari perusahaan
                                            </div>
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

<!-- Modal untuk menolak kurikulum -->
<div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tolakModalLabel">Tolak Kurikulum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" id="tolakForm">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="komentar" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="komentar" name="komentar" rows="4" required></textarea>
                        <div class="form-text">Berikan alasan mengapa kurikulum ini ditolak. Alasan akan ditampilkan kepada pengirim.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Kurikulum</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .table > :not(caption) > * > * {
        padding: 1rem;
    }
    .btn-group .btn {
        padding: 0.375rem 0.75rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    
    // Configure the reject modal
    const tolakModal = document.getElementById('tolakModal');
    const tolakForm = document.getElementById('tolakForm');

    tolakModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const kurikulumId = button.getAttribute('data-kurikulum-id');
        tolakForm.action = `/waka_kurikulum/kurikulum/${kurikulumId}/tolak`;
    });

    const dateFilter = document.getElementById('filter-date');
    const statusFilter = document.getElementById('filter-status');
    const searchInput = document.getElementById('search-input');
    
    function filterTable() {
        const selectedDate = dateFilter.value.toLowerCase();
        const selectedStatus = statusFilter.value.toLowerCase();
        const searchKeyword = searchInput.value.toLowerCase();

        const rows = document.querySelectorAll('#kurikulum-table tbody tr.kurikulum-row');

        rows.forEach(row => {
            const createdDate = row.querySelector('.created-date').textContent.trim().toLowerCase();
            const statusText = row.getAttribute('data-status').toLowerCase();
            const nameText = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
            const senderText = row.querySelector('td:nth-child(1)').textContent.trim().toLowerCase();

            const matchDate = !selectedDate || createdDate.includes(selectedDate);
            const matchStatus = !selectedStatus || statusText === selectedStatus;
            const matchKeyword = !searchKeyword || nameText.includes(searchKeyword) || senderText.includes(searchKeyword);

            row.style.display = matchDate && matchStatus && matchKeyword ? '' : 'none';
        });

        // Check if we need to show "no data" message
        const visibleRows = document.querySelectorAll('#kurikulum-table tbody tr.kurikulum-row:not([style*="display: none"])');
        const noDataRow = document.querySelector('#kurikulum-table tbody tr:not(.kurikulum-row)');
        
        if (noDataRow) {
            noDataRow.style.display = visibleRows.length === 0 ? '' : 'none';
        }
    }

    dateFilter.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
    searchInput.addEventListener('input', filterTable);
});
</script>
@endsection
