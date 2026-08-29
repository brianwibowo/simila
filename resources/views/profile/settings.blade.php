@extends('layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="h3 fw-bold text-primary mb-1">
                <i class="fas fa-cog me-2"></i> Pengaturan Akun
            </h1>
            <p class="text-muted small mb-0">Kelola identitas profil, email, dan keamanan kata sandi akun Anda.</p>
        </div>
        <div>
            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Profil
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> Terjadi kesalahan validasi:
            <ul class="mb-0 mt-1 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Profile Information Card --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent py-3 px-4">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-user-edit me-2"></i> Informasi Identitas
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nis" class="form-label">Nomor Induk Siswa (NIS) / NIP</label>
                            <input type="text" 
                                   class="form-control @error('nis') is-invalid @enderror" 
                                   id="nis" 
                                   name="nis" 
                                   value="{{ old('nis', $user->nis) }}">
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian / Bidang</label>
                            <input type="text" 
                                   class="form-control @error('kompetensi_keahlian') is-invalid @enderror" 
                                   id="kompetensi_keahlian" 
                                   name="kompetensi_keahlian" 
                                   value="{{ old('kompetensi_keahlian', $user->kompetensi_keahlian) }}" 
                                   placeholder="Contoh: Rekayasa Perangkat Lunak">
                            @error('kompetensi_keahlian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Password Security Card --}}
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-transparent py-3 px-4">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-key me-2"></i> Keamanan Kata Sandi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi Baru</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-lock me-1"></i> Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
