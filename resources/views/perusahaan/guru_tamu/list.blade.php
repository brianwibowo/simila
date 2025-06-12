@extends('layouts.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Guru Tamu</h1>
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
                <th>Status</th>
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
                    <td>{{ $gurutamu->status }}</td>
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
