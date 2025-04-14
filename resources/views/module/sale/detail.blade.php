<div class="card mb-4">
    <div class="card-body">
        <div class="row mb-3">
            <p><strong class="tanggal"></strong></p>
            <div class="col-md-12">
                @if ($customer)
                    <table>
                        <tr>
                            <td>NOMBER HP</td>
                            <td>&nbsp;: &nbsp;</td>
                            <td>{{$customer->phone }}</td>
                        </tr>
                        <tr>
                            <td>MEMBER SEJAK</td>
                            <td>&nbsp;: &nbsp;</td>
                            <td>@indoDate($customer->created_at)</td>
                        </tr>
                        <tr>
                            <td>MEMBER POIN</td>
                            <td>&nbsp;: &nbsp;</td>
                            <td>{{$customer->point}}</td>
                        </tr>
                    </table>
                @else
                    <table >
                        <tr>
                            <td>MEMBER STATUS</td>
                            <td>&nbsp;: &nbsp;</td>
                            <td>Bukan Member</td>
                        </tr>
                    </table>
                @endif
            </div>
        </div>
        <table class="table table-bordered mt-4">
            <thead class="">
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->detailSale as $products)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $products->product->product_name }}</td>
                    <td>@rupiah($products->product->price)</td>
                    <td>{{ $products->quantity }}</td>
                    <td>@rupiah($products->total_price)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row m-3 mt-5">
            <div class="col-md-6">
                <p>Dibuat oleh:<br> <strong>{{$sale->user->name}}</strong></p>
                <p>Total Bayar:<br> <strong>@rupiah($sale->total_pay)</strong></p>
            </div>
            <div class="col-md-6">
                <p>Poin Digunakan:<br> <strong>{{$sale->point_exchanged ?? '-'}}</strong></p>
                <p>Total Harga:<br>
                    <b>
                        @if ($sale->point_exchanged)
                            <span class="text-danger"><del>@rupiah($sale->total_price)</del></span><br>
                            <span class="text-success fw-bold">@rupiah($sale->total_price-$sale->point_exchanged)</span
                        @else
                        <span class="text-success">@rupiah($sale->total_price)</span>
                        @endif
                    </b>
                </p>
            </div>
        </div>
    </div>
</div>