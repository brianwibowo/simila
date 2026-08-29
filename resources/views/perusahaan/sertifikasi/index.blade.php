@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>Manajemen Ujian Sertifikasi</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('perusahaan-sertifikasi-create') }}" class="btn btn-primary mb-3">Buat Ujian Baru</a>
    <a href="{{ route('perusahaan-sertifikasi-results') }}" class="btn btn-info mb-3">Lihat Hasil Ujian Siswa</a>

    <div class="card">
        <div class="card-header">Daftar Ujian</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Ujian</th>
                            <th>Kompetensi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($exams as $exam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $exam->nama_ujian }}</td>
                                <td>{{ $exam->kompetensi_terkait ?? '-' }}</td>
                                <td class="text-center">
                                    <x-table-actions
                                        :viewRoute="route('perusahaan-sertifikasi-show', $exam->id)"
                                        :editRoute="route('perusahaan-sertifikasi-edit', $exam->id)"
                                        :deleteRoute="route('perusahaan-sertifikasi-destroy', $exam->id)"
                                        deleteMessage="Yakin ingin menghapus sertifikasi ini? Ini juga akan menghapus semua pendaftaran terkait."
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada ujian sertifikasi yang dibuat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection