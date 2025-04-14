<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .table-main {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .th-main,
        .td-main {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .td-foot {
            padding: 3px;

        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total-section {
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h2 class="text-center">Bukti Penjualan</h2><br>
    <h3>Indo April</h3>
    <div class="info" style="display: flex">
        @if ($sale->customer)
            <table>
                <tr>
                    <td>NOMBER HP</td>
                    <td>&nbsp;: &nbsp;</td>
                    <td>{{ $sale->customer->phone }}</td>
                </tr>
                <tr>
                    <td>BERGABUNG SEJAK</td>
                    <td>&nbsp;: &nbsp;</td>
                    <td>@indoDate($sale->customer->created_at)</td>
                </tr>
                <tr>
                    <td>MEMBER POIN</td>
                    <td>&nbsp;: &nbsp;</td>
                    <td>
                        @if ($sale->point_exchanged)
                            {{ $sale->point_collected - $sale->point_exchanged }}
                        @else
                            {{ $sale->point_collected }}
                        @endif
                    </td>
                </tr>
            </table>
        @else
            <table>
                <tr>
                    <td>MEMBER STATUS</td>
                    <td>&nbsp;: &nbsp;</td>
                    <td>Bukan Member</td>
                </tr>
            </table>
        @endif
        <table style="margin-left:auto">
            <tr>
                <td><b>@indoDateTime($sale->created_at) | {{ $sale->user->name }}</b></td>
            </tr>
        </table>
    </div>
    <h3 class="mt-4">Detail Produk</h3>
    <table class="table-main">
        <thead>
            <tr>
                <th class="th-main">#</th>
                <th class="th-main">Produk</th>
                <th class="th-main">Harga</th>
                <th class="th-main">Kuantitas</th>
                <th class="th-main">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->detailSale as $products)
                <tr>
                    <td class="td-main">{{ $loop->iteration }}</td>
                    <td class="td-main">{{ $products->product->name }}</td>
                    <td class="td-main">@rupiah($products->product->price)</td>
                    <td class="td-main">{{ $products->quantity }}</td>
                    <td class="td-main">@rupiah($products->total_price)</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @if ($sale->customer)
                <tr>
                    <td class="td-foot" colspan="3"></td>
                    <td class="td-foot">Poin Digunakan</td>
                    <td class="td-foot" style="padding-left: 10px">{{ $sale->point_exchanged ? $sale->point_exchanged : '-' }}</td>
                </tr>
            @endif
            <tr>
                <td class="td-foot" colspan="3"></td>
                <td class="td-foot">Total Harga</td>
                <td class="td-foot" style="padding-left: 10px">
                    <b>
                        @if ($sale->point_exchanged)
                            <span style="text-decoration: line-through; color: red;">@rupiah($sale->total_price)</span>
                            <br>
                            <span style="color: green; font-weight: bold;">@rupiah($sale->total_price - $sale->point_exchanged)</span>
                        @else
                            <span style="color: green;">@rupiah($sale->total_price)</span>
                        @endif
                    </b>
                </td>
            </tr>
            <tr>
                <td class="td-foot" colspan="3"></td>
                <td class="td-foot">Total Bayar</td>
                <td class="td-foot" style="padding-left: 10px">
                    @rupiah($sale->total_pay)
                </td>
            </tr>
            <tr>
                <td class="td-foot" colspan="3"></td>
                <td class="td-foot">kembalian</td>
                <td class="td-foot" style="padding-left: 10px">
                    @if ($sale->point_exchanged)
                        @rupiah($sale->total_return + $sale->point_exchanged)
                    @else
                        @rupiah($sale->total_return)
                    @endif
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>