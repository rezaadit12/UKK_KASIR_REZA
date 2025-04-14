@extends('main')
@section('title', 'User - SB Admin')
@section('content')
    <h1 class="mt-4">User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="" title="url previous">User</a></li>
        <li class="breadcrumb-item active">Update User</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form class="form-horizontal form-material mx-2" method="POST" action="{{route('user.update', $item->id)}}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" name="name" class="form-control form-control-line" value="{{ $item->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Email  <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="email" name="email" id="price" class="form-control form-control-line " value="{{$item->email}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Role <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select name="role" class="form-select">
                                    <option value="admin" {{ ($item->role == 'admin') ? 'selected': '' }}>Admin</option>
                                    <option value="petugas" {{ ($item->role == 'petugas') ? 'selected': '' }}>Employee</option>
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
