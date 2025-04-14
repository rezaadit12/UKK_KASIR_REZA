<h2 style="text-align: center; color: #c50707; margin-bottom: 20px;">LAPORAN PENJUALAN TOKO APRIL</h2>
<table>
    <thead>
        <tr style="background-color: #c50707; text-align: center;">
            <th width="7" height="30" style="background-color: #c50707; color: white;">NO</th>
            <th width="20" height="30" style="background-color: #c50707; color: white;">NOMOR PEMBAYARAN</th>
            <th width="22" style="background-color: #c50707; color: white;">No HP Pelanggan</th>
            <th width="25" style="background-color: #c50707; color: white;">Poin Pelanggan</th>
            <th width="30" style="background-color: #c50707; color: white;">Produk</th>
            <th width="20" style="background-color: #c50707; color: white;">Total PER PRODUK</th>
            <th width="20" style="background-color: #c50707; color: white;">Total Harga</th>
            <th width="15" style="background-color: #c50707; color: white;">Total Bayar</th>
            <th width="20" align="center" style="background-color: #c50707; color: white;">Total Diskon Poin</th>
            <th width="20" style="background-color: #c50707; color: white;">Total Kembalian</th>
            <th width="20" align="center" style="background-color: #c50707; color: white;">Tanggal Pembelian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
            <tr>
                <td align="left" valign="top">{{$loop->iteration}}</td>
                @php
                 $id = explode('-', $sale->id)
                @endphp
                <td align="left" valign="top">{{$id[0]}}</td>
                <td align="left" valign="top">{{ $sale->customer->phone ?? '-' }}</td>
                <td align="left" valign="top">
                    @if ($sale->point_exchanged)
                        {{ $sale->point_collected - $sale->point_exchanged }}
                    @else
                        {{ $sale->point_collected }}
                    @endif
                </td>
                <td valign="top">
                    @foreach ($sale->detailSale as $products)
                    {{ $products->product->name }} &nbsp;({{ $products->quantity }}) <br>
                    @endforeach
                </td>
                <td valign="top">
                    @foreach ($sale->detailSale as $products)
                        @rupiah($products->total_price) <br>
                    @endforeach
                </td>
                <td valign="top">
                    @if ($sale->point_exchanged)
                        @rupiah($sale->total_price - $sale->point_exchanged)
                    @else
                        @rupiah($sale->total_price)
                    @endif
                </td>
                <td valign="top">@rupiah($sale->total_pay)</td>
                <td align="center" valign="top">
                    @if ($sale->point_exchanged)
                        {{$sale->point_exchanged}}
                    @else
                        -
                    @endif
                </td>
                <td valign="top">
                    @if ($sale->point_exchanged)
                        @rupiah($sale->total_return + $sale->point_exchanged)
                    @else
                        @rupiah($sale->total_return)
                    @endif
                </td>
                <td align="center" valign="top">@indoDateTime($sale->created_at)</td>
                
            </tr>
        @endforeach
    </tbody>
</table>