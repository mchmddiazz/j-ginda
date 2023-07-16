@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | Beranda
@endpush

@push('customcss')

@endpush

@section('content-main')
<div class="axil-product-cart-area axil-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-header">
                        <h5>Data Order</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table axil-product-table" id="tableOrders">
                            <tr>
                                <td>ID</td>
                                <td><b>#{{ $order->order_number }}</b></td>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <td><b>{{ "Rp. " . number_format($order->grand_total, 2, ',', '.') }}</b></td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td><b>
                                        @if ($order->payment_status == 1)
                                            Menunggu Pembayaran
                                        @elseif ($order->payment_status == 2)
                                            Sudah Dibayar
                                        @else
                                            Kadaluarsa
                                        @endif
                                    </b></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td><b>{{ $order->created_at->format('d M Y H:i') }}</b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-header">
                        <h5>Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        @if ($order->payment_status == 1)
                            <button class="btn btn-primary btn-lg" id="pay-button">Bayar Sekarang</button>
                        @elseif($oder->payment_status == 5)
                            Pembayaran Ditempat
                        @else
                            Pembayaran berhasil
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('customjs')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-3NhksoYVdOAzBP9n">
</script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();
        snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result);
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log(result)
            }
        });
    });
</script>
@endpush
