@extends('main')
@section('content')
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>

<div class="card mb-4 ms-4 me-4 mt-4">
    <div class="card-header">
        <i class="fas fa-chart-area me-1"></i>
        Selamat Datang, Administrator!
    </div>
    <div class="d-flex">
        <div class="card-body"><canvas id="chartBar"></canvas></div>
        <div class="card-body"><canvas id="chartCircle"></canvas></div>
    </div>
</div>
@endsection
@php
use Carbon\Carbon;
Carbon::setLocale('id');

    $dateSale = [];
    $totalSale = [];
    $totalProduct = [];
    $nameProduct = [];

foreach ($sales as $sale) {
    $dateSale[] = Carbon::parse($sale->sale_date)->translatedFormat('d F Y');
    $totalSale[] = $sale->totalSale;
}

foreach($products as $product){
    $totalProduct[] = $product->totalSold;
    $nameProduct[] = $product->name;
}

@endphp
@push('script')
<script>
    const chartBar = document.getElementById('chartBar');

    new Chart(chartBar, {
        type: 'bar',
        data: {
            labels: @json($dateSale),
            datasets: [{
                label: 'Jumlah Penjualan',
                data: @json($totalSale),
                borderWidth: 1
            }]
        },
        options: {

            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    const chartCircle = document.getElementById('chartCircle');

    const dataCircle = {
        labels: @json($nameProduct),
        datasets: [{
            label: 'My First Dataset',
            data: @json($totalProduct),
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(185, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };


    new Chart(chartCircle, {
        type: 'pie',
        data: dataCircle,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Persentase Penjualan Produk'
                }
            }
        }
    });
</script>
@endpush