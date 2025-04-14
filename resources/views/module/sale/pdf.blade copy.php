<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan (PDF)</title>
    <style>
        body {
            font-family: "Courier New", monospace;
            font-size: 16px;
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            color: #000;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td {
            padding: 6px 4px;
        }

        .line {
            border-top: 2px dashed #000;
            margin: 10px 0;
        }

        .right {
            text-align: right;
        }

        .small {
            font-size: 14px;
        }

        .big {
            font-size: 23px;
        }
    </style>
</head>

<body>
    <div class="center bold big">
        INDO APRIL
    </div><br>
    <div class="center small">Jl. Raya Wanguns | Kota Bogor | RT.04/44 | 0888373737</div>
    <div class="line"></div>

    <table>
        <tr>
            <td>Tanggal</td>
            <td class="right">@indoDateTime($sale->created_at)</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="right">{{ $sale->user->name }}</td>
        </tr>
        @if ($sale->customer)
        <tr>
            <td>Member</td>
            <td class="right">{{ $sale->customer->phone }}</td>
        </tr>
        @endif
    </table>

    <div class="line"></div>

    <table>
        @foreach ($sale->detailSale as $products)
        <tr>
            <td colspan="2" class="bold">{{ $products->product->name }}</td>
        </tr>
        <tr>
            <td>{{ $products->quantity }} x @rupiah($products->product->price)</td>
            <td class="right">@rupiah($products->total_price)</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        @if ($sale->point_exchanged)
        <tr>
            <td>Poin Digunakan</td>
            <td class="right">- @rupiah($sale->point_exchanged)</td>
        </tr>
        @endif
        <tr class="bold">
            <td>Total</td>
            <td class="right">@rupiah($sale->total_price - ($sale->point_exchanged ?? 0))</td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="right">@rupiah($sale->total_pay)</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="right">@rupiah($sale->total_return + ($sale->point_exchanged ?? 0))</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="center">
        <p class="bold">Terima kasih telah berbelanja!</p>
        @if ($sale->customer)
        <p>Poin Saat Ini:
            <b>
                @if ($sale->point_exchanged)
                    {{ $sale->point_collected - $sale->point_exchanged }}
                @else
                    {{ $sale->point_collected }}
                @endif
            </b>
        </p>
        @endif
    </div>

</body>

</html>
