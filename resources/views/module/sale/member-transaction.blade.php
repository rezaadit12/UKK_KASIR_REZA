@extends('main')

@section('title', 'Sale - SB Admin')

@section('content')
    <h1 class="mt-4">Penjualan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Penjualan</li>
    </ol>

    <div class="row">
        <div class="col-7">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <i class="fas fa-table me-2"></i>
                        <span><b>Produk yang dipilih</b></span>
                    </div>
                </div>
                <div class="card-body">
                    <table id="" class="table">{{-- datatablesSimple --}}
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th>Kuantitas</th>
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
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total Harga: </th>
                                <th id="totalPay">@rupiah($sale->total_price)</th> {{-- 1 --}}
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total Bayar: </th>
                                <th id="totalPay">@rupiah($sale->total_pay)</th> {{-- 1 --}}
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card mb-4">
                <div class="container mt-3 mb-3">
                    <form action="{{ route('storeMember') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                        <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                        <div class="mb-3" id="nomber-hp">
                            <label class="form-label">Nama Member (identitas)</label>
                            <input type="text" class="form-control" name="username" value="{{ $customer->name }}">
                        </div>
                        @php
                        if($checkPoint){
                           $customerPoint = $customer->point - $sale->point_collected;     
                        }else{
                           $customerPoint = $customer->point - $sale->point_collected;
                        }
                        @endphp
                        <div class="mb-3">
                            <label class="form-label">Poin yang dapat digunakan</label>
                            <input type="number" class="form-control" name="poin" value="{{$customerPoint}}" disabled>
                        </div>

                        
                        <div class="mb-3">
                            <div class="m-2">
                                <input type="checkbox" name="checkPoint" id="pointCheck" value="{{$customerPoint}}"  {{ $checkPoint ? '' : 'disabled'}}>
                                <label class="form-check-label" {{ $checkPoint ? '' : 'text-muted'}} for="pointCheck"> {{ $checkPoint ? 'Tukarkan Point' : 'Point tidak dapat ditukarkan'}}</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Poin didapat</label>
                            <input type="number" class="form-control" value="{{$sale->point_collected}}" disabled>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submitButton" >Submit</button>{{-- 5 --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

