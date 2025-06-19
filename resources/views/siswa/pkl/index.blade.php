@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 h4">Daftar Praktik Kerja Lapangan</h1>

    {{-- Filter dan Pencarian --}}
    <div class="row mb-4">
        <div class="col-md-5 mb-2">
            <input type="text" id="search-title" class="form-control" placeholder="Cari berdasarkan judul atau perusahaan...">
        </div>
        <div class="col-md-4 mb-2">
            <select id="filter-status" class="form-control">
                <option value="">Semua Status</option>
                <option value="dibuka">Dibuka</option>
                <option value="ditutup">Ditutup</option>
                <option value="penuh">Penuh</option>
                <option value="belum_dibuka">Belum Dibuka</option>
                <option value="pendaftaran_berakhir">Pendaftaran Berakhir</option>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <input type="date" id="filter-date" class="form-control" placeholder="Filter berdasarkan batas akhir daftar">
        </div>
    </div>

    {{-- Daftar Card PKL --}}
    <div class="row" id="pkl-cards">
        @forelse ($pkls as $pkl)
            @php
                $today = \Carbon\Carbon::now();
                $regStartDate = \Carbon\Carbon::parse($pkl->tanggal_mulai);

                $pklStatusText = '';
                $statusBadgeClass = '';
                $cardBorder = '';
                $actionButtonText = '';
                $actionButtonClass = '';
                $actionButtonDisabled = false;
                $actionButtonRoute = route('siswa-pkl-register', $pkl->id);

                // Menentukan status berdasarkan data PKL dan tanggal
                if ($pkl->status === 'selesai') {
                    $pklStatusText = 'Selesai';
                    $statusBadgeClass = 'bg-danger';
                    $cardBorder = 'border-danger';
                } elseif ($pkl->status === 'berjalan') {
                    $pklStatusText = 'Berjalan';
                    $statusBadgeClass = 'bg-warning text-dark';
                    $cardBorder = 'border-warning';
                } elseif ($today < $regStartDate) {
                    $pklStatusText = 'Belum Dibuka';
                    $statusBadgeClass = 'bg-secondary';
                    $cardBorder = 'border-secondary';
                } else {
                    $pklStatusText = 'Dibuka';
                    $statusBadgeClass = 'bg-success';
                    $cardBorder = 'border-success';
                }

                // Menentukan teks dan status tombol "Daftar Sekarang"
                if ($pklStatusText === 'proses') {
                    $actionButtonText = $pklStatusText;
                    $actionButtonClass = 'btn-secondary';
                    $actionButtonDisabled = true;
                } else {
                    $actionButtonText = 'Daftar Sekarang';
                    $actionButtonClass = 'btn-primary';
                }

                // Cek apakah siswa sudah terdaftar di PKL ini atau PKL lain
                // $currentStudentPklId harus dilewatkan dari controller
                if (isset($currentStudentPklId)) {
                    if ($currentStudentPklId == $pkl->id) {
                        $actionButtonText = 'Sudah Terdaftar di PKL Ini';
                        $actionButtonClass = 'btn-info';
                        $actionButtonDisabled = true;
                    } elseif ($currentStudentPklId !== null && $currentStudentPklId != $pkl->id) {
                        $actionButtonText = 'Sudah Terdaftar di PKL Lain';
                        $actionButtonClass = 'btn-info';
                        $actionButtonDisabled = true;
                    }
                }

                // Untuk kebutuhan filter JS
                $dataStatusForFilter = strtolower(str_replace(' ', '_', $pklStatusText));
            @endphp

            <div class="col-lg-4 col-md-6 mb-4 pkl-card"
                data-title="{{ strtolower($pkl->nama) }}"
                data-company="{{ strtolower($pkl->perusahaan->name ?? '') }}"
                data-status="{{ $dataStatusForFilter }}"
                data-end-date="{{ $pkl->tanggal_selesai_pendaftaran }}">
                <div class="card h-100 {{ $cardBorder }} shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                        <h6 class="card-title mb-0 text-truncate" style="max-width: 70%;" title="{{ $pkl->judul }}">
                            {{ $pkl->nama }}
                        </h6>
                        <span class="badge {{ $statusBadgeClass }}">{{ $pklStatusText }}</span>
                    </div>
                    
                    <div class="card-body">
                        <p class="card-text text-muted mb-3" style="min-height: 60px;">
                            {{ Str::limit($pkl->nama ?? '', 100) }}
                        </p>

                        <ul class="list-unstyled small mb-3">
                            <li><i class="bi bi-building me-1"></i> Perusahaan: <strong>{{ $pkl->perusahaan->name ?? 'N/A' }}</strong></li>
                            <li><i class="bi bi-person-fill-add me-1"></i> Pendaftar: <strong>{{ $pkl->siswas->count() ?? 'N/A' }} peserta</strong></li>
                            <li><i class="bi bi-calendar-event me-1"></i> Pendaftaran: {{ \Carbon\Carbon::parse($pkl->tanggal_mulai_pendaftaran)->format('d M Y') }} - {{ \Carbon\Carbon::parse($pkl->tanggal_selesai_pendaftaran)->format('d M Y') }}</li>
                        </ul>
                    </div>
                    
                    <div class="card-footer bg-white text-center">
                        @if(!$actionButtonDisabled)
                            <form action="{{ $actionButtonRoute }}" method="POST">
                                @csrf
                                <button type="submit" class="btn {{ $actionButtonClass }} w-100 rounded-pill shadow-sm">
                                    {{ $actionButtonText }}
                                </button>
                            </form>
                        @else
                            <button type="button" class="btn {{ $actionButtonClass }} w-100 rounded-pill shadow-sm" disabled>
                                {{ $actionButtonText }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div id="empty-state-initial" class="text-center py-5 w-100">
                <div class="mb-3">
                    <i class="bi bi-folder-x" style="font-size: 4rem; color: #6c757d;"></i>
                </div>
                <h5 class="text-muted">Tidak ada Praktik Kerja Lapangan yang ditemukan</h5>
                <p class="text-muted">Silakan cek kembali nanti untuk informasi PKL terbaru.</p>
            </div>
        @endforelse
    </div>

    {{-- Empty State untuk hasil filter/pencarian --}}
    <div id="empty-state-filtered" class="text-center py-5" style="display: none;">
        <div class="mb-3">
            <i class="bi bi-search" style="font-size: 4rem; color: #6c757d;"></i>
        </div>
        <h5 class="text-muted">Tidak Ada PKL yang Cocok</h5>
        <p class="text-muted">Coba ubah kriteria filter atau pencarian Anda.</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterStatus = document.getElementById('filter-status');
        const filterDate = document.getElementById('filter-date');
        const searchTitle = document.getElementById('search-title');
        const pklCardsContainer = document.getElementById('pkl-cards');
        const emptyStateInitial = document.getElementById('empty-state-initial');
        const emptyStateFiltered = document.getElementById('empty-state-filtered');

        function filterPkls() {
            const selectedStatus = filterStatus.value;
            const selectedDate = filterDate.value;
            const searchTitleValue = searchTitle.value.toLowerCase();
            const cards = document.querySelectorAll('.pkl-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                const company = card.getAttribute('data-company');
                const status = card.getAttribute('data-status');
                const endDate = card.getAttribute('data-end-date');
                
                let showCard = true;
                
                // Filter by title or company name
                if (searchTitleValue && !(title.includes(searchTitleValue) || company.includes(searchTitleValue))) {
                    showCard = false;
                }
                
                // Filter by status
                if (selectedStatus && status !== selectedStatus) {
                    showCard = false;
                }

                // Filter by end date
                if (selectedDate && endDate !== selectedDate) {
                    showCard = false;
                }
                
                if (showCard) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Logika untuk menampilkan/menyembunyikan empty state
            if (pklCardsContainer.children.length === 0 && emptyStateInitial) {
                // Tidak ada PKL sama sekali dari backend
                emptyStateInitial.style.display = 'block';
                emptyStateFiltered.style.display = 'none';
            } else if (visibleCount === 0) {
                // Ada PKL dari backend, tapi tidak ada yang cocok dengan filter
                emptyStateInitial.style.display = 'none'; // Pastikan yang awal tersembunyi
                emptyStateFiltered.style.display = 'block';
            } else {
                // Ada PKL yang cocok dengan filter
                emptyStateInitial.style.display = 'none';
                emptyStateFiltered.style.display = 'none';
            }
        }

        // Event listeners
        filterStatus.addEventListener('change', filterPkls);
        filterDate.addEventListener('input', filterPkls);
        searchTitle.addEventListener('input', filterPkls);

        // Panggil filter sekali saat DOM siap untuk mengatur state awal
        filterPkls();

        // Card hover effects
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.transition = 'transform 0.3s ease';
                this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });
    });
</script>

<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .badge {
        font-size: 0.75rem;
    }
    
    .btn-group .btn {
        flex: 1;
    }
    
    .card-footer {
        border-top: 1px solid #dee2e6;
    }

    .card-footer .btn {
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .card-footer .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    .card-footer .btn-secondary,
    .card-footer .btn-info {
        cursor: not-allowed;
        opacity: 0.8;
    }
</style>
@endsection