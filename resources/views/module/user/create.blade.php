@extends('main')
@section('title', 'User - SB Admin')
@section('content')

    <h1 class="mt-4">User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">User</a></li>
        <li class="breadcrumb-item active">Tambah User</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form class="form-horizontal form-material mx-2" method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" name="name" class="form-control form-control-line">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Email  <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="email" name="email" id="price" class="form-control form-control-line ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Role <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select name="role" id="" class="form-select">
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Employee</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Password <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="password" name="password" class="form-control form-control-line ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col text-end ">
                        <button type="submit" class="btn btn-primary w-25">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
