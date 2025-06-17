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
                            <h1 class="h4 mb-1">Monitoring Kurikulum Waka Kurikulum</h1>
                            <p class="text-muted mb-0">Pantau kurikulum yang diajukan oleh Waka Kurikulum</p>
                        </div>
                    </div>
                    
                    <div class="alert alert-info d-flex align-items-center mb-4">
                        <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                        <div>Pada halaman ini, Anda dapat memantau kurikulum yang diajukan oleh Waka Kurikulum dan status validasinya oleh Perusahaan.</div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-calendar3"></i>
                                </span>
                                <input type="date" id="filter-date" class="form-control border-start-0" placeholder="Filter berdasarkan tanggal">
                                <button class="btn btn-outline-secondary" type="button" id="clear-date">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs nav-tabs-custom mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="waiting-tab" data-bs-toggle="tab" data-bs-target="#waiting-validation" type="button" role="tab">
                                <i class="bi bi-clock me-2"></i>Menunggu Validasi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab">
                                <i class="bi bi-check-circle me-2"></i>Disetujui
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab">
                                <i class="bi bi-x-circle me-2"></i>Ditolak
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <!-- Tab Menunggu Validasi -->
                        <div class="tab-pane fade show active" id="waiting-validation" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle kurikulum-table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0">Pengirim</th>
                                            <th class="border-0">Nama Kurikulum</th>
                                            <th class="border-0">Tahun Ajaran</th>
                                            <th class="border-0">File</th>
                                            <th class="border-0">Tanggal Pengajuan</th>
                                            <th class="border-0">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $hasWaiting = false; @endphp
                                        @foreach ($kurikulums as $kurikulum)
                                            @if($kurikulum->validasi_perusahaan == 'proses')
                                                @php $hasWaiting = true; @endphp
                                                <tr>
                                                    <td>{{ $kurikulum->pengirim->name }} (Waka Kurikulum)</td>
                                                    <td>{{ $kurikulum->nama_kurikulum }}</td>
                                                    <td>{{ $kurikulum->tahun_ajaran }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/'.$kurikulum->file_kurikulum) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-download me-1"></i> Unduh
                                                        </a>
                                                    </td>
                                                    <td class="created-date">{{ \Carbon\Carbon::parse($kurikulum->created_at)->format('Y-m-d') }}</td>
                                                    <td><span class="badge bg-warning">Menunggu Validasi Perusahaan</span></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        
                                        @if(!$hasWaiting)
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                        Tidak ada kurikulum yang menunggu validasi
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Tab Disetujui -->
                        <div class="tab-pane fade" id="approved" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle kurikulum-table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0">Pengirim</th>
                                            <th class="border-0">Nama Kurikulum</th>
                                            <th class="border-0">Tahun Ajaran</th>
                                            <th class="border-0">File</th>
                                            <th class="border-0">Tanggal Pengajuan</th>
                                            <th class="border-0">Tanggal Validasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $hasApproved = false; @endphp
                                        @foreach ($kurikulums as $kurikulum)
                                            @if($kurikulum->validasi_perusahaan == 'disetujui')
                                                @php $hasApproved = true; @endphp
                                                <tr>
                                                    <td>{{ $kurikulum->pengirim->name }} (Waka Kurikulum)</td>
                                                    <td>{{ $kurikulum->nama_kurikulum }}</td>
                                                    <td>{{ $kurikulum->tahun_ajaran }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/'.$kurikulum->file_kurikulum) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-download me-1"></i> Unduh
                                                        </a>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($kurikulum->created_at)->format('Y-m-d') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($kurikulum->updated_at)->format('Y-m-d') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        
                                        @if(!$hasApproved)
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                        Belum ada kurikulum yang disetujui
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Tab Ditolak -->
                        <div class="tab-pane fade" id="rejected" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle kurikulum-table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0">Pengirim</th>
                                            <th class="border-0">Nama Kurikulum</th>
                                            <th class="border-0">Tahun Ajaran</th>
                                            <th class="border-0">File</th>
                                            <th class="border-0">Tanggal Pengajuan</th>
                                            <th class="border-0">Komentar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $hasRejected = false; @endphp
                                        @foreach ($kurikulums as $kurikulum)
                                            @if($kurikulum->validasi_perusahaan == 'tidak_disetujui')
                                                @php $hasRejected = true; @endphp
                                                <tr>
                                                    <td>{{ $kurikulum->pengirim->name }} (Waka Kurikulum)</td>
                                                    <td>{{ $kurikulum->nama_kurikulum }}</td>
                                                    <td>{{ $kurikulum->tahun_ajaran }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/'.$kurikulum->file_kurikulum) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-download me-1"></i> Unduh
                                                        </a>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($kurikulum->created_at)->format('Y-m-d') }}</td>
                                                    <td>{{ $kurikulum->komentar ?? '-' }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        
                                        @if(!$hasRejected)
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                        Belum ada kurikulum yang ditolak
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.nav-tabs-custom .nav-link {
    border: none;
    border-bottom: 2px solid transparent;
    color: #6c757d;
    padding: 0.75rem 1rem;
}
.nav-tabs-custom .nav-link.active {
    color: #2196f3;
    border-bottom: 2px solid #2196f3;
    background: transparent;
}
.table > :not(caption) > * > * {
    padding: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle tab switching with URL hash
    const tabHash = window.location.hash;
    if (tabHash) {
        const tab = document.querySelector(`[data-bs-target="${tabHash}"]`);
        if (tab) {
            const tabInstance = new bootstrap.Tab(tab);
            tabInstance.show();
        }
    }

    // Set hash on tab click
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(event) {
            window.location.hash = event.target.getAttribute('data-bs-target');
        });
    });
    
    // Date filter functionality
    const dateFilter = document.getElementById('filter-date');
    const clearDateBtn = document.getElementById('clear-date');
    
    function filterTablesByDate() {
        const selectedDate = dateFilter.value;
        const tables = document.querySelectorAll('.kurikulum-table');
        
        tables.forEach(table => {
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                if (row.cells.length <= 1) return; // Skip empty message rows
                
                const dateCell = row.querySelector('td:nth-child(5)');
                if (!dateCell) return;
                
                const dateText = dateCell.textContent.trim();
                
                if (!selectedDate || dateText.startsWith(selectedDate)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    dateFilter.addEventListener('input', filterTablesByDate);
    clearDateBtn.addEventListener('click', function() {
        dateFilter.value = '';
        filterTablesByDate();
    });
    
    // Re-apply filter when changing tabs
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', filterTablesByDate);
    });
});
</script>
@endsection
