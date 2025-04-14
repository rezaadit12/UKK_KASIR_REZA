@extends('main')

@section('title', 'sale - SB Admin')

@section('content')
    <h1 class="mt-4">Penjualan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Penjualan</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-table me-2"></i>
                <span>Penjualan</span>
            </div>
            @if (Auth::user()->role == 'petugas')
                <div class="b-action">
                    <a href="{{ route('exportEXCEL')}}" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Export penjualan (.xlsx)</a>
                    <a href="{{ route('sale.create') }}" class="btn btn-success ms-3">Tambah penjualan</a>
                </div>
            @endif
        </div>
        <div class="card-body">

            <table id="datatablesSimple" class="table">{{-- datatablesSimple --}}
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Penjualan</th>
                        <th>Total Harga</th>
                        <th>Dibuat Oleh</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                @if ($sale->customer)
                                {{$sale->customer->name}}
                                @else
                                NON-MEMBER
                                @endif
                            </td>
                            <td>@indoDate($sale->created_at)</td>
                            <td>@rupiah($sale->total_price)</td>
                            <td>{{$sale->user->name}}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-warning" onclick="showAjaxModal('Detail Penjualan', '{{route('sale.show', $sale->id)}}')">DETAIL</button>
                                    <a href="{{ route('exportPDF', $sale->id) }}" class="btn btn-primary">UNDUH</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
