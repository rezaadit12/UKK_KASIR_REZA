@extends('main')
@section('title', 'Product - Update')
@section('content')

    <h1 class="mt-4">Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="" title="url previous">Produk</a></li>
        <li class="breadcrumb-item active">Tambah Produk</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form class="form-horizontal form-material mx-2" method="POST" action="{{route('product.update', $item->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Nama Produk <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" name="name" class="form-control form-control-line" value="{{$item->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Gambar Produk <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="file" name="image" class="form-control form-control-line ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Harga <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" name="price" id="price" class="form-control form-control-line" value="{{$item->price}}">
                                <input type="hidden" name="price" id="hiddenPrice">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Stok <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="number" name="stock" class="form-control form-control-line " value="{{$item->price}}" disabled>
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
@push('script')
    <script>
        $(document).ready(function() {
            $("#price").on("input", function() {
                let value = $(this).val().replace(/\D/g, ""); // Hanya angka
                $("#hiddenPrice").val(value);
                $(this).val(value ? "Rp. " + parseInt(value).toLocaleString("id-ID") : "");
            });
        });
    </script>
@endpush