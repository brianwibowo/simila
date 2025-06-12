@extends('layouts.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Daftar Pengajuan Guru Tamu</h1>
        <a href="{{ route('perusahaan-guru-tamu-create') }}" class="btn btn-success">
            + Ajukan Guru Tamu
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <input type="date" id="filter-date" class="form-control" placeholder="Filter tanggal jadwal">
        </div>
    </div>

    <table class="table table-bordered table-striped" id="gurutamu-table">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Keahlian</th>
                <th>Deskripsi</th>
                <th>Jadwal</th>
                <th>File CV</th>
                <th>File Materi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gurutamus as $gurutamu )
                <tr>
                    <td>{{ $gurutamu->nama_karyawan }}</td>
                    <td>{{ $gurutamu->jabatan }}</td>
                    <td>{{ $gurutamu->keahlian }}</td>
                    <td>{{ $gurutamu->deskripsi }}</td>
                    <td class="jadwal-date">{{ \Carbon\Carbon::parse($gurutamu->jadwal)->format('Y-m-d') }}</td>
                    <td>
                        @if ($gurutamu->file_cv == null)
                            <span class="text-danger">Tidak ada CV</span>
                        @else
                            <a href="{{ asset('storage/' . $gurutamu->file_cv) }}" target="_blank">Unduh CV</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $gurutamu->file_materi) }}" target="_blank">Unduh materi</a>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Actions">
                            <a href="{{ route('perusahaan-guru-tamu-edit', ['guru_tamu' => $gurutamu->id]) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('perusahaan-guru-tamu-destroy', ['guru_tamu' => $gurutamu->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('filter-date').addEventListener('input', function () {
        const selectedDate = this.value;
        const rows = document.querySelectorAll('#gurutamu-table tbody tr');
    
        rows.forEach(row => {
            const jadwalDate = row.querySelector('.jadwal-date').textContent.trim();
            if (!selectedDate || jadwalDate.startsWith(selectedDate)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
