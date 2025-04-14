@extends('main')

@section('title', 'Dashboard - SB Admin')
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="card">
        <div class="card-body">
            <h3>Selamat Datang, Petugas!</h3>
            <hr>
            <div class="card d-block m-auto text-center">
                <div class="card-header">
                    Total Penjualan Hari Ini
                </div>
                <div class="d-flex">
                    <div class="card-body">
                        <h3 class="card-title">{{$countToday}}</h3>
                        <p class="card-text">Jumlah total penjualan yang terjadi hari ini.</p>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">@rupiah($totalToday)</h3>
                        <p class="card-text">Jumlah total pendapatan yang terjadi hari ini.</p>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Terakhir diperbarui: @indoDateTime($lastUpdate)
                </div>
            </div>
        </div>
    </div>
@endsection
