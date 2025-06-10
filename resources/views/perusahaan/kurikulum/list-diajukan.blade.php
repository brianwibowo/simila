@extends('layouts.layout')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Daftar Kurikulum Diajukan</h1>
        <a href="{{ route('perusahaan-kurikulum-create') }}" class="btn btn-success">
            + Ajukan Kurikulum
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <input type="date" id="filter-date" class="form-control">
        </div>
    </div>

    <table class="table table-bordered table-striped" id="kurikulum-table">
        <thead class="table-light">
            <tr>
                <th>Pengirim</th>
                <th>Nama</th>
                <th>Tahun Ajaran</th>
                <th>File</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                <th>Aksi</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kurikulums as $kurikulum )
                <tr>
                    <td>{{ $kurikulum->pengirim->name }}</td>
                    <td>{{ $kurikulum->nama_kurikulum }}</td>
                    <td>{{ $kurikulum->tahun_ajaran }}</td>
                    <td><a href="/kurikulum/{{ $kurikulum->file_kurikulum }}" target="_blank">Unduh</a></td>
                    <td class="created-date">{{ \Carbon\Carbon::parse($kurikulum->updated_at)->format('Y-m-d') }}</td>
                    <td>{{ $kurikulum->validasi_sekolah }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Actions">
                            <a href="{{ route('perusahaan-kurikulum-edit', ['kurikulum' => $kurikulum->id]) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                    
                            <form action="{{ route('perusahaan-kurikulum-destroy', ['kurikulum' => $kurikulum->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>{{ $kurikulum->komentar }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    document.getElementById('filter-date').addEventListener('input', function () {
      const selectedDate = this.value;
      const rows = document.querySelectorAll('#kurikulum-table tbody tr');
  
      rows.forEach(row => {
        const createdDate = row.querySelector('.created-date').textContent.trim();
        
        // Cocokkan dengan format input date (YYYY-MM-DD)
        if (!selectedDate || createdDate.startsWith(selectedDate)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  </script>
@endsection
