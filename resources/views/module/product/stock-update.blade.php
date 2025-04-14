<form action="{{ route('product.update', $product->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="hidden" name="stock" value="true">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-12">Nama Produk <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control form-control-line"
                        value="{{$product->name}}" disabled>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label class="col-md-12">Stok <span class="text-danger">*</span></label>
                <div class="col-md-12">
                    <input type="text" name="stock" class="form-control form-control-line"
                        value="{{$product->stock}}">
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <button class="btn btn-primary" type="submit">Perbarui</button>
    </div>
</form>
