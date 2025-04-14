@extends('main')

@section('title', 'Sale - SB Admin')

@section('content')
    <h1 class="mt-4">Pembayaran</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pembayaran</li>
    </ol>


    <div class="card mb-4">
        <div class="card-body">
            <div class="mb-4">
                <a href="{{ route('exportPDF', $sale->id) }}" class="btn btn-primary me-1">Unduh</a>
                <a href="{{ route('sale.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
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
                <div class="col-md-6 text-end">
                    @php
                        $id = explode('-', $sale->id);
                    @endphp
                    <h5>Bukti Pembayaran - # {{ $id[0]  }}</h5>
                    <p></p>
                </div>
            </div>
            <table class="table table-bordered mt-5">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->detailSale as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->product->name}}</td>
                            <td>@rupiah($product->product->price)</td>
                            <td>{{$product->quantity}}</td>
                            <td>@rupiah($product->total_price)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row m-3 mt-5">
                <div class="col-md-12 d-flex justify-content-between">
                    <p>KASIR<br> <strong>{{ $sale->user->name }}</strong></p>
                    <p>TOTAL BAYAR<br> <strong>@rupiah($sale->total_pay)</strong></p>
                    <p>POIN DIGUNAKAN<br> <strong>{{$sale->point_exchanged ?? '-'}}</strong></p>
                    <h5>TOTAL<br>
                        @if ($sale->point_exchanged)
                            <span class="text-danger"><del>@rupiah($sale->total_price)</del></span><br>
                            <span class="text-success fw-bold">@rupiah($sale->total_price-$sale->point_exchanged)</span
                        @else
                        <span class="text-success">@rupiah($sale->total_price)</span>
                        @endif
                        
                        
                    </h5>
                    <h5>KEMBALIAN<br>
                        <strong>
                            @if ($sale->point_exchanged)
                                @rupiah($sale->total_pay - ($sale->total_price-$sale->point_exchanged))
                            @else
                                @rupiah($sale->total_pay - $sale->total_price)
                            @endif
                        </strong>
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endsection
