@extends('main')
@section('title', 'user - SB Admin')
@section('content')
    <h1 class="mt-4">User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">User</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-table me-2"></i>
                <span>Daftar User</span>
            </div>
            <a href="{{route('user.create')}}" class="btn btn-success">Tambah User</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $user)
                        @if ($user->email !== 'admin@gmail.com')
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    <div class="d-flex" style="display: flex">
                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-warning">EDIT</a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" onclick="return confirm('Periksa kembali sebelum menghapus')">HAPUS</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
