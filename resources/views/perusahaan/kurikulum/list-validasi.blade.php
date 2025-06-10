@extends('layouts.layout')

@section('content')
<div class="container mt-4">

    <h1 class="h4 mb-0">Daftar Kurikulum Sekolah</h1>

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
            </tr>
        </thead>
        <tbody>
            @foreach ($kurikulums as $kurikulum )
                <tr>
                    <td>{{ $kurikulum->pengirim->name }}</td>
                    <td>{{ $kurikulum->nama_kurikulum }}</td>
                    <td>{{ $kurikulum->tahun_ajaran }}</td>
                    <td><a href="{{ asset('storage/'.$kurikulum->file_kurikulum)}}" target="_blank">Unduh</a></td>
                    <td class="created-date">{{ \Carbon\Carbon::parse($kurikulum->updated_at)->format('Y-m-d') }}</td>
                    <td>{{ $kurikulum->validasi_perusahaan }}</td>
                    <td>
                        @if ($kurikulum->validasi_perusahaan == 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                        <div class="btn-group" role="group" aria-label="Actions">
                            <form action="{{ route('perusahaan-kurikulum-setuju', ['kurikulum' => $kurikulum->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Validasi
                                </button>
                            </form>
                            <button type="button" class="btn btn-sm btn-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#tolakModal" 
                                data-kurikulum-id="{{ $kurikulum->id }}">
                                Tolak
                            </button>
                        </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal Tolak -->
    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form id="tolakForm" method="POST">
            @csrf
            @method('PUT') <!-- atau POST, tergantung route kamu -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tolakModalLabel">Komentar Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="komentar" class="form-label">Komentar</label>
                        <textarea class="form-control" name="komentar" id="komentar" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<script>
    const tolakModal = document.getElementById('tolakModal');
    const tolakForm = document.getElementById('tolakForm');

    tolakModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const kurikulumId = button.getAttribute('data-kurikulum-id');
        tolakForm.action = `/perusahaan/kurikulum/${kurikulumId}/tolak`; // Sesuaikan dengan route kamu
    });

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
