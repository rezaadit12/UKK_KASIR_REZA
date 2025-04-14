@extends('main')
@section('title', 'Data Produk')
@section('content')
    <h1 class="mt-4">Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Produk</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-table me-2"></i>
                <span>Daftar Produk</span>
            </div>
            @if (Auth::user()->role == 'admin')
            <a href="{{ route('product.create') }}" class="btn btn-success">Tambah Produk</a>
            @endif
        </div>
        <div class="card-body">

            <table id="datatablesSimple" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th style="width:100px">Gambar</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        @if (Auth::user()->role == 'admin')
                             <th>AKSI</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$product->name}}</td>
                            <td><img src="{{ url('storage/'. $product->image) }}" width="130px"  alt=""></td>
                            <td>@rupiah($product->price)</td>
                            <td>{{$product->stock}}</td>
                            @if (Auth::user()->role == 'admin')
                            <td>
                                <div class="d-fex gap-2" style="display: flex">
                                    <a href="{{route('product.edit', $product->id)}}" class="btn btn-primary">EDIT</a>
                                    <button class="btn btn-warning" onclick="showAjaxModal('Update Stok Produk', '{{route('updateStock', $product->id)}}')">UPDATE STOK</button>
                                    <form action="{{route('product.destroy', $product->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Cek kembali sebelum mengahapus')">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
