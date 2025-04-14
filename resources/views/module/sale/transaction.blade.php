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
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product['name']}}</td>
                                    <td>@rupiah($product['price'])</td>
                                    <td>{{$product['quantity']}}</td>
                                    <td>@rupiah($product['totalPrice'])</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total: </th>
                                <th id="totalPay">@rupiah($totalPay)</th> {{-- 1 --}}
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card mb-4">
                <div class="container mt-3 mb-3">
                    <form action="{{ route('storeOrMember') }}" method="POST">
                        @csrf
                        <input type="hidden" name="products" id="hiddenProducts" value="{{json_encode($products)}}">
                        <input type="hidden" name="total" value="{{$totalPay}}">
                        <div class="mb-3">
                            <label class="form-label">Member Status <span class="text-danger">Dapat juga membuat
                                    member</span></label>
                            <select name="member" id="member-select" class="form-select"> {{-- 6 --}}
                                <option value="member-false">Bukan Member</option>
                                <option value="member-true">Member</option>
                            </select>
                        </div>
                        <div class="mb-3" style="display: none;" id="nomber-hp">
                            <label class="form-label">No Telepon <span class="text-danger">(daftar/gunakan
                                    member)</span></label>
                            <input type="number" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Bayar</label>
                            <input type="text" class="form-control" name="totalPay" id="inputPay"> {{-- 2 --}}
                            <input type="hidden" name="totalPay" id="hiddenPay"> {{-- 3 --}}
                            <small id="error-message" class="text-danger d-none">Jumlah bayar
                                kurang.</small>{{-- 4 --}}
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submitButton"
                                disabled>Submit</button>{{-- 5 --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#member-select").change(function() {
                $("#nomber-hp").toggle($(this).val() === "member-true");
            });

            $("#inputPay").on("input", function() {
                let value = $(this).val().replace(/\D/g, ""); // Hanya angka
                $("#hiddenPay").val(value);
                $(this).val(value ? "Rp. " + parseInt(value).toLocaleString("id-ID") : "");
                validatePayment();
            });

            function validatePayment() {
                const totalPay = parseInt($("#totalPay").text().replace(/\D/g, ""), 10);
                const inputPay = parseInt($("#hiddenPay").val(), 10) || 0;
                $("#submitButton").prop("disabled", inputPay < totalPay);
                $("#error-message").toggleClass("d-none", inputPay >= totalPay);
            }
        });
    </script>
@endpush
