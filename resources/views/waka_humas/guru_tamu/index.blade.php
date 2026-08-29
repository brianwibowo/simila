@extends('layouts.layout')

@section('content')
<div class="container-fluid px-0">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Pengajuan Guru Tamu</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
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
                                @forelse($guruTamus as $guruTamu)
                                <tr>                                    
                                    <td class="fw-semibold">{{ $guruTamu->nama_karyawan }}</td>
                                    <td>{{ $guruTamu->jabatan }}</td>
                                    <td><span class="badge bg-secondary">{{ $guruTamu->keahlian }}</span></td>
                                    <td>{{ $guruTamu->getFormattedJadwalAttribute() }}</td>
                                    <td>{{ $guruTamu->submitter ? $guruTamu->submitter->name : 'Tidak diketahui' }}</td>
                                    <td>                                        
                                        <span class="badge bg-{{ $guruTamu->status === 'disetujui' ? 'success' : 'warning' }}">
                                            {{ $guruTamu->status === 'disetujui' ? 'Disetujui' : 'Menunggu Konfirmasi' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <x-table-actions
                                            :viewRoute="route('waka-humas-guru-tamu-show', $guruTamu)"
                                            :approveRoute="$guruTamu->status === 'proses' ? route('waka-humas-guru-tamu-approve', $guruTamu) : null"
                                            approveMessage="Apakah Anda yakin ingin menyetujui pengajuan guru tamu ini?"
                                        />
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Tidak ada data guru tamu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $guruTamus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
