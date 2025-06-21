@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Status Pendaftaran Beasiswa</h3>

    @if($beasiswa ?? '')
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">{{ $beasiswa ?? ''->batch->batch ?? '-' }}</h5>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Status:</strong>
                        @if($beasiswa ?? ''->status == 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @elseif($beasiswa ?? ''->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-warning text-dark">Menunggu Review</span>
                        @endif
                    </li>
                    <li class="list-group-item">
                        <strong>Rapor:</strong> <a href="{{ Storage::url($beasiswa ?? ''->raport) }}" target="_blank">Lihat</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Surat Rekomendasi:</strong> <a href="{{ Storage::url($beasiswa ?? ''->surat_rekomendasi) }}" target="_blank">Lihat</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Surat Motivasi:</strong> <a href="{{ Storage::url($beasiswa ?? ''->surat_motivasi) }}" target="_blank">Lihat</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Portofolio:</strong> <a href="{{ Storage::url($beasiswa ?? ''->portofolio) }}" target="_blank">Lihat</a>
                    </li>
                </ul>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Anda belum mengajukan pendaftaran beasiswa.
        </div>
    @endif
</div>
@endsection
