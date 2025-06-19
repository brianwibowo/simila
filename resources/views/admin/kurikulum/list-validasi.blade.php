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
                    
                    <div class="alert alert-info d-flex align-items-center mb-4">
                        <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                        <div>Pada halaman ini, Anda dapat memvalidasi kurikulum yang diajukan oleh Perusahaan dan melihat riwayat validasi.</div>
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
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" id="search-input" class="form-control border-start-0" placeholder="Cari kurikulum...">
                                <button class="btn btn-outline-secondary" type="button" id="clear-search">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button id="reset-all-filters" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset Semua Filter
                            </button>
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
                                            <th class="border-0">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $hasWaiting = false; @endphp
                                        @foreach ($kurikulums as $kurikulum)
                                            @if($kurikulum->validasi_sekolah == 'proses')
                                                @php $hasWaiting = true; @endphp
                                                <tr>
                                                    <td>{{ $kurikulum->pengirim->name }}</td>
                                                    <td>{{ $kurikulum->nama_kurikulum }}</td>
                                                    <td>{{ $kurikulum->tahun_ajaran }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/'.$kurikulum->file_kurikulum) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-download me-1"></i> Unduh
                                                        </a>
                                                    </td>
                                                    <td class="created-date">{{ \Carbon\Carbon::parse($kurikulum->created_at)->format('Y-m-d') }}</td>
                                                    <td><span class="badge bg-warning">Menunggu</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <form action="{{ route('admin-kurikulum-setuju', $kurikulum) }}" method="POST" class="d-inline" id="approveForm{{ $kurikulum->id }}">
                                                                @csrf
                                                                <button type="button" onclick="confirmApprove({{ $kurikulum->id }})" class="btn btn-success btn-sm">
                                                                    <i class="bi bi-check-lg me-1"></i> Setujui
                                                                </button>
                                                            </form>
                                                            
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger" 
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#tolakModal{{ $kurikulum->id }}"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Tolak">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </div>
                                                        
                                                        <!-- Modal Tolak Kurikulum -->
                                                        <div class="modal fade" id="tolakModal{{ $kurikulum->id }}" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="tolakModalLabel">
                                                                            <i class="bi bi-x-circle text-danger me-2"></i>
                                                                            Tolak Kurikulum
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{ route('admin-kurikulum-tolak', $kurikulum) }}" method="POST" id="rejectForm{{ $kurikulum->id }}">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="catatan{{ $kurikulum->id }}" class="form-label">Catatan Penolakan</label>
                                                                            <textarea class="form-control" id="catatan{{ $kurikulum->id }}" name="catatan" rows="3" required></textarea>
                                                                        </div>
                                                                        <div class="text-end">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="button" onclick="confirmReject({{ $kurikulum->id }})" class="btn btn-danger">
                                                                                <i class="bi bi-x-lg me-1"></i> Tolak Kurikulum
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        
                                        @if(!$hasWaiting)
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                                        <p class="mt-3 mb-0">Tidak ada kurikulum yang sedang menunggu validasi</p>
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
                                            @if($kurikulum->validasi_sekolah == 'disetujui')
                                                @php $hasApproved = true; @endphp
                                                <tr>
                                                    <td>{{ $kurikulum->pengirim->name }}</td>
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
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <i class="bi bi-clipboard-check fs-1 text-muted"></i>
                                                        <p class="mt-3 mb-0">Tidak ada kurikulum yang sudah disetujui</p>
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
                                            @if($kurikulum->validasi_sekolah == 'tidak_disetujui')
                                                @php $hasRejected = true; @endphp
                                                <tr>
                                                    <td>{{ $kurikulum->pengirim->name }}</td>
                                                    <td>{{ $kurikulum->nama_kurikulum }}</td>
                                                    <td>{{ $kurikulum->tahun_ajaran }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/'.$kurikulum->file_kurikulum) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-download me-1"></i> Unduh
                                                        </a>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($kurikulum->created_at)->format('Y-m-d') }}</td>
                                                    <td>
                                                        @if($kurikulum->komentar)
                                                            <span class="text-muted">{{ Str::limit($kurikulum->komentar, 50) }}</span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        
                                        @if(!$hasRejected)
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <i class="bi bi-x-octagon fs-1 text-muted"></i>
                                                        <p class="mt-3 mb-0">Tidak ada kurikulum yang ditolak</p>
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
.table > :not(caption) > * > * {
    padding: 1rem;
}
.btn-group .btn {
    padding: 0.375rem 0.75rem;
}
.nav-tabs-custom .nav-link {
    color: #6c757d;
    border: none;
    padding: 0.75rem 1.25rem;
    font-weight: 500;
}
.nav-tabs-custom .nav-link.active {
    color: #0d6efd;
    background: none;
    border-bottom: 2px solid #0d6efd;
}
.nav-tabs-custom .nav-link:hover {
    color: #0d6efd;
    border-color: transparent;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Handle tab switching with URL hash
    const tabHash = window.location.hash;
    if (tabHash) {
        const tab = document.querySelector(`a[href="${tabHash}"]`);
        if (tab) {
            tab.click();
        }
    }

    // Set hash on tab click
    document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
        tab.addEventListener('click', function() {
            window.location.hash = this.getAttribute('href');
        });
    });

    // Date filter functionality
    const dateFilter = document.getElementById('filter-date');
    const clearDateBtn = document.getElementById('clear-date');
    const searchInput = document.getElementById('search-input');
    const clearSearchBtn = document.getElementById('clear-search');
    const resetAllBtn = document.getElementById('reset-all-filters');
    
    function filterTables() {
        const selectedDate = dateFilter.value;
        const searchQuery = searchInput.value.toLowerCase();
        const activeTabId = document.querySelector('.tab-pane.active').id;
        const tables = document.querySelectorAll('.kurikulum-table');
        
        tables.forEach(table => {
            const rows = table.querySelectorAll('tbody tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                if (row.cells.length <= 1) return; // Skip empty message rows
                
                const dateCell = row.querySelector('td.created-date')?.textContent.trim() || '';
                const nameCell = row.cells[1]?.textContent.toLowerCase() || '';
                const senderCell = row.cells[0]?.textContent.toLowerCase() || '';
                const yearCell = row.cells[2]?.textContent.toLowerCase() || '';
                
                // Improved date comparison logic
                let showRow = true;
                if (selectedDate && selectedDate !== '') {
                    // Convert both dates to Date objects for proper comparison
                    const filterDate = new Date(selectedDate);
                    const rowDate = new Date(dateCell);
                    
                    // Compare dates ignoring the time part
                    if (filterDate.toISOString().split('T')[0] !== rowDate.toISOString().split('T')[0]) {
                        showRow = false;
                    }
                }
                
                // Apply search filter
                if (searchQuery && !(
                    nameCell.includes(searchQuery) || 
                    senderCell.includes(searchQuery) || 
                    yearCell.includes(searchQuery)
                )) {
                    showRow = false;
                }
                
                if (showRow) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Show/hide empty state message for the current tab
            const emptyMessage = table.closest('.tab-pane').querySelector('.empty-state');
            if (emptyMessage) {
                emptyMessage.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    }
    
    dateFilter.addEventListener('change', filterTables);
    dateFilter.addEventListener('input', filterTables);  // Handle both change and input events
    searchInput.addEventListener('input', filterTables);
    
    // Clear date filter button
    clearDateBtn.addEventListener('click', function() {
        dateFilter.value = '';
        filterTables();
    });
    
    // Clear search filter button
    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        filterTables();
    });
    
    // Reset all filters button
    resetAllBtn.addEventListener('click', function() {
        dateFilter.value = '';
        searchInput.value = '';
        filterTables();
    });
    
    // Re-apply filter when changing tabs
    document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
        tab.addEventListener('shown.bs.tab', filterTables);
    });
    
    // Confirmation functions for approve and reject
    function confirmApprove(kurikulumId) {
        if (confirm('Apakah Anda yakin ingin menyetujui kurikulum ini?')) {
            document.getElementById('approveForm' + kurikulumId).submit();
        }
    }
    
    function confirmReject(kurikulumId) {
        const form = document.getElementById('rejectForm' + kurikulumId);
        const catatan = document.getElementById('catatan' + kurikulumId).value.trim();
        
        if (!catatan) {
            alert('Catatan penolakan harus diisi!');
            return;
        }
        
        if (confirm('Apakah Anda yakin ingin menolak kurikulum ini?')) {
            form.submit();
        }
    }
    
    // Initial filter call
    filterTables();
});
</script>
@endsection
