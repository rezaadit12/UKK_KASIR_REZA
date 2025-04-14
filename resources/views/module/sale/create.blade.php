@extends('main')

@section('title', 'Sale - SB Admin')
@section('content')
    <h1 class="mt-4">Penjualan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="">Penjualan</a></li>
        <li class="breadcrumb-item active">Tambah Penjualan</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                @foreach ($products as  $product)
                
                    <div class="col-md-4">
                        <div class="card mb-3" data-id="{{$product->id}}"> {{-- 6 --}}
                            <div class="container-fluid mt-3">
                                <img src="{{url('storage/'. $product->image)}}" class="card-img-top img-fluid" alt="imageProduct"
                                    style="height: 200px; object-fit: cover;">
                            </div>
                            <div class="card-body" align="center">
                                <h5 class="card-title" id="product-name_{{$product->id}}"><b>{{ $product->name }}</b></h5> {{-- 7 --}}
                                <p class="card-text" id="total-stock_{{$product->id}}">stok: {{ $product->stock }}</p> {{-- 1 --}}
                                <p class="card-text" id="price_{{$product->id}}">{{ $product->price }}</p> {{-- 2 --}}
                                <div class="col-md-3">
                                    <table>
                                        <tr>
                                            {{-- 4 --}}
                                            <td style="padding: 0px 10px 0px 10px; cursor: pointer;" id="minus_{{$product->id}}"><b>-</b>
                                            </td>
                                            <td style="padding: 0px 10px 0px 10px;" class="num" id="quantity_{{$product->id}}">0</td>
                                            <td style="padding: 0px 10px 0px 10px; cursor: pointer;" id="plus_{{$product->id}}"><b>+</b>
                                            </td>
                                            {{-- /4 --}}
                                        </tr>
                                    </table>
                                </div><br>
                                <p class="card-text" id="total-price_{{$product->id}}">Sub Total: <b>Rp. 0,-</b></p> {{-- 5 --}}
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="row fixed-bottom d-flex justify-content-end align-content-center"
                    style="margin-left: 0%; width: 100%; height: 70px; border-top: 3px solid #EEE4B1; background-color: white;">
                    <div class="col text-center" style="margin-right: 50px; margin-left: 15%;">
                        <form class="form-horizontal form-material mx-2" method="POST" action="{{ route('transaction') }}">
                            @csrf
                            <div id="product-container"></div> <!-- Tempat input hidden -->
                            <button class="btn btn-primary">Selanjutnya</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".card").each(function() {
                let card = $(this);
                let productId = card.data("id"); // Ambil ID produk
                let productName = card.find("#product-name_" + productId);
                let minusBtn = card.find("#minus_" + productId);
                let plusBtn = card.find("#plus_" + productId);
                let quantityElem = card.find("#quantity_" + productId);
                let totalPriceElem = card.find("#total-price_" + productId);
                let priceElem = card.find("#price_" + productId);
                let stockElem = card.find("#total-stock_" + productId);
                let storeDataElem = card.find("#store-data_" + productId);
                let productContainer = $("#product-container");

                let price = parseInt(priceElem.text().replace(/\D/g, ""), 10);
                let stock = parseInt(stockElem.text().replace(/\D/g, ""), 10);
                let quantity = 0;

                function updateUI() {
                    quantityElem.text(quantity);
                    totalPriceElem.html(
                        `Sub Total: <b>Rp. ${ (quantity * price).toLocaleString("id-ID") },-</b>`);

                    productContainer.find(`input[data-id="${productId}"]`).remove();

                    if (quantity > 0) {
                        let inputValue = productId + ";" + productName.text() + ";" + price + ";" +
                            quantity + ";" + quantity * price;

                        console.log(inputValue);
                        productContainer.append(
                            `<input type="hidden" name="products[]" value="${inputValue}" data-id="${productId}">`
                        );
                    }
                }

                plusBtn.click(function() {
                    if (quantity < stock) {
                        quantity++;
                        updateUI();
                    } else {
                        alert('Stok tidak mencukupi');
                    }
                });

                minusBtn.click(function() {
                    if (quantity > 0) {
                        quantity--;
                        updateUI();
                    }
                });
            });
        });
    </script>
@endpush
