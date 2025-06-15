@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>Kelola User Baru</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->getRoleNames()->isNotEmpty())
                                    @foreach($user->getRoleNames() as $role)
                                        <span class="badge bg-primary">{{ $role }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-secondary">Belum ada role</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin-users-update-role', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    <div class="input-group">
                                        <select name="role" class="form-select form-select-sm" style="width: auto;">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">Update Role</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada user baru yang membutuhkan role</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection