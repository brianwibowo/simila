@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>Detail Ujian Sertifikasi: {{ $certificationExam->nama_ujian }}</h2> {{-- Nama variabel disesuaikan --}}

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">Informasi Ujian</div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $certificationExam->deskripsi ?? '-' }}</p> {{-- Nama variabel disesuaikan --}}
            <p><strong>Kompetensi Terkait:</strong> {{ $certificationExam->kompetensi_terkait ?? '-' }}</p> {{-- Nama variabel disesuaikan --}}
            <p><strong>Durasi:</strong> {{ $certificationExam->durasi_menit ? $certificationExam->durasi_menit . ' menit' : '-' }}</p> {{-- Nama variabel disesuaikan --}}
            <p><strong>Nilai Minimum Lulus:</strong> {{ $certificationExam->nilai_minimum_lulus }}</p> {{-- Nama variabel disesuaikan --}}
            <p><strong>Status:</strong> {{ ucfirst($certificationExam->status_ujian) }}</p> {{-- Nama variabel disesuaikan --}}
            <a href="{{ route('perusahaan-sertifikasi-edit', $certificationExam->id) }}" class="btn btn-warning btn-sm">Edit Ujian</a> {{-- Nama variabel disesuaikan --}}
            <a href="{{ route('perusahaan-sertifikasi-index') }}" class="btn btn-secondary btn-sm">Kembali ke Daftar Ujian</a>
        </div>
    </div>

    {{-- Daftar Soal --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            Daftar Soal
            <a href="{{ route('perusahaan-sertifikasi-questions.create', $certificationExam->id) }}" class="btn btn-primary btn-sm">Tambah Soal</a> {{-- Nama variabel disesuaikan --}}
        </div>
        <div class="card-body">
            @if ($questions->isEmpty())
                <p>Belum ada soal untuk ujian ini.</p>
            @else
                <div class="accordion" id="questionsAccordion">
                    @foreach ($questions as $question)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header" id="heading{{ $question->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $question->id }}" aria-expanded="false" aria-controls="collapse{{ $question->id }}">
                                    Soal {{ $loop->iteration }}: {{ Str::limit($question->soal, 100) }}
                                </button>
                            </h2>
                            <div id="collapse{{ $question->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $question->id }}" data-bs-parent="#questionsAccordion">
                                <div class="accordion-body">
                                    <p><strong>Soal:</strong> {{ $question->soal }}</p>
                                    <p><strong>Pilihan A:</strong> {{ $question->pilihan_jawaban_1 }}</p>
                                    <p><strong>Pilihan B:</strong> {{ $question->pilihan_jawaban_2 }}</p>
                                    <p><strong>Pilihan C:</strong> {{ $question->pilihan_jawaban_3 }}</p>
                                    <p><strong>Pilihan D:</strong> {{ $question->pilihan_jawaban_4 }}</p>
                                    <p><strong>Jawaban Benar:</strong> Pilihan {{ $question->jawaban_benar }}</p>
                                    <p><strong>Nilai Soal:</strong> {{ $question->nilai_akhir }}</p>
                                    <div class="mt-3">
                                        <a href="{{ route('perusahaan-sertifikasi-questions.edit', [$certificationExam->id, $question->id]) }}" class="btn btn-sm btn-warning">Edit Soal</a> {{-- Nama variabel disesuaikan --}}
                                        <form action="{{ route('perusahaan-sertifikasi-questions.destroy', [$certificationExam->id, $question->id]) }}" method="POST" class="d-inline"> {{-- Nama variabel disesuaikan --}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus soal ini?')">Hapus Soal</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Daftar Pendaftar Ujian --}}
    <div class="card">
        <div class="card-header">Daftar Pendaftar Ujian ini</div>
        <div class="card-body">
            @if ($registrations->isEmpty())
                <p>Belum ada siswa yang mendaftar untuk ujian ini.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>Status Pendaftaran</th>
                                <th>Nilai Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrations as $reg)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reg->siswa->name }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $reg->status_pendaftaran_ujian)) }}</td>
                                    <td>{{ $reg->nilai ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('perusahaan-sertifikasi-results.give_certificate_form', $reg->id) }}" class="btn btn-sm btn-primary">Beri Nilai & Sertifikat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection