@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Selamat datang di dashboard admin!</p>
                      <div class="mt-4">
                        <h5>Manajemen User</h5>
                        <a href="{{ route('admin-users-index') }}" class="btn btn-primary">
                            Kelola User Baru
                        </a>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection